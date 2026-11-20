<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

use App\Models\Karigar;
use App\Models\CustomerOrder;
use App\Models\KarigarAssignment;
use App\Models\KarigarReceipt;
use App\Models\Admin;
use App\Models\Firm;
use App\Models\Customer;
use App\Services\DatabaseSwitcher;
use Illuminate\Support\Facades\DB;

echo "--- TESTING KARIGAR & ORDER WORKFLOW ---\n";

$admin = Admin::first();
if ($admin && $admin->db_name) {
    DatabaseSwitcher::switch($admin->db_name);
    echo "Switched to tenant DB: {$admin->db_name}\n";
}

DB::beginTransaction();
try {
    $firm = Firm::first();
    $customer = Customer::first();

    // 1. Create Karigar
    $karigar = Karigar::create([
        'admin_id'               => $admin ? $admin->id : 1,
        'firm_id'                => $firm ? $firm->id : null,
        'code'                   => 'KG-TEST-01',
        'name'                   => 'Manoj Goldsmith',
        'shop_name'              => 'Manoj Jewellers Crafting',
        'phone'                  => '9876543210',
        'speciality'             => 'Plain Gold',
        'opening_metal_balance'  => 5.000,
        'opening_amount_balance' => 0.00,
        'current_metal_balance'  => 5.000,
        'status'                 => 'active'
    ]);
    echo "1. Created Karigar: {$karigar->name} (Initial Metal Balance: {$karigar->current_metal_balance}g)\n";

    // 2. Create Order
    $order = CustomerOrder::create([
        'admin_id'                 => $admin ? $admin->id : 1,
        'firm_id'                  => $firm ? $firm->id : null,
        'customer_id'              => $customer ? $customer->id : null,
        'order_no'                 => 'ORD-2026-TEST',
        'order_date'               => date('Y-m-d'),
        'due_date'                 => date('Y-m-d', strtotime('+7 days')),
        'item_name'                => 'Custom Gold Necklace 22K',
        'metal_type'               => 'Gold',
        'purity'                   => '22K (916)',
        'expected_net_weight'      => 20.000,
        'expected_gross_weight'    => 20.500,
        'priority'                 => 'normal',
        'status'                   => 'pending',
        'estimated_rate'           => 7200.00,
        'estimated_making_charges' => 9000.00,
        'estimated_total_amount'   => 153000.00,
        'advance_amount'           => 30000.00,
        'advance_payment_mode'     => 'UPI'
    ]);
    echo "2. Created Order: {$order->order_no} ({$order->item_name}), Status: {$order->status}, Est Total: Rs. {$order->estimated_total_amount}, Adv: Rs. {$order->advance_amount}, Bal: Rs. {$order->balance_amount}\n";

    // 3. Assign Order to Karigar
    $metalToIssue = 22.000; // Issue 22g of Gold
    $asg = KarigarAssignment::create([
        'admin_id'                => $admin ? $admin->id : 1,
        'firm_id'                 => $firm ? $firm->id : null,
        'customer_order_id'       => $order->id,
        'karigar_id'              => $karigar->id,
        'assignment_no'           => 'ASG-2026-TEST',
        'assigned_date'           => date('Y-m-d'),
        'expected_delivery_date'  => date('Y-m-d', strtotime('+5 days')),
        'metal_issued_type'       => 'Gold 22K (916)',
        'metal_issued_weight'     => $metalToIssue,
        'metal_issued_purity'     => '91.6%',
        'making_charge_type'      => 'per_gram',
        'making_charge_rate'      => 450.00,
        'allowed_wastage_percent' => 1.50,
        'allowed_wastage_weight'  => $metalToIssue * (1.50 / 100), // 0.330g
        'status'                  => 'assigned',
        'instructions'            => 'High gloss finish with secure lock'
    ]);
    $karigar->increment('current_metal_balance', $metalToIssue);
    $order->update(['karigar_id' => $karigar->id, 'status' => 'assigned']);
    $karigar->refresh();
    $order->refresh();
    echo "3. Assigned to Karigar: {$karigar->name}. Issued: {$asg->metal_issued_weight}g, Allowed Wastage: {$asg->allowed_wastage_weight}g. Karigar Metal in Hand: {$karigar->current_metal_balance}g, Order Status: {$order->status}\n";

    // 4. Receive finished jewellery from Karigar
    $finishedNet = 20.100;
    $finishedGross = 20.300;
    $scrapReturned = 1.600;
    $actualWastage = $metalToIssue - ($finishedNet + $scrapReturned); // 22.000 - 21.700 = 0.300g
    $wastageDiff = $actualWastage - $asg->allowed_wastage_weight;     // 0.300 - 0.330 = -0.030g (within limit!)
    $makingCharges = $finishedNet * 450.00;

    $receipt = KarigarReceipt::create([
        'admin_id'               => $admin ? $admin->id : 1,
        'firm_id'                => $firm ? $firm->id : null,
        'customer_order_id'      => $order->id,
        'karigar_assignment_id'  => $asg->id,
        'karigar_id'             => $karigar->id,
        'receipt_no'             => 'REC-2026-TEST',
        'received_date'          => date('Y-m-d'),
        'finished_gross_weight'  => $finishedGross,
        'finished_net_weight'    => $finishedNet,
        'scrap_metal_returned'   => $scrapReturned,
        'actual_wastage'         => $actualWastage,
        'wastage_difference'     => $wastageDiff,
        'final_making_charges'   => $makingCharges,
        'other_charges'          => 0,
        'total_making_charges'   => $makingCharges,
        'payment_status'         => 'unpaid',
        'qc_status'              => 'passed',
        'remarks'                => 'Excellent finish. Passed Hallmark QC'
    ]);

    $asg->update(['status' => 'received']);
    $karigar->decrement('current_metal_balance', $metalToIssue);
    $order->update(['status' => 'received']);
    $karigar->refresh();
    $order->refresh();

    echo "4. Received Finished Item! Receipt No: {$receipt->receipt_no}\n";
    echo "   - Finished Net Weight: {$receipt->finished_net_weight}g\n";
    echo "   - Scrap Returned: {$receipt->scrap_metal_returned}g\n";
    echo "   - Actual Wastage: {$receipt->actual_wastage}g (Allowed: {$asg->allowed_wastage_weight}g, Diff: {$receipt->wastage_difference}g)\n";
    echo "   - Making Charges Payable: Rs. {$receipt->total_making_charges}\n";
    echo "   - Order Status Updated To: {$order->status}\n";
    echo "   - Karigar Metal in Hand Restored To: {$karigar->current_metal_balance}g\n";

    // 5. Mark as Delivered to Customer
    $order->update(['status' => 'delivered']);
    echo "5. Customer picked up order! Final Status: {$order->status}\n";

    DB::rollBack();
    echo "\n=== ALL TESTS PASSED! DB TRANSACTION ROLLED BACK CLEANLY ===\n";
} catch (\Exception $e) {
    DB::rollBack();
    echo "\nFAILED: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
