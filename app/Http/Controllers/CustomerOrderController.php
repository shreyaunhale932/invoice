<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\Customer;
use App\Models\Karigar;
use App\Models\KarigarAssignment;
use App\Models\KarigarReceipt;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\PurityModel;
use App\Models\MetalRate;
use App\Models\Firm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CustomerOrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = CustomerOrder::with(['customer', 'karigar', 'category', 'latestAssignment']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('karigar_id')) {
            $query->where('karigar_id', $request->karigar_id);
        }

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('order_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('order_date', '<=', $request->to_date);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_no', 'like', "%{$search}%")
                  ->orWhere('item_name', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%");
                  })
                  ->orWhereHas('karigar', function($kq) use ($search) {
                      $kq->where('name', 'like', "%{$search}%")
                         ->orWhere('code', 'like', "%{$search}%");
                  });
            });
        }

        $totalOrders     = CustomerOrder::count();
        $pendingOrders   = CustomerOrder::where('status', 'pending')->count();
        $assignedOrders  = CustomerOrder::whereIn('status', ['assigned', 'in_progress'])->count();
        $receivedOrders  = CustomerOrder::where('status', 'received')->count();
        $deliveredOrders = CustomerOrder::where('status', 'delivered')->count();

        $orders = $query->latest('id')->paginate(15)->withQueryString();
        $karigars = Karigar::where('status', 'active')->orderBy('name')->get();

        return view('orders.index', compact(
            'orders',
            'karigars',
            'totalOrders',
            'pendingOrders',
            'assignedOrders',
            'receivedOrders',
            'deliveredOrders'
        ));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // Suggest next order number
        $year = date('Y');
        $lastOrder = CustomerOrder::withTrashed()
            ->where('order_no', 'like', "ORD-{$year}-%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastOrder && preg_match("/ORD-{$year}-(\d+)/", $lastOrder->order_no, $matches)) {
            $nextSeq = intval($matches[1]) + 1;
        } else {
            $nextSeq = 1;
        }
        $suggestedOrderNo = 'ORD-' . $year . '-' . str_pad($nextSeq, 4, '0', STR_PAD_LEFT);

        $customers = Customer::orderBy('name')->get();
        $categories = Category::with('subcategories')->get();
        $purities = PurityModel::all();
        $metalRates = MetalRate::latest()->get();
        $karigars = Karigar::where('status', 'active')->orderBy('name')->get();

        return view('orders.create', compact(
            'suggestedOrderNo',
            'customers',
            'categories',
            'purities',
            'metalRates',
            'karigars'
        ));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_no'               => 'required|string|max:50',
            'order_date'             => 'required|date',
            'due_date'               => 'nullable|date',
            'customer_id'            => 'required|exists:customers,id',
            'item_name'              => 'required|string|max:255',
            'category_id'            => 'nullable|exists:categories,category_id',
            'subcategory_id'         => 'nullable|exists:subcategories,subcategory_id',
            'metal_type'             => 'required|string|max:50',
            'purity'                 => 'nullable|string|max:50',
            'expected_gross_weight'  => 'nullable|numeric|min:0',
            'expected_net_weight'    => 'nullable|numeric|min:0',
            'size'                   => 'nullable|string|max:100',
            'priority'               => 'required|in:low,normal,high,urgent',
            'design_code'            => 'nullable|string|max:100',
            'image'                  => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'specifications'         => 'nullable|string',
            'estimated_rate'         => 'nullable|numeric|min:0',
            'estimated_making_charges'=> 'nullable|numeric|min:0',
            'estimated_other_charges'=> 'nullable|numeric|min:0',
            'estimated_total_amount' => 'nullable|numeric|min:0',
            'advance_amount'         => 'nullable|numeric|min:0',
            'advance_metal_weight'   => 'nullable|numeric|min:0',
            'advance_payment_mode'   => 'nullable|string|max:50',
            'notes'                  => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $dir = public_path('uploads/orders');
            if (!File::isDirectory($dir)) {
                File::makeDirectory($dir, 0755, true, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dir, $filename);
            $imagePath = 'uploads/orders/' . $filename;
        }

        $order = CustomerOrder::create([
            'admin_id'                => Auth::guard('admin')->id(),
            'order_no'                => $request->order_no,
            'order_date'              => $request->order_date,
            'due_date'                => $request->due_date,
            'customer_id'             => $request->customer_id,
            'item_name'               => $request->item_name,
            'category_id'             => $request->category_id,
            'subcategory_id'          => $request->subcategory_id,
            'metal_type'              => $request->metal_type,
            'purity'                  => $request->purity,
            'expected_gross_weight'   => $request->expected_gross_weight ?? 0,
            'expected_net_weight'     => $request->expected_net_weight ?? 0,
            'size'                    => $request->size,
            'priority'                => $request->priority ?? 'normal',
            'status'                  => 'pending',
            'design_code'             => $request->design_code,
            'image'                   => $imagePath,
            'specifications'          => $request->specifications,
            'estimated_rate'          => $request->estimated_rate ?? 0,
            'estimated_making_charges'=> $request->estimated_making_charges ?? 0,
            'estimated_other_charges' => $request->estimated_other_charges ?? 0,
            'estimated_total_amount'  => $request->estimated_total_amount ?? 0,
            'advance_amount'          => $request->advance_amount ?? 0,
            'advance_metal_weight'    => $request->advance_metal_weight ?? 0,
            'advance_payment_mode'    => $request->advance_payment_mode,
            'notes'                   => $request->notes,
        ]);

        // If user wants to immediately assign to karigar
        if ($request->filled('assign_immediately') && $request->assign_immediately == '1') {
            return redirect()->route('orders.assign.create', $order->id)
                ->with('success', 'Order created successfully! Now assign material to Karigar.');
        }

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order ' . $order->order_no . ' created successfully!');
    }

    /**
     * Display order details.
     */
    public function show($id)
    {
        $order = CustomerOrder::with([
            'customer',
            'karigar',
            'category',
            'subcategory',
            'assignments.karigar',
            'assignments.receipt',
            'receipts.karigar'
        ])->findOrFail($id);

        $activeAssignment = $order->assignments()
            ->whereIn('status', ['assigned', 'in_progress'])
            ->first();

        $activeReceipt = $order->receipts()->latest()->first();

        return view('orders.show', compact('order', 'activeAssignment', 'activeReceipt'));
    }

    /**
     * Show the form for editing an order.
     */
    public function edit($id)
    {
        $order = CustomerOrder::findOrFail($id);

        $customers = Customer::orderBy('name')->get();
        $categories = Category::with('subcategories')->get();
        $purities = PurityModel::all();
        $metalRates = MetalRate::latest()->get();

        return view('orders.edit', compact('order', 'customers', 'categories', 'purities', 'metalRates'));
    }

    /**
     * Update the specified order.
     */
    public function update(Request $request, $id)
    {
        $order = CustomerOrder::findOrFail($id);

        $request->validate([
            'order_date'             => 'required|date',
            'due_date'               => 'nullable|date',
            'customer_id'            => 'required|exists:customers,id',
            'item_name'              => 'required|string|max:255',
            'category_id'            => 'nullable|exists:categories,category_id',
            'subcategory_id'         => 'nullable|exists:subcategories,subcategory_id',
            'metal_type'             => 'required|string|max:50',
            'purity'                 => 'nullable|string|max:50',
            'expected_gross_weight'  => 'nullable|numeric|min:0',
            'expected_net_weight'    => 'nullable|numeric|min:0',
            'size'                   => 'nullable|string|max:100',
            'priority'               => 'required|in:low,normal,high,urgent',
            'design_code'            => 'nullable|string|max:100',
            'image'                  => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'specifications'         => 'nullable|string',
            'estimated_rate'         => 'nullable|numeric|min:0',
            'estimated_making_charges'=> 'nullable|numeric|min:0',
            'estimated_other_charges'=> 'nullable|numeric|min:0',
            'estimated_total_amount' => 'nullable|numeric|min:0',
            'advance_amount'         => 'nullable|numeric|min:0',
            'advance_metal_weight'   => 'nullable|numeric|min:0',
            'advance_payment_mode'   => 'nullable|string|max:50',
            'notes'                  => 'nullable|string',
        ]);

        $imagePath = $order->image;
        if ($request->hasFile('image')) {
            $dir = public_path('uploads/orders');
            if (!File::isDirectory($dir)) {
                File::makeDirectory($dir, 0755, true, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dir, $filename);
            $imagePath = 'uploads/orders/' . $filename;
        }

        $order->update([
            'order_date'              => $request->order_date,
            'due_date'                => $request->due_date,
            'customer_id'             => $request->customer_id,
            'item_name'               => $request->item_name,
            'category_id'             => $request->category_id,
            'subcategory_id'          => $request->subcategory_id,
            'metal_type'              => $request->metal_type,
            'purity'                  => $request->purity,
            'expected_gross_weight'   => $request->expected_gross_weight ?? 0,
            'expected_net_weight'     => $request->expected_net_weight ?? 0,
            'size'                    => $request->size,
            'priority'                => $request->priority,
            'design_code'             => $request->design_code,
            'image'                   => $imagePath,
            'specifications'          => $request->specifications,
            'estimated_rate'          => $request->estimated_rate ?? 0,
            'estimated_making_charges'=> $request->estimated_making_charges ?? 0,
            'estimated_other_charges' => $request->estimated_other_charges ?? 0,
            'estimated_total_amount'  => $request->estimated_total_amount ?? 0,
            'advance_amount'          => $request->advance_amount ?? 0,
            'advance_metal_weight'    => $request->advance_metal_weight ?? 0,
            'advance_payment_mode'    => $request->advance_payment_mode,
            'notes'                   => $request->notes,
        ]);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order ' . $order->order_no . ' updated successfully!');
    }

    /**
     * Remove the specified order.
     */
    public function destroy($id)
    {
        $order = CustomerOrder::findOrFail($id);

        if (in_array($order->status, ['assigned', 'in_progress'])) {
            return redirect()->route('orders.index')
                ->with('error', 'Cannot delete an order that is actively assigned to a Karigar! Please cancel assignment or receive first.');
        }

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }

    /**
     * Show the Assign to Karigar form.
     */
    public function assignForm($id)
    {
        $order = CustomerOrder::with(['customer', 'category', 'subcategory'])->findOrFail($id);

        if ($order->status === 'delivered') {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'Cannot assign an already delivered order.');
        }

        // Suggest next assignment number
        $year = date('Y');
        $lastAsg = KarigarAssignment::where('assignment_no', 'like', "ASG-{$year}-%")
            ->orderBy('id', 'desc')->first();

        if ($lastAsg && preg_match("/ASG-{$year}-(\d+)/", $lastAsg->assignment_no, $matches)) {
            $nextSeq = intval($matches[1]) + 1;
        } else {
            $nextSeq = 1;
        }
        $suggestedAsgNo = 'ASG-' . $year . '-' . str_pad($nextSeq, 4, '0', STR_PAD_LEFT);

        $karigars = Karigar::where('status', 'active')->orderBy('name')->get();
        $purities = PurityModel::all();

        return view('orders.assign', compact('order', 'suggestedAsgNo', 'karigars', 'purities'));
    }

    /**
     * Store Karigar Assignment.
     */
    public function assignStore(Request $request, $id)
    {
        $order = CustomerOrder::findOrFail($id);

        $request->validate([
            'karigar_id'                => 'required|exists:karigars,id',
            'assignment_no'             => 'required|string|max:50',
            'assigned_date'             => 'required|date',
            'expected_delivery_date'    => 'nullable|date',
            'metal_issued_type'         => 'required|string|max:100',
            'metal_issued_weight'       => 'required|numeric|min:0.001',
            'metal_issued_purity'       => 'nullable|string|max:50',
            'stones_issued_weight'      => 'nullable|numeric|min:0',
            'stones_issued_pieces'      => 'nullable|integer|min:0',
            'stones_issued_description' => 'nullable|string|max:255',
            'making_charge_type'        => 'required|in:per_gram,flat',
            'making_charge_rate'        => 'nullable|numeric|min:0',
            'allowed_wastage_percent'   => 'nullable|numeric|min:0|max:100',
            'instructions'              => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $issuedWeight = (float)$request->metal_issued_weight;
            $allowedPercent = (float)($request->allowed_wastage_percent ?? 0);
            $allowedWeight = $issuedWeight * ($allowedPercent / 100);

            $assignment = KarigarAssignment::create([
                'admin_id'                  => Auth::guard('admin')->id(),
                'customer_order_id'         => $order->id,
                'karigar_id'                => $request->karigar_id,
                'assignment_no'             => $request->assignment_no,
                'assigned_date'             => $request->assigned_date,
                'expected_delivery_date'    => $request->expected_delivery_date,
                'metal_issued_type'         => $request->metal_issued_type,
                'metal_issued_weight'       => $issuedWeight,
                'metal_issued_purity'       => $request->metal_issued_purity,
                'stones_issued_weight'      => $request->stones_issued_weight ?? 0,
                'stones_issued_pieces'      => $request->stones_issued_pieces ?? 0,
                'stones_issued_description' => $request->stones_issued_description,
                'making_charge_type'        => $request->making_charge_type,
                'making_charge_rate'        => $request->making_charge_rate ?? 0,
                'allowed_wastage_percent'   => $allowedPercent,
                'allowed_wastage_weight'    => $allowedWeight,
                'status'                    => 'assigned',
                'instructions'              => $request->instructions,
            ]);

            // Update Karigar metal balance (adding metal issued into karigar's custody)
            $karigar = Karigar::findOrFail($request->karigar_id);
            $karigar->increment('current_metal_balance', $issuedWeight);

            // Update Order status and assigned karigar
            $order->update([
                'karigar_id' => $karigar->id,
                'status'     => 'assigned',
            ]);

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', "Order assigned to {$karigar->name} successfully! Issued: {$issuedWeight}g.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error assigning order: ' . $e->getMessage());
        }
    }

    /**
     * Show the Receive from Karigar form.
     */
    public function receiveForm($id)
    {
        $order = CustomerOrder::with(['customer', 'karigar'])->findOrFail($id);

        $assignment = $order->assignments()
            ->whereIn('status', ['assigned', 'in_progress'])
            ->latest()
            ->first();

        if (!$assignment) {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'No active assignment found for this order to receive!');
        }

        // Suggest next receipt number
        $year = date('Y');
        $lastRec = KarigarReceipt::where('receipt_no', 'like', "REC-{$year}-%")
            ->orderBy('id', 'desc')->first();

        if ($lastRec && preg_match("/REC-{$year}-(\d+)/", $lastRec->receipt_no, $matches)) {
            $nextSeq = intval($matches[1]) + 1;
        } else {
            $nextSeq = 1;
        }
        $suggestedRecNo = 'REC-' . $year . '-' . str_pad($nextSeq, 4, '0', STR_PAD_LEFT);

        return view('orders.receive', compact('order', 'assignment', 'suggestedRecNo'));
    }

    /**
     * Store Karigar Receipt.
     */
    public function receiveStore(Request $request, $id)
    {
        $order = CustomerOrder::findOrFail($id);

        $request->validate([
            'karigar_assignment_id' => 'required|exists:karigar_assignments,id',
            'receipt_no'            => 'required|string|max:50',
            'received_date'         => 'required|date',
            'finished_gross_weight' => 'required|numeric|min:0.001',
            'finished_net_weight'   => 'required|numeric|min:0.001',
            'stones_weight'         => 'nullable|numeric|min:0',
            'stones_pieces'         => 'nullable|integer|min:0',
            'scrap_metal_returned'  => 'nullable|numeric|min:0',
            'scrap_purity'          => 'nullable|string|max:50',
            'making_charge_type'    => 'required|in:per_gram,flat',
            'making_charge_rate'    => 'nullable|numeric|min:0',
            'other_charges'         => 'nullable|numeric|min:0',
            'payment_status'        => 'required|in:unpaid,paid,adjusted',
            'payment_date'          => 'nullable|date',
            'payment_mode'          => 'nullable|string|max:50',
            'huid'                  => 'nullable|string|max:100',
            'qc_status'             => 'required|in:passed,failed,rework',
            'remarks'               => 'nullable|string',
        ]);

        $assignment = KarigarAssignment::findOrFail($request->karigar_assignment_id);
        $karigar = Karigar::findOrFail($assignment->karigar_id);

        DB::beginTransaction();
        try {
            $finishedNet   = (float)$request->finished_net_weight;
            $finishedGross = (float)$request->finished_gross_weight;
            $scrapReturned = (float)($request->scrap_metal_returned ?? 0);
            $issuedWeight  = (float)$assignment->metal_issued_weight;

            // Actual Wastage = Issued - (Finished Net + Scrap Returned)
            $actualWastage = $issuedWeight - ($finishedNet + $scrapReturned);
            $allowedWastage = (float)$assignment->allowed_wastage_weight;
            $wastageDiff   = $actualWastage - $allowedWastage; // positive = excess loss

            // Calculate Making charges
            $makingRate = (float)($request->making_charge_rate ?? $assignment->making_charge_rate);
            if ($request->making_charge_type === 'per_gram') {
                $finalMaking = $finishedNet * $makingRate;
            } else {
                $finalMaking = $makingRate;
            }
            $otherCharges = (float)($request->other_charges ?? 0);
            $totalMakingCharges = $finalMaking + $otherCharges;

            $receipt = KarigarReceipt::create([
                'admin_id'               => Auth::guard('admin')->id(),
                'customer_order_id'      => $order->id,
                'karigar_assignment_id'  => $assignment->id,
                'karigar_id'             => $karigar->id,
                'receipt_no'             => $request->receipt_no,
                'received_date'          => $request->received_date,
                'finished_gross_weight'  => $finishedGross,
                'finished_net_weight'    => $finishedNet,
                'stones_weight'          => $request->stones_weight ?? 0,
                'stones_pieces'          => $request->stones_pieces ?? 0,
                'scrap_metal_returned'   => $scrapReturned,
                'scrap_purity'           => $request->scrap_purity,
                'actual_wastage'         => $actualWastage,
                'wastage_difference'     => $wastageDiff,
                'final_making_charges'   => $finalMaking,
                'other_charges'          => $otherCharges,
                'total_making_charges'   => $totalMakingCharges,
                'payment_status'         => $request->payment_status,
                'payment_date'           => $request->payment_date,
                'payment_mode'           => $request->payment_mode,
                'huid'                   => $request->huid,
                'qc_status'              => $request->qc_status,
                'remarks'                => $request->remarks,
            ]);

            // Mark assignment as received
            $assignment->update(['status' => 'received']);

            // Deduct total returned / accounted metal from Karigar's balance
            // Accounted metal = finished net + scrap returned + actual wastage (which sums to issuedWeight)
            $karigar->decrement('current_metal_balance', $issuedWeight);

            // Update order status to received
            $order->update([
                'status' => 'received',
            ]);

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', "Finished jewellery received from {$karigar->name} successfully! Net Weight: {$finishedNet}g.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error recording receipt: ' . $e->getMessage());
        }
    }

    /**
     * Update order status (e.g. deliver or cancel).
     */
    public function updateStatus(Request $request, $id)
    {
        $order = CustomerOrder::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,assigned,in_progress,received,delivered,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('orders.show', $order->id)
            ->with('success', "Order status updated to '" . ucfirst(str_replace('_', ' ', $request->status)) . "' successfully.");
    }

    /**
     * Printable Order Sheet / Customer Job Card.
     */
    public function printOrder($id)
    {
        $order = CustomerOrder::with(['customer', 'karigar', 'category', 'subcategory'])->findOrFail($id);
        $firm = Firm::find(session('selected_firm_id')) ?: Firm::first();

        return view('orders.print-order', compact('order', 'firm'));
    }

    /**
     * Printable Karigar Issue Challan / Job Card.
     */
    public function printAssignment($id)
    {
        $assignment = KarigarAssignment::with(['order.customer', 'karigar'])->findOrFail($id);
        $firm = Firm::find(session('selected_firm_id')) ?: Firm::first();

        return view('orders.print-assignment', compact('assignment', 'firm'));
    }

    /**
     * Printable Karigar Receipt Voucher.
     */
    public function printReceipt($id)
    {
        $receipt = KarigarReceipt::with(['order.customer', 'assignment', 'karigar'])->findOrFail($id);
        $firm = Firm::find(session('selected_firm_id')) ?: Firm::first();

        return view('orders.print-receipt', compact('receipt', 'firm'));
    }
}
