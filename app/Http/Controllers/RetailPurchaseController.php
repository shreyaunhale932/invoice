<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Chalni;
use App\Models\Clarity;
use App\Models\Color;
use App\Models\Cut;
use App\Models\InventoryTransaction;
use App\Models\ItemProductData;
use App\Models\MetalRate;
use App\Models\Mm;
use App\Models\PacketMaster;
use App\Models\PacketType;
use App\Models\Product;
use App\Models\ProductPacket;
use App\Models\PurityModel;
use App\Models\RetailPurchase;
use App\Models\RetailPurchaseItem;
use App\Models\RetailPurchasePacketItem;
use App\Models\RetailPurchasePayment;
use App\Models\Shape;
use App\Models\Stone;
use App\Models\Subcategory;
use App\Models\Supplier;
use App\Services\AccountingService;
use App\Services\WholesaleStockService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RetailPurchaseController extends Controller
{
    /**
     * Display a listing of retail purchases.
     */
    public function index(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        $query = RetailPurchase::with(['supplier', 'items.packetItems'])
            ->where('admin_id', $adminId);

        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }
        if ($request->filled('from_date')) {
            $query->whereDate('purchase_date', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('purchase_date', '<=', $request->to_date);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('purchase_no', 'like', "%{$search}%")
                  ->orWhere('reference_no', 'like', "%{$search}%")
                  ->orWhereHas('supplier', function ($sq) use ($search) {
                      $sq->where('name', 'like', "%{$search}%")
                        ->orWhere('shop_name', 'like', "%{$search}%");
                  });
            });
        }

        $purchases = $query->latest('purchase_date')->latest('id')->paginate(15);
        $suppliers = Supplier::where('admin_id', $adminId)->get();

        $totalPurchaseAmount = RetailPurchase::where('admin_id', $adminId)->sum('grand_total');
        $totalPaidAmount = RetailPurchase::where('admin_id', $adminId)->sum('paid_amount');
        $totalUnpaidAmount = max(0, $totalPurchaseAmount - $totalPaidAmount);

        $totalNetWeight = RetailPurchaseItem::where('admin_id', $adminId)->sum('net_weight');
        $totalGrossWeight = RetailPurchaseItem::where('admin_id', $adminId)->sum('gross_weight');

        return view('Purchases.retail-purchases.index', compact('purchases', 'suppliers', 'totalPurchaseAmount', 'totalPaidAmount', 'totalUnpaidAmount', 'totalNetWeight', 'totalGrossWeight'));
    }

    /**
     * Show form for creating a retail purchase.
     */
    public function create()
    {
        $adminId = Auth::guard('admin')->id();
        $firmId = auth()->user()->firm_id ?? null;

        $suppliers = Supplier::where('admin_id', $adminId)->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $purities = PurityModel::all();
        $metalRates = MetalRate::all();
        $products = Product::with(['category', 'subcategory', 'purity', 'packets'])->get();

        // Master attributes for packets
        $packetMasters = PacketMaster::with(['stone', 'clarity', 'color', 'cut', 'shape', 'chalni', 'mm'])->get();
        $packetTypes = PacketType::all();
        $stones = Stone::all();
        $clarities = Clarity::all();
        $colors = Color::all();
        $cuts = Cut::all();
        $shapes = Shape::all();
        $mms = Mm::all();

        // Generate auto-increment Purchase Invoice No starting from IP001
        $query = RetailPurchase::where('purchase_no', 'like', 'IP%');
        if ($firmId) {
            $query->where('firm_id', $firmId);
        }
        $lastPurchase = $query->orderBy('id', 'desc')->first();
        if ($lastPurchase && preg_match('/IP(\d+)/i', $lastPurchase->purchase_no, $matches)) {
            $nextNum = intval($matches[1]) + 1;
        } else {
            $nextNum = 1;
        }
        $purchaseNo = 'IP' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

        $accounts = Account::with('group')->get();

        return view('Purchases.retail-purchases.create', compact(
            'suppliers', 'categories', 'subcategories', 'purities', 'metalRates', 'products',
            'packetMasters', 'packetTypes', 'stones', 'clarities', 'colors', 'cuts', 'shapes', 'mms',
            'accounts', 'purchaseNo'
        ));
    }

    /**
     * Store a newly created retail purchase and integrate stock.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'          => 'nullable|exists:suppliers,id',
            'purchase_no'          => 'nullable|string|max:100',
            'purchase_date'        => 'required|date',
            'reference_no'         => 'nullable|string|max:100',
            'due_date'             => 'nullable|date',
            'items'                => 'required|array|min:1',
            'items.*.item_name'    => 'required|string|max:255',
            'items.*.quantity'     => 'required|numeric|min:0.01',
            'items.*.gross_weight' => 'nullable|numeric|min:0',
            'items.*.net_weight'   => 'nullable|numeric|min:0',
            'items.*.purchase_rate' => 'required|numeric|min:0',
            'discount_percent'     => 'nullable|numeric|min:0',
            'discount_amount'      => 'nullable|numeric|min:0',
            'cgst_percent'         => 'nullable|numeric|min:0',
            'sgst_percent'         => 'nullable|numeric|min:0',
            'igst_percent'         => 'nullable|numeric|min:0',
            'other_charges'        => 'nullable|numeric|min:0',
            'paid_amount'          => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, &$purchase) {
            $adminId = Auth::guard('admin')->id();
            $firmId = auth()->user()->firm_id ?? null;

            // Determine purchase_no
            $purchaseNo = $request->purchase_no;
            if (empty($purchaseNo)) {
                $query = RetailPurchase::where('purchase_no', 'like', 'IP%');
                if ($firmId) {
                    $query->where('firm_id', $firmId);
                }
                $lastPurchase = $query->orderBy('id', 'desc')->first();
                if ($lastPurchase && preg_match('/IP(\d+)/i', $lastPurchase->purchase_no, $matches)) {
                    $nextNum = intval($matches[1]) + 1;
                } else {
                    $nextNum = 1;
                }
                $purchaseNo = 'IP' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);
            }

            // 1. Calculate Summary Totals
            $subtotal = 0;
            foreach ($request->items as $itemData) {
                $qty = floatval($itemData['quantity'] ?? 1);
                $rate = floatval($itemData['purchase_rate'] ?? 0);
                $making = floatval($itemData['making_final_amount'] ?? $itemData['making_price'] ?? 0);
                $stoneAmt = floatval($itemData['stone_amount'] ?? 0);
                $diamondAmt = floatval($itemData['diamond_amount'] ?? 0);
                $packetAmt = floatval($itemData['packet_amount'] ?? 0);
                $itemDiscount = floatval($itemData['discount_amount'] ?? 0);

                // Metal / Item base amount & Wastage
                $netWt = floatval($itemData['net_weight'] ?? 0);
                $metalAmt = ($netWt > 0) ? ($netWt * $rate) : ($qty * $rate);
                $wastagePerc = floatval($itemData['wastage_percent'] ?? 0);
                $wastageAmt = ($netWt > 0 && $wastagePerc > 0) ? (($netWt * $wastagePerc / 100) * $rate) : 0;
                $lineTotal = max(0, ($metalAmt + $wastageAmt + $making + $stoneAmt + $diamondAmt + $packetAmt) - $itemDiscount);

                $subtotal += $lineTotal;
            }

            $discountAmount = floatval($request->discount_amount ?? 0);
            if (empty($discountAmount) && !empty($request->discount_percent)) {
                $discountAmount = ($subtotal * floatval($request->discount_percent)) / 100;
            }

            $taxableAmount = max(0, $subtotal - $discountAmount);

            $cgstPercent = floatval($request->cgst_percent ?? 0);
            $sgstPercent = floatval($request->sgst_percent ?? 0);
            $igstPercent = floatval($request->igst_percent ?? 0);

            $cgstAmount = ($taxableAmount * $cgstPercent) / 100;
            $sgstAmount = ($taxableAmount * $sgstPercent) / 100;
            $igstAmount = ($taxableAmount * $igstPercent) / 100;

            $otherCharges = floatval($request->other_charges ?? 0);
            $rawGrandTotal = $taxableAmount + $cgstAmount + $sgstAmount + $igstAmount + $otherCharges;

            $grandTotal = round($rawGrandTotal);
            $roundOff = round($grandTotal - $rawGrandTotal, 2);

            $paidAmount = floatval($request->paid_amount ?? 0);
            $paymentStatus = 'unpaid';
            if ($paidAmount >= $grandTotal && $grandTotal > 0) {
                $paymentStatus = 'paid';
            } elseif ($paidAmount > 0) {
                $paymentStatus = 'partial';
            }

            // 2. Create Purchase Header
            $purchase = RetailPurchase::create([
                'admin_id'               => $adminId,
                'firm_id'                => $firmId,
                'supplier_id'            => $request->supplier_id,
                'purchase_no'            => $purchaseNo,
                'reference_no'           => $request->reference_no,
                'purchase_date'          => $request->purchase_date,
                'due_date'               => $request->due_date,
                'status'                 => $request->status ?? 'completed',
                'subtotal'               => $subtotal,
                'discount_percent'       => $request->discount_percent ?? 0,
                'discount_amount'        => $discountAmount,
                'taxable_amount'         => $taxableAmount,
                'cgst_percent'           => $cgstPercent,
                'cgst_amount'            => $cgstAmount,
                'sgst_percent'           => $sgstPercent,
                'sgst_amount'            => $sgstAmount,
                'igst_percent'           => $igstPercent,
                'igst_amount'            => $igstAmount,
                'other_charges'          => $otherCharges,
                'round_off'              => $roundOff,
                'grand_total'            => $grandTotal,
                'paid_amount'            => $paidAmount,
                'payment_status'         => $paymentStatus,
                'payment_method'         => $request->payment_method ?? 'cash',
                'gold_payment_grams'     => floatval($request->gold_payment_grams ?? 0),
                'gold_payment_purity'    => floatval($request->gold_payment_purity ?? 100),
                'gold_payment_fine_wt'   => floatval($request->gold_payment_fine_wt ?? 0),
                'gold_payment_rate'      => floatval($request->gold_payment_rate ?? 0),
                'gold_payment_amount'    => floatval($request->gold_payment_amount ?? 0),
                'remaining_metal_wt'     => floatval($request->remaining_metal_wt ?? 0),
                'remaining_metal_amount' => floatval($request->remaining_metal_amount ?? 0),
                'notes'                  => $request->notes,
            ]);

            // 3. Create Items, Packets & Wholesale Stock Integration
            foreach ($request->items as $itemIdx => $itemData) {
                // Packet Weight & Amount Calculations
                $packetWt = 0;
                $packetAmt = 0;
                $packetsData = $itemData['packets'] ?? [];

                foreach ($packetsData as $pkt) {
                    $pktWt = floatval($pkt['wt_in_gram'] ?? $pkt['weight'] ?? 0);
                    $pktAmt = floatval($pkt['amount'] ?? 0);
                    if ($pktAmt <= 0 && $pktWt > 0 && !empty($pkt['rate'])) {
                        $pktAmt = $pktWt * floatval($pkt['rate']);
                    }
                    $packetWt += $pktWt;
                    $packetAmt += $pktAmt;
                }

                $grossWt = floatval($itemData['gross_weight'] ?? 0);
                $stoneWt = floatval($itemData['stone_weight'] ?? 0);
                $diamondWt = floatval($itemData['diamond_weight'] ?? 0);
                $netWt = floatval($itemData['net_weight'] ?? 0);

                if ($netWt <= 0 && $grossWt > 0) {
                    $netWt = max(0, $grossWt - ($stoneWt * 0.2) - ($diamondWt * 0.2) - $packetWt);
                }

                $wastagePerc = floatval($itemData['wastage_percent'] ?? 0);
                $fineWt = floatval($itemData['final_fn_weight'] ?? 0);
                if ($fineWt <= 0 && $netWt > 0) {
                    $fineWt = $netWt + (($netWt * $wastagePerc) / 100);
                }

                $qty = floatval($itemData['quantity'] ?? 1);
                $rate = floatval($itemData['purchase_rate'] ?? 0);
                $making = floatval($itemData['making_final_amount'] ?? $itemData['making_price'] ?? 0);
                $stoneAmt = floatval($itemData['stone_amount'] ?? 0);
                $diamondAmt = floatval($itemData['diamond_amount'] ?? 0);
                $itemDiscount = floatval($itemData['discount_amount'] ?? 0);

                $metalAmt = ($netWt > 0) ? ($netWt * $rate) : ($qty * $rate);
                $wastageAmt = ($netWt > 0 && $wastagePerc > 0) ? (($netWt * $wastagePerc / 100) * $rate) : 0;
                $lineTotal = max(0, ($metalAmt + $wastageAmt + $making + $stoneAmt + $diamondAmt + $packetAmt) - $itemDiscount);

                // Create Purchase Item
                $purchaseItem = RetailPurchaseItem::create([
                    'admin_id'             => $adminId,
                    'firm_id'              => $firmId,
                    'retail_purchase_id'   => $purchase->id,
                    'product_id'           => null,
                    'item_product_data_id' => null,
                    'category_id'          => $itemData['category_id'] ?? null,
                    'subcategory_id'       => $itemData['subcategory_id'] ?? null,
                    'purity_id'            => $itemData['purity_id'] ?? null,
                    'item_name'            => $itemData['item_name'],
                    'pre_code'             => $itemData['pre_code'] ?? null,
                    'post_code'            => $itemData['post_code'] ?? null,
                    'barcode'              => $itemData['barcode'] ?? null,
                    'quantity'             => $qty,
                    'unit'                 => $itemData['unit'] ?? 'GM',
                    'size'                 => $itemData['size'] ?? null,
                    'gross_weight'         => $grossWt,
                    'stone_weight'         => $stoneWt,
                    'diamond_weight'       => $diamondWt,
                    'packet_weight'        => $packetWt,
                    'net_weight'           => $netWt,
                    'wastage_percent'      => $wastagePerc,
                    'final_fn_weight'      => $fineWt,
                    'purchase_rate'        => $rate,
                    'metal_amount'         => $metalAmt,
                    'making_price'         => floatval($itemData['making_price'] ?? 0),
                    'making_type'          => $itemData['making_type'] ?? null,
                    'making_final_amount'  => $making,
                    'stone_amount'         => $stoneAmt,
                    'diamond_amount'       => $diamondAmt,
                    'packet_amount'        => $packetAmt,
                    'discount_amount'      => $itemDiscount,
                    'gst_percent'          => floatval($itemData['gst_percent'] ?? 0),
                    'gst_amount'           => floatval($itemData['gst_amount'] ?? 0),
                    'total_amount'         => $lineTotal,
                ]);

                // Create Purchase Packet Items
                foreach ($packetsData as $pkt) {
                    if (!empty($pkt['packet_no']) || !empty($pkt['pcs']) || !empty($pkt['weight'])) {
                        RetailPurchasePacketItem::create([
                            'admin_id'                => $adminId,
                            'firm_id'                 => $firmId,
                            'retail_purchase_id'      => $purchase->id,
                            'retail_purchase_item_id' => $purchaseItem->id,
                            'packet_no'               => $pkt['packet_no'] ?? null,
                            'packet_type'             => $pkt['packet_type'] ?? 'Diamond',
                            'pcs'                     => $pkt['pcs'] ?? 0,
                            'stone'                   => $pkt['stone'] ?? null,
                            'clarity'                 => $pkt['clarity'] ?? null,
                            'color'                   => $pkt['color'] ?? null,
                            'cut'                     => $pkt['cut'] ?? null,
                            'shape'                   => $pkt['shape'] ?? null,
                            'mm'                      => $pkt['mm'] ?? null,
                            'chalni'                  => $pkt['chalni'] ?? null,
                            'solitaire'               => !empty($pkt['solitaire']) ? 1 : 0,
                            'rate'                    => floatval($pkt['rate'] ?? 0),
                            'amount'                  => floatval($pkt['amount'] ?? 0),
                            'weight'                  => floatval($pkt['weight'] ?? 0),
                            'wt_in_gram'              => floatval($pkt['wt_in_gram'] ?? $pkt['weight'] ?? 0),
                            'uom'                     => $pkt['uom'] ?? 'CARAT',
                            'certificate_no'          => $pkt['certificate_no'] ?? null,
                        ]);
                    }
                }

                // Add item stock into Wholesale Stock & Batch
                app(WholesaleStockService::class)->addPurchaseItemToWholesaleStock($purchase, $purchaseItem, $itemData);
            }

            // Save Payment Breakdown Entries
            $goldPaymentAmt = floatval($request->gold_payment_amount ?? 0);
            $totalPaid = $goldPaymentAmt;

            if ($request->filled('payments') && is_array($request->payments)) {
                $purchase->payments()->delete();
                foreach ($request->payments as $p) {
                    $amt = floatval($p['amount'] ?? 0);
                    if ($amt > 0) {
                        $purchase->payments()->create([
                            'firm_id'          => $firmId,
                            'account_id'       => !empty($p['account_id']) ? $p['account_id'] : null,
                            'payment_method'   => $p['payment_method'] ?? 'cash',
                            'amount'           => $amt,
                            'metal_weight'     => floatval($p['metal_weight'] ?? 0),
                            'metal_purity'     => floatval($p['metal_purity'] ?? 100),
                            'metal_fine_wt'    => floatval($p['metal_fine_wt'] ?? 0),
                            'metal_rate'       => floatval($p['metal_rate'] ?? 0),
                            'reference_no'     => $p['reference_no'] ?? null,
                            'payment_details'  => $p['payment_details'] ?? null,
                            'transaction_date' => !empty($p['transaction_date']) ? Carbon::parse($p['transaction_date'])->format('Y-m-d') : ($request->purchase_date ?? date('Y-m-d')),
                        ]);
                        $totalPaid += $amt;
                    }
                }
            } else {
                $totalPaid += floatval($request->paid_amount ?? 0);
            }

            if ($goldPaymentAmt > 0) {
                $purchase->payments()->create([
                    'firm_id'          => $firmId,
                    'payment_method'   => 'gold',
                    'amount'           => $goldPaymentAmt,
                    'metal_weight'     => floatval($request->gold_payment_grams ?? 0),
                    'metal_purity'     => floatval($request->gold_payment_purity ?? 100),
                    'metal_fine_wt'    => floatval($request->gold_payment_fine_wt ?? 0),
                    'metal_rate'       => floatval($request->gold_payment_rate ?? 0),
                    'reference_no'     => 'GOLD-PAYMENT',
                    'payment_details'  => 'Gold Metal Payment (' . floatval($request->gold_payment_grams ?? 0) . 'g @ ' . floatval($request->gold_payment_purity ?? 100) . '%)',
                    'transaction_date' => $request->purchase_date ?? date('Y-m-d'),
                ]);
            }

            $paymentStatus = 'unpaid';
            if ($totalPaid >= $grandTotal && $grandTotal > 0) {
                $paymentStatus = 'paid';
            } elseif ($totalPaid > 0) {
                $paymentStatus = 'partial';
            }

            $purchase->update([
                'paid_amount'    => $totalPaid,
                'payment_status' => $paymentStatus,
            ]);

            // 4. Accounting Entry Integration
            try {
                app(AccountingService::class)->postRetailPurchase($purchase);
            } catch (\Exception $e) {
                \Log::error("Accounting Entry post failed for Retail Purchase #{$purchase->id}: " . $e->getMessage());
            }
        });

        return redirect()->route('purchases.index')->with('success', "Wholesale Purchase #{$purchase->purchase_no} created and stock updated successfully!");
    }

    /**
     * Display specified retail purchase.
     */
    public function show($id)
    {
        $adminId = Auth::guard('admin')->id() ?? auth()->id();
        $purchase = RetailPurchase::with([
            'supplier',
            'items.product',
            'items.category',
            'items.subcategory',
            'items.purity',
            'items.packetItems',
            'payments'
        ])
            ->where('admin_id', $adminId)
            ->findOrFail($id);

        $business = \App\Models\BusinessDetail::where('user_id', $adminId)->first();
        $bank = \App\Models\bankdetails::where('user_id', $adminId)->first();

        // Get purchase template settings
        $templateSettings = \App\Models\PurchaseTemplateSetting::getSettingsForAdmin($adminId);

        // Get custom blocks
        $customBlocks = \App\Models\InvoiceTemplateCustomBlock::where('admin_id', $adminId)
            ->where('is_visible', true)
            ->orderBy('display_order')
            ->get();

        if (request()->has('pdf')) {
            return view('Purchases.retail-purchases.show', compact('purchase', 'business', 'bank', 'templateSettings', 'customBlocks'));
        }

        return view('Purchases.retail-purchases.show', compact('purchase', 'business', 'bank', 'templateSettings', 'customBlocks'));
    }

    /**
     * Show form for editing retail purchase.
     */
    public function edit($id)
    {
        $adminId = Auth::guard('admin')->id();
        $purchase = RetailPurchase::with(['items.packetItems', 'payments'])->where('admin_id', $adminId)->findOrFail($id);
        $suppliers = Supplier::where('admin_id', $adminId)->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $purities = PurityModel::all();
        $metalRates = MetalRate::all();
        $products = Product::with(['packets'])->get();

        // Master attributes for packets
        $packetMasters = PacketMaster::with(['stone', 'clarity', 'color', 'cut', 'shape', 'chalni', 'mm'])->get();
        $packetTypes = PacketType::all();
        $stones = Stone::all();
        $clarities = Clarity::all();
        $colors = Color::all();
        $cuts = Cut::all();
        $shapes = Shape::all();
        $mms = Mm::all();
        $accounts = Account::with('group')->get();

        return view('Purchases.retail-purchases.edit', compact(
            'purchase', 'suppliers', 'categories', 'subcategories', 'purities', 'metalRates', 'products',
            'packetMasters', 'packetTypes', 'stones', 'clarities', 'colors', 'cuts', 'shapes', 'mms', 'accounts'
        ));
    }

    /**
     * Update retail purchase, reverse old stock, apply new stock.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id'          => 'nullable|exists:suppliers,id',
            'purchase_no'          => 'nullable|string|max:100',
            'purchase_date'        => 'required|date',
            'items'                => 'required|array|min:1',
            'items.*.item_name'    => 'required|string|max:255',
            'items.*.quantity'     => 'required|numeric|min:0.01',
            'items.*.purchase_rate' => 'required|numeric|min:0',
        ]);

        $adminId = Auth::guard('admin')->id();
        $purchase = RetailPurchase::where('admin_id', $adminId)->findOrFail($id);

        try {
            app(WholesaleStockService::class)->validatePurchaseCanBeReversed($purchase);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }

        DB::transaction(function () use ($request, $purchase, $adminId) {

            // Step 1: REVERSE old Wholesale Stock impact
            app(WholesaleStockService::class)->reverseWholesalePurchase($purchase);

            // Delete old packet items & line items
            RetailPurchasePacketItem::where('retail_purchase_id', $purchase->id)->delete();
            RetailPurchaseItem::where('retail_purchase_id', $purchase->id)->delete();

            // Step 2: Calculate Summary Totals for new submission
            $subtotal = 0;
            foreach ($request->items as $itemData) {
                $qty = floatval($itemData['quantity'] ?? 1);
                $rate = floatval($itemData['purchase_rate'] ?? 0);
                $making = floatval($itemData['making_final_amount'] ?? $itemData['making_price'] ?? 0);
                $stoneAmt = floatval($itemData['stone_amount'] ?? 0);
                $diamondAmt = floatval($itemData['diamond_amount'] ?? 0);
                $packetAmt = floatval($itemData['packet_amount'] ?? 0);
                $itemDiscount = floatval($itemData['discount_amount'] ?? 0);

                $netWt = floatval($itemData['net_weight'] ?? 0);
                $metalAmt = ($netWt > 0) ? ($netWt * $rate) : ($qty * $rate);
                $wastagePerc = floatval($itemData['wastage_percent'] ?? 0);
                $wastageAmt = ($netWt > 0 && $wastagePerc > 0) ? (($netWt * $wastagePerc / 100) * $rate) : 0;
                $lineTotal = max(0, ($metalAmt + $wastageAmt + $making + $stoneAmt + $diamondAmt + $packetAmt) - $itemDiscount);

                $subtotal += $lineTotal;
            }

            $discountAmount = floatval($request->discount_amount ?? 0);
            if (empty($discountAmount) && !empty($request->discount_percent)) {
                $discountAmount = ($subtotal * floatval($request->discount_percent)) / 100;
            }

            $taxableAmount = max(0, $subtotal - $discountAmount);

            $cgstPercent = floatval($request->cgst_percent ?? 0);
            $sgstPercent = floatval($request->sgst_percent ?? 0);
            $igstPercent = floatval($request->igst_percent ?? 0);

            $cgstAmount = ($taxableAmount * $cgstPercent) / 100;
            $sgstAmount = ($taxableAmount * $sgstPercent) / 100;
            $igstAmount = ($taxableAmount * $igstPercent) / 100;

            $otherCharges = floatval($request->other_charges ?? 0);
            $rawGrandTotal = $taxableAmount + $cgstAmount + $sgstAmount + $igstAmount + $otherCharges;

            $grandTotal = round($rawGrandTotal);
            $roundOff = round($grandTotal - $rawGrandTotal, 2);

            $paidAmount = floatval($request->paid_amount ?? 0);
            $paymentStatus = 'unpaid';
            if ($paidAmount >= $grandTotal && $grandTotal > 0) {
                $paymentStatus = 'paid';
            } elseif ($paidAmount > 0) {
                $paymentStatus = 'partial';
            }

            // Step 3: Update Purchase Header
            $purchase->update([
                'supplier_id'            => $request->supplier_id,
                'purchase_no'            => $request->purchase_no ?? $purchase->purchase_no,
                'reference_no'           => $request->reference_no,
                'purchase_date'          => $request->purchase_date,
                'due_date'               => $request->due_date,
                'status'                 => $request->status ?? 'completed',
                'subtotal'               => $subtotal,
                'discount_percent'       => $request->discount_percent ?? 0,
                'discount_amount'        => $discountAmount,
                'taxable_amount'         => $taxableAmount,
                'cgst_percent'           => $cgstPercent,
                'cgst_amount'            => $cgstAmount,
                'sgst_percent'           => $sgstPercent,
                'sgst_amount'            => $sgstAmount,
                'igst_percent'           => $igstPercent,
                'igst_amount'            => $igstAmount,
                'other_charges'          => $otherCharges,
                'round_off'              => $roundOff,
                'grand_total'            => $grandTotal,
                'paid_amount'            => $paidAmount,
                'payment_status'         => $paymentStatus,
                'payment_method'         => $request->payment_method ?? 'cash',
                'gold_payment_grams'     => floatval($request->gold_payment_grams ?? 0),
                'gold_payment_purity'    => floatval($request->gold_payment_purity ?? 100),
                'gold_payment_fine_wt'   => floatval($request->gold_payment_fine_wt ?? 0),
                'gold_payment_rate'      => floatval($request->gold_payment_rate ?? 0),
                'gold_payment_amount'    => floatval($request->gold_payment_amount ?? 0),
                'remaining_metal_wt'     => floatval($request->remaining_metal_wt ?? 0),
                'remaining_metal_amount' => floatval($request->remaining_metal_amount ?? 0),
                'notes'                  => $request->notes,
            ]);

            // Step 4: Create New Purchase Items and Apply NEW Wholesale Stock
            foreach ($request->items as $itemData) {
                $packetWt = 0;
                $packetAmt = 0;
                $packetsData = $itemData['packets'] ?? [];

                foreach ($packetsData as $pkt) {
                    $pktWt = floatval($pkt['wt_in_gram'] ?? $pkt['weight'] ?? 0);
                    $pktAmt = floatval($pkt['amount'] ?? 0);
                    if ($pktAmt <= 0 && $pktWt > 0 && !empty($pkt['rate'])) {
                        $pktAmt = $pktWt * floatval($pkt['rate']);
                    }
                    $packetWt += $pktWt;
                    $packetAmt += $pktAmt;
                }

                $grossWt = floatval($itemData['gross_weight'] ?? 0);
                $stoneWt = floatval($itemData['stone_weight'] ?? 0);
                $diamondWt = floatval($itemData['diamond_weight'] ?? 0);
                $netWt = floatval($itemData['net_weight'] ?? 0);

                if ($netWt <= 0 && $grossWt > 0) {
                    $netWt = max(0, $grossWt - ($stoneWt * 0.2) - ($diamondWt * 0.2) - $packetWt);
                }

                $wastagePerc = floatval($itemData['wastage_percent'] ?? 0);
                $fineWt = floatval($itemData['final_fn_weight'] ?? 0);
                if ($fineWt <= 0 && $netWt > 0) {
                    $fineWt = $netWt + (($netWt * $wastagePerc) / 100);
                }

                $qty = floatval($itemData['quantity'] ?? 1);
                $rate = floatval($itemData['purchase_rate'] ?? 0);
                $making = floatval($itemData['making_final_amount'] ?? $itemData['making_price'] ?? 0);
                $stoneAmt = floatval($itemData['stone_amount'] ?? 0);
                $diamondAmt = floatval($itemData['diamond_amount'] ?? 0);
                $itemDiscount = floatval($itemData['discount_amount'] ?? 0);

                $metalAmt = ($netWt > 0) ? ($netWt * $rate) : ($qty * $rate);
                $wastageAmt = ($netWt > 0 && $wastagePerc > 0) ? (($netWt * $wastagePerc / 100) * $rate) : 0;
                $lineTotal = max(0, ($metalAmt + $wastageAmt + $making + $stoneAmt + $diamondAmt + $packetAmt) - $itemDiscount);

                $newItem = RetailPurchaseItem::create([
                    'admin_id'             => $adminId,
                    'firm_id'              => $purchase->firm_id,
                    'retail_purchase_id'   => $purchase->id,
                    'product_id'           => null,
                    'item_product_data_id' => null,
                    'category_id'          => $itemData['category_id'] ?? null,
                    'subcategory_id'       => $itemData['subcategory_id'] ?? null,
                    'purity_id'            => $itemData['purity_id'] ?? null,
                    'item_name'            => $itemData['item_name'],
                    'pre_code'             => $itemData['pre_code'] ?? null,
                    'post_code'            => $itemData['post_code'] ?? null,
                    'barcode'              => $itemData['barcode'] ?? null,
                    'quantity'             => $qty,
                    'unit'                 => $itemData['unit'] ?? 'GM',
                    'size'                 => $itemData['size'] ?? null,
                    'gross_weight'         => $grossWt,
                    'stone_weight'         => $stoneWt,
                    'diamond_weight'       => $diamondWt,
                    'packet_weight'        => $packetWt,
                    'net_weight'           => $netWt,
                    'wastage_percent'      => $wastagePerc,
                    'final_fn_weight'      => $fineWt,
                    'purchase_rate'        => $rate,
                    'metal_amount'         => $metalAmt,
                    'making_price'         => floatval($itemData['making_price'] ?? 0),
                    'making_type'          => $itemData['making_type'] ?? null,
                    'making_final_amount'  => $making,
                    'stone_amount'         => $stoneAmt,
                    'diamond_amount'       => $diamondAmt,
                    'packet_amount'        => $packetAmt,
                    'discount_amount'      => $itemDiscount,
                    'gst_percent'          => floatval($itemData['gst_percent'] ?? 0),
                    'gst_amount'           => floatval($itemData['gst_amount'] ?? 0),
                    'total_amount'         => $lineTotal,
                ]);

                // Create Packet Items
                foreach ($packetsData as $pkt) {
                    if (!empty($pkt['packet_no']) || !empty($pkt['pcs']) || !empty($pkt['weight'])) {
                        RetailPurchasePacketItem::create([
                            'admin_id'                => $adminId,
                            'firm_id'                 => $purchase->firm_id,
                            'retail_purchase_id'      => $purchase->id,
                            'retail_purchase_item_id' => $newItem->id,
                            'packet_no'               => $pkt['packet_no'] ?? null,
                            'packet_type'             => $pkt['packet_type'] ?? 'Diamond',
                            'pcs'                     => $pkt['pcs'] ?? 0,
                            'stone'                   => $pkt['stone'] ?? null,
                            'clarity'                 => $pkt['clarity'] ?? null,
                            'color'                   => $pkt['color'] ?? null,
                            'cut'                     => $pkt['cut'] ?? null,
                            'shape'                   => $pkt['shape'] ?? null,
                            'mm'                      => $pkt['mm'] ?? null,
                            'chalni'                  => $pkt['chalni'] ?? null,
                            'solitaire'               => !empty($pkt['solitaire']) ? 1 : 0,
                            'rate'                    => floatval($pkt['rate'] ?? 0),
                            'amount'                  => floatval($pkt['amount'] ?? 0),
                            'weight'                  => floatval($pkt['weight'] ?? 0),
                            'wt_in_gram'              => floatval($pkt['wt_in_gram'] ?? $pkt['weight'] ?? 0),
                            'uom'                     => $pkt['uom'] ?? 'CARAT',
                            'certificate_no'          => $pkt['certificate_no'] ?? null,
                        ]);
                    }
                }

                // Add item stock into Wholesale Stock & Batch
                app(WholesaleStockService::class)->addPurchaseItemToWholesaleStock($purchase, $newItem, $itemData);
            }

            // Step 5: Save Payment Breakdown Entries
            $goldPaymentAmt = floatval($request->gold_payment_amount ?? 0);
            $totalPaid = $goldPaymentAmt;

            if ($request->filled('payments') && is_array($request->payments)) {
                $purchase->payments()->delete();
                foreach ($request->payments as $p) {
                    $amt = floatval($p['amount'] ?? 0);
                    if ($amt > 0) {
                        $purchase->payments()->create([
                            'firm_id'          => $purchase->firm_id,
                            'account_id'       => !empty($p['account_id']) ? $p['account_id'] : null,
                            'payment_method'   => $p['payment_method'] ?? 'cash',
                            'amount'           => $amt,
                            'metal_weight'     => floatval($p['metal_weight'] ?? 0),
                            'metal_purity'     => floatval($p['metal_purity'] ?? 100),
                            'metal_fine_wt'    => floatval($p['metal_fine_wt'] ?? 0),
                            'metal_rate'       => floatval($p['metal_rate'] ?? 0),
                            'reference_no'     => $p['reference_no'] ?? null,
                            'payment_details'  => $p['payment_details'] ?? null,
                            'transaction_date' => !empty($p['transaction_date']) ? Carbon::parse($p['transaction_date'])->format('Y-m-d') : ($request->purchase_date ?? date('Y-m-d')),
                        ]);
                        $totalPaid += $amt;
                    }
                }
            } else {
                $totalPaid += floatval($request->paid_amount ?? 0);
            }

            if ($goldPaymentAmt > 0) {
                $purchase->payments()->create([
                    'firm_id'          => $purchase->firm_id,
                    'payment_method'   => 'gold',
                    'amount'           => $goldPaymentAmt,
                    'metal_weight'     => floatval($request->gold_payment_grams ?? 0),
                    'metal_purity'     => floatval($request->gold_payment_purity ?? 100),
                    'metal_fine_wt'    => floatval($request->gold_payment_fine_wt ?? 0),
                    'metal_rate'       => floatval($request->gold_payment_rate ?? 0),
                    'reference_no'     => 'GOLD-PAYMENT',
                    'payment_details'  => 'Gold Payment (' . floatval($request->gold_payment_grams ?? 0) . 'g @ ' . floatval($request->gold_payment_purity ?? 100) . '%)',
                    'transaction_date' => $request->purchase_date ?? date('Y-m-d'),
                ]);
            }

            $paymentStatus = 'unpaid';
            if ($totalPaid >= $grandTotal && $grandTotal > 0) {
                $paymentStatus = 'paid';
            } elseif ($totalPaid > 0) {
                $paymentStatus = 'partial';
            }

            $purchase->update([
                'paid_amount'    => $totalPaid,
                'payment_status' => $paymentStatus,
            ]);

            // Step 6: Update Accounting Entries
            try {
                app(AccountingService::class)->postRetailPurchase($purchase);
            } catch (\Exception $e) {
                \Log::error("Accounting Entry update failed for Retail Purchase #{$purchase->id}: " . $e->getMessage());
            }
        });

        return redirect()->route('purchases.index')->with('success', "Wholesale Purchase #{$purchase->purchase_no} updated successfully!");
    }

    /**
     * Delete/cancel retail purchase and reverse stock.
     */
    public function destroy($id)
    {
        $adminId = Auth::guard('admin')->id();
        $purchase = RetailPurchase::where('admin_id', $adminId)->findOrFail($id);

        try {
            app(WholesaleStockService::class)->validatePurchaseCanBeReversed($purchase);
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        DB::transaction(function () use ($purchase) {
            // Reverse Wholesale Stock
            app(WholesaleStockService::class)->reverseWholesalePurchase($purchase);

            // Delete associated Packets
            RetailPurchasePacketItem::where('retail_purchase_id', $purchase->id)->delete();

            // Remove Accounting Entry
            try {
                app(AccountingService::class)->deleteRetailPurchaseEntry($purchase);
            } catch (\Exception $e) {
                \Log::error("Failed deleting journal entry for Purchase #{$purchase->id}: " . $e->getMessage());
            }

            // Soft delete Purchase
            $purchase->delete();
        });

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Wholesale Purchase #{$purchase->purchase_no} deleted and wholesale stock reversed successfully!",
            ]);
        }

        return redirect()->route('purchases.index')->with('success', "Wholesale Purchase #{$purchase->purchase_no} deleted and wholesale stock reversed successfully!");
    }
}
