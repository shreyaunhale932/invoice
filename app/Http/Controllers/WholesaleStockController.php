<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InventoryTransaction;
use App\Models\ItemProductData;
use App\Models\MetalRate;
use App\Models\PrintTemplate;
use App\Models\Product;
use App\Models\ProductPacket;
use App\Models\PurityModel;
use App\Models\Subcategory;
use App\Models\WholesaleStock;
use App\Models\WholesaleStockBatch;
use App\Services\TaggingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;

class WholesaleStockController extends Controller
{
    /**
     * Display listing of wholesale stock and Lot to Tag conversion interface.
     */
    public function index(Request $request)
    {
        $adminId = Auth::guard('admin')->id();

        // Reconcile wholesale stocks with active batches to ensure 100% accurate balances
        $allStocks = WholesaleStock::where('admin_id', $adminId)->get();
        foreach ($allStocks as $stk) {
            \App\Services\WholesaleStockService::reconcileStock($stk);
        }

        $query = WholesaleStock::with(['category', 'subcategory', 'purity', 'batches.supplier'])
            ->where('admin_id', $adminId);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('subcategory_id')) {
            $query->where('subcategory_id', $request->subcategory_id);
        }
        if ($request->filled('purity_id')) {
            $query->where('purity_id', $request->purity_id);
        }
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('item_name', 'like', "%{$search}%")
                  ->orWhere('pre_code', 'like', "%{$search}%");
            });
        }

        $wholesaleStocks = $query->latest('updated_at')->paginate(15);

        // Master data for Add Product Form
        $categories = Category::where('admin_id', $adminId)->orderBy('category_id', 'DESC')->get();
        if ($categories->isEmpty()) {
            $categories = Category::all();
        }

        $subcategories = Subcategory::where('admin_id', $adminId)->orderBy('subcategory_id', 'DESC')->get();
        if ($subcategories->isEmpty()) {
            $subcategories = Subcategory::all();
        }

        $purities = PurityModel::where('admin_id', $adminId)->orderBy('id', 'DESC')->get();
        if ($purities->isEmpty()) {
            $purities = PurityModel::all();
        }

        $metalRates = MetalRate::where('admin_id', $adminId)->orderBy('id', 'DESC')->get();
        if ($metalRates->isEmpty()) {
            $metalRates = MetalRate::all();
        }

        // Available lots for conversion (available_quantity > 0 or available_net_weight > 0)
        $availableStocks = WholesaleStock::with(['category', 'subcategory', 'purity', 'batches.supplier'])
            ->where('admin_id', $adminId)
            ->where(function ($q) {
                $q->where('available_quantity', '>', 0)
                  ->orWhere('available_net_weight', '>', 0);
            })
            ->latest('updated_at')
            ->get();

        $selectedStockId = $request->query('stock_id');

        // Next Barcode calculation matching Add Product form logic
        $lastBarcode = Product::where('admin_id', $adminId)
            ->orderBy('id', 'DESC')
            ->value('barcode');

        if ($lastBarcode) {
            if (ctype_digit($lastBarcode)) {
                $newBarcode = (int)$lastBarcode + 1;
            } else {
                preg_match('/^([A-Za-z]+)(\d+)$/', $lastBarcode, $matches);
                if (count($matches) == 3) {
                    $prefix = $matches[1];
                    $number = $matches[2];
                    $incremented = (int)$number + 1;
                    $newNumber = str_pad($incremented, strlen($number), '0', STR_PAD_LEFT);
                    $newBarcode = $prefix . $newNumber;
                } else {
                    $newBarcode = 1001;
                }
            }
        } else {
            $newBarcode = 1001;
        }

        // Packet master options for Packets section
        $stones = \App\Models\Stone::all();
        $clarities = \App\Models\Clarity::all();
        $colors = \App\Models\Color::all();
        $cuts = \App\Models\Cut::all();
        $mms = \App\Models\Mm::all();
        $chalnis = \App\Models\Chalni::all();
        $shapes = \App\Models\Shape::all();
        $packet_types = \App\Models\PacketType::all();

        return view('Inventory.wholesale-stock.index', compact(
            'wholesaleStocks',
            'availableStocks',
            'selectedStockId',
            'categories',
            'subcategories',
            'purities',
            'metalRates',
            'newBarcode',
            'stones',
            'clarities',
            'colors',
            'cuts',
            'mms',
            'chalnis',
            'shapes',
            'packet_types'
        ));
    }

    /**
     * Get active batches and stock metadata for a specific wholesale stock item via JSON.
     */
    public function getBatches($id)
    {
        $adminId = Auth::guard('admin')->id();
        $wholesaleStock = WholesaleStock::with(['category', 'subcategory', 'purity'])
            ->where('admin_id', $adminId)
            ->findOrFail($id);

        \App\Services\WholesaleStockService::reconcileStock($wholesaleStock);
        $wholesaleStock->refresh();

        $batches = WholesaleStockBatch::with(['supplier', 'retailPurchase'])
            ->where('wholesale_stock_id', $wholesaleStock->id)
            ->where(function($q) {
                $q->where('remaining_quantity', '>', 0)
                  ->orWhere('remaining_net_weight', '>', 0);
            })
            ->get()
            ->map(function ($batch) {
                return [
                    'id'                     => $batch->id,
                    'supplier_name'          => optional($batch->supplier)->name ?? 'N/A',
                    'purchase_no'            => optional($batch->retailPurchase)->purchase_no ?? 'N/A',
                    'purchase_date'          => $batch->purchase_date ? $batch->purchase_date->format('d/m/Y') : '',
                    'purchase_rate'          => $batch->purchase_rate,
                    'making_price'           => $batch->making_price,
                    'making_type'            => $batch->making_type,
                    'wastage_percent'        => $batch->wastage_percent ?? 0,
                    'sale_price'             => $batch->sale_price ?? ($batch->purchase_rate ?? 0),
                    'remaining_quantity'     => $batch->remaining_quantity,
                    'remaining_gross_weight' => $batch->remaining_gross_weight,
                    'remaining_net_weight'   => $batch->remaining_net_weight,
                    'remaining_fine_weight'  => $batch->remaining_fine_weight,
                ];
            });

        return response()->json([
            'wholesale_stock' => [
                'id'                     => $wholesaleStock->id,
                'item_name'              => $wholesaleStock->item_name,
                'pre_code'               => $wholesaleStock->pre_code,
                'category_id'            => $wholesaleStock->category_id,
                'category_name'          => optional($wholesaleStock->category)->category_name ?? '',
                'subcategory_id'         => $wholesaleStock->subcategory_id,
                'subcategory_name'       => optional($wholesaleStock->subcategory)->subcategory_name ?? '',
                'purity_id'              => $wholesaleStock->purity_id,
                'purity_name'            => optional($wholesaleStock->purity)->purity_name ?? '',
                'purity_value'           => optional($wholesaleStock->purity)->purity_value ?? '',
                'purity_type'            => optional($wholesaleStock->purity)->purity_type ?? '',
                'available_quantity'     => $wholesaleStock->available_quantity,
                'available_gross_weight' => $wholesaleStock->available_gross_weight,
                'available_net_weight'   => $wholesaleStock->available_net_weight,
                'available_fine_weight'  => $wholesaleStock->available_fine_weight,
            ],
            'batches' => $batches,
        ]);
    }

    /**
     * Convert Wholesale Lot Stock into Retail Tagged Product via the Add Product Form.
     */
    public function convertTag(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        $firmId  = auth()->user()->firm_id ?? null;

        $request->validate([
            'wholesale_stock_id' => 'required|exists:wholesale_stocks,id',
            'batch_id'           => 'nullable|exists:wholesale_stock_batches,id',
            'pre_code'           => 'required|string',
            'post_code'          => 'required|string',
            'product_name'       => 'required|string',
            'category_id'        => 'required',
            'subcategory_id'     => 'required',
            'metal_rate_id'      => 'required',
            'gross_weight'       => 'required|numeric|min:0.001',
            'net_weight'         => 'required|numeric|min:0.001',
            'quantity'           => 'required|numeric|min:1',
            'barcode'            => 'nullable|unique:products,barcode,NULL,id,firm_id,' . ($firmId ?? 'NULL'),
        ]);

        $preCode = strtoupper(trim($request->pre_code));
        $postCode = trim($request->post_code);

        $createdProduct = null;

        try {
            DB::transaction(function () use ($request, $adminId, $firmId, $preCode, $postCode, &$createdProduct) {
                // 1. Lock WholesaleStock for update
                $wholesaleStock = WholesaleStock::where('admin_id', $adminId)
                    ->lockForUpdate()
                    ->findOrFail($request->wholesale_stock_id);

                $tagQty   = floatval($request->quantity ?? 1);
                $tagGross = floatval($request->gross_weight ?? 0);
                $tagNet   = floatval($request->net_weight ?? 0);
                $tagFine  = floatval($request->final_fn_weight ?? $tagNet);

                // Stock limit validations
                if ($tagQty > $wholesaleStock->available_quantity) {
                    throw new \Exception("Requested quantity ({$tagQty}) exceeds available lot quantity ({$wholesaleStock->available_quantity} Pcs).");
                }
                if ($tagNet > ($wholesaleStock->available_net_weight + 0.005)) {
                    throw new \Exception("Requested net weight ({$tagNet}g) exceeds available lot net weight ({$wholesaleStock->available_net_weight}g).");
                }

                // 2. Select / lock Batch
                $batch = null;
                if ($request->filled('batch_id')) {
                    $batch = WholesaleStockBatch::where('wholesale_stock_id', $wholesaleStock->id)
                        ->lockForUpdate()
                        ->findOrFail($request->batch_id);

                    if ($tagQty > $batch->remaining_quantity) {
                        throw new \Exception("Requested quantity exceeds selected supplier batch balance ({$batch->remaining_quantity} Pcs).");
                    }
                    if ($tagNet > ($batch->remaining_net_weight + 0.005)) {
                        throw new \Exception("Requested net weight exceeds selected supplier batch balance ({$batch->remaining_net_weight}g).");
                    }
                } else {
                    // FIFO auto-selection
                    $batch = WholesaleStockBatch::where('wholesale_stock_id', $wholesaleStock->id)
                        ->where('remaining_quantity', '>', 0)
                        ->orderBy('purchase_date', 'asc')
                        ->orderBy('id', 'asc')
                        ->lockForUpdate()
                        ->first();
                }

                // 3. Deduct from WholesaleStock
                $wholesaleStock->available_quantity     = max(0, $wholesaleStock->available_quantity - $tagQty);
                $wholesaleStock->available_gross_weight = max(0, $wholesaleStock->available_gross_weight - $tagGross);
                $wholesaleStock->available_net_weight   = max(0, $wholesaleStock->available_net_weight - $tagNet);
                $wholesaleStock->available_fine_weight  = max(0, $wholesaleStock->available_fine_weight - $tagFine);
                $wholesaleStock->save();

                // 4. Deduct from Batch
                if ($batch) {
                    $batch->remaining_quantity     = max(0, $batch->remaining_quantity - $tagQty);
                    $batch->remaining_gross_weight = max(0, $batch->remaining_gross_weight - $tagGross);
                    $batch->remaining_net_weight   = max(0, $batch->remaining_net_weight - $tagNet);
                    $batch->remaining_fine_weight  = max(0, $batch->remaining_fine_weight - $tagFine);
                    $batch->save();
                }

                \App\Services\WholesaleStockService::reconcileStock($wholesaleStock);

                // 5. Log InventoryTransaction OUT for Wholesale Stock Lot
                InventoryTransaction::create([
                    'admin_id'                 => $adminId,
                    'firm_id'                  => $firmId ?? $wholesaleStock->firm_id,
                    'item_product_data_id'     => $wholesaleStock->item_product_data_id,
                    'wholesale_stock_id'       => $wholesaleStock->id,
                    'wholesale_stock_batch_id' => $batch ? $batch->id : null,
                    'retail_purchase_id'       => $batch ? $batch->retail_purchase_id : null,
                    'retail_purchase_item_id'  => $batch ? $batch->retail_purchase_item_id : null,
                    'type'                     => 'OUT',
                    'quantity'                 => $tagQty,
                    'gross_weight'             => $tagGross,
                    'net_weight'               => $tagNet,
                    'final_fn_weight'          => $tagFine,
                    'unit'                     => 'GM',
                    'remarks'                  => "Wholesale Stock Lot #{$wholesaleStock->id} ({$wholesaleStock->pre_code}) converted to Retail Tag via Lot to Tag",
                ]);

                // 6. Find or create ItemProductData
                $itemProductData = ItemProductData::firstOrCreate(
                    [
                        'product_code' => $preCode,
                        'product_name' => $request->product_name,
                    ],
                    [
                        'admin_id'            => $adminId,
                        'purity_id'           => $request->purity_id,
                        'barcode'             => $request->barcode,
                        'category_id'         => $request->category_id,
                        'subcategory_id'      => $request->subcategory_id,
                        'metal_rate'          => $request->metal_rate_id,
                        'hsn_code'            => $request->hsn_code,
                        'gold_purity'         => $request->gold_color,
                        'gross_weight'        => $request->gross_weight,
                        'net_weight'          => $request->net_weight,
                        'final_fn_weight'     => $request->final_fn_weight,
                        'wastage_percent'     => $request->wastage_percent,
                        'wastage_amount'      => $request->wastage_amount,
                        'making_price'        => $request->making_price,
                        'gold_price'          => $request->gold_price,
                        'final_price'         => $request->final_price,
                        'making_type'         => $request->making_type,
                        'making_final_amount' => $request->making_final_amount,
                    ]
                );

                // 7. Calculate Post Code
                $oldProduct = Product::withTrashed()
                    ->where('item_product_data_id', $itemProductData->id)
                    ->orderByDesc('post_code')
                    ->first();

                if ($oldProduct && is_numeric($oldProduct->post_code)) {
                    $postid = str_pad((intval($oldProduct->post_code) + 1), 4, '0', STR_PAD_LEFT);
                } else {
                    $postid = $postCode ?: '0001';
                }

                // Barcode
                $barcode = trim($request->barcode ?? '');
                if (empty($barcode)) {
                    $barcode = $preCode . $postid;
                    while (Product::where('barcode', $barcode)->where('firm_id', $firmId)->exists()) {
                        $postid = str_pad((intval($postid) + 1), 4, '0', STR_PAD_LEFT);
                        $barcode = $preCode . $postid;
                    }
                }

                // 8. Create Retail Product
                $createdProduct = Product::create([
                    'admin_id'                 => $adminId,
                    'firm_id'                  => $firmId ?? $wholesaleStock->firm_id,
                    'item_product_data_id'     => $itemProductData->id,
                    'wholesale_stock_id'       => $wholesaleStock->id,
                    'wholesale_stock_batch_id' => $batch ? $batch->id : null,
                    'retail_purchase_id'       => $batch ? $batch->retail_purchase_id : null,
                    'retail_purchase_item_id'  => $batch ? $batch->retail_purchase_item_id : null,
                    'supplier_id'              => $batch ? $batch->supplier_id : null,
                    'product_name'             => $request->product_name,
                    'pre_code'                 => $preCode,
                    'post_code'                => $postid,
                    'barcode'                  => $barcode,
                    'category_id'              => $request->category_id,
                    'subcategory_id'           => $request->subcategory_id,
                    'purity_id'                => $request->purity_id,
                    'metal_rate'               => $request->metal_rate_id,
                    'gross_weight'             => $request->gross_weight,
                    'net_weight'               => $request->net_weight,
                    'hsn_code'                 => $request->hsn_code,
                    'gold_color'               => $request->gold_color,
                    'wastage_percent'          => $request->wastage_percent,
                    'wastage_amount'           => $request->wastage_amount,
                    'making_price'             => $request->making_price,
                    'gold_price'               => $request->gold_price,
                    'quantity'                 => $tagQty,
                    'final_fn_weight'          => $request->final_fn_weight,
                    'size'                     => $request->size,
                    'final_price'              => $request->final_price,
                    'making_type'              => $request->making_type,
                    'making_final_amount'      => $request->making_final_amount,
                    'hallmarking'              => $request->hallmarking,
                    'availability'             => 'available',
                    'tagged_at'                => now(),
                    'tagged_by'                => Auth::id(),
                ]);

                // 9. Handle Image Upload
                if ($request->hasFile('image')) {
                    $manager = new ImageManager(new GdDriver);
                    $file = $request->file('image');
                    $filename = 'Product_' . time() . '.' . $file->getClientOriginalExtension();
                    $image = $manager->read($file->getPathname());
                    $image->resize(500, 500);
                    $path = public_path('assets/products/' . $filename);
                    $image->toJpeg(90)->save($path);

                    $createdProduct->image = 'assets/products/' . $filename;
                    $createdProduct->save();
                }

                // 10. Handle Packets (Diamonds & Stones)
                if ($request->has('packet.packet_no')) {
                    foreach ($request->packet['packet_no'] as $index => $value) {
                        if (!empty($value)) {
                            ProductPacket::create([
                                'product_id'        => $createdProduct->id,
                                'packet_no'         => $value,
                                'packet_master_id'  => $request->packet['packet_master_id'][$index] ?? null,
                                'stone_id'          => $request->packet['stone_id'][$index] ?? null,
                                'clarity_id'        => $request->packet['clarity_id'][$index] ?? null,
                                'color_id'          => $request->packet['color_id'][$index] ?? null,
                                'cut_id'            => $request->packet['cut_id'][$index] ?? null,
                                'shape_id'          => $request->packet['shape_id'][$index] ?? null,
                                'chalni_id'         => $request->packet['chalni_id'][$index] ?? null,
                                'mm_id'             => $request->packet['mm_id'][$index] ?? null,
                                'weight'            => $request->packet['weight'][$index] ?? 0,
                                'wt_in_gram'        => $request->packet['wt_in_gram'][$index] ?? 0,
                                'pcs'               => $request->packet['pcs'][$index] ?? 0,
                                'amount'            => $request->packet['amount'][$index] ?? 0,
                                'uom'               => $request->packet['uom'][$index] ?? 'CT',
                                'rate'              => $request->packet['rate'][$index] ?? 0,
                                'solitaire'         => isset($request->packet['solitaire'][$index]) ? 1 : 0,
                                'certificate_no'    => $request->packet['certificate_no'][$index] ?? null,
                                'packet_type'       => $request->packet['packet_type'][$index] ?? 'Diamond',
                            ]);
                        }
                    }
                }

                // 11. Log InventoryTransaction for TAGGING_IN (Retail Stock)
                InventoryTransaction::create([
                    'admin_id'                 => $adminId,
                    'firm_id'                  => $firmId ?? $wholesaleStock->firm_id,
                    'product_id'               => $createdProduct->id,
                    'item_product_data_id'     => $itemProductData->id,
                    'wholesale_stock_id'       => $wholesaleStock->id,
                    'wholesale_stock_batch_id' => $batch ? $batch->id : null,
                    'retail_purchase_id'       => $batch ? $batch->retail_purchase_id : null,
                    'retail_purchase_item_id'  => $batch ? $batch->retail_purchase_item_id : null,
                    'type'                     => 'TAGGING_IN',
                    'quantity'                 => $tagQty,
                    'gross_weight'             => $tagGross,
                    'net_weight'               => $tagNet,
                    'final_fn_weight'          => $tagFine,
                    'unit'                     => 'GM',
                    'size'                     => $request->size,
                    'remarks'                  => "Retail Product Tag generated from Wholesale Lot #{$wholesaleStock->id}",
                ]);
            });

            $msg = "Wholesale Lot stock converted successfully into Retail Product ({$createdProduct->product_name} - Barcode: {$createdProduct->barcode})!";

            $defaultTemplate = PrintTemplate::where('is_default', true)->first();
            $redirect = redirect()->route('wholesale-stock.index', ['stock_id' => $request->wholesale_stock_id])
                ->with('success', $msg);

            if ($defaultTemplate && $createdProduct) {
                $redirect->with('print_template_id', $defaultTemplate->id)
                         ->with('print_product_id', $createdProduct->id);
            }

            return $redirect;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Process bulk tagging conversion request (Wholesale Stock -> Multiple Retail Tags).
     */
    public function processTagging(Request $request, $id)
    {
        $request->validate([
            'batch_id'                       => 'nullable|exists:wholesale_stock_batches,id',
            'tag_quantity'                   => 'required|integer|min:1',
            'piece_details'                  => 'required|array|min:1',
            'piece_details.*.gross_weight'   => 'required|numeric|min:0.001',
            'piece_details.*.net_weight'     => 'required|numeric|min:0.001',
            'piece_details.*.wastage_percent'=> 'nullable|numeric|min:0',
            'piece_details.*.making_price'   => 'nullable|numeric|min:0',
            'piece_details.*.sale_price'     => 'nullable|numeric|min:0',
        ]);

        $adminId = Auth::guard('admin')->id();
        $wholesaleStock = WholesaleStock::where('admin_id', $adminId)->findOrFail($id);

        $batch = null;
        if ($request->filled('batch_id')) {
            $batch = WholesaleStockBatch::where('wholesale_stock_id', $wholesaleStock->id)
                ->findOrFail($request->batch_id);
        }

        try {
            $createdProducts = app(TaggingService::class)->convertWholesaleToRetailTags(
                $wholesaleStock,
                $batch,
                $request->all()
            );

            $count = count($createdProducts);
            $msg = "Successfully converted {$count} Wholesale item(s) into Retail Tagged Stock!";

            if ($request->ajax()) {
                return response()->json([
                    'success'  => true,
                    'message'  => $msg,
                    'products' => $createdProducts,
                ]);
            }

            return redirect()->route('wholesale-stock.index')->with('success', $msg);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}

