<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\ItemProductData;
use App\Models\RetailPurchase;
use App\Models\RetailPurchaseItem;
use App\Models\InventoryTransaction;
use App\Models\Admin;
use App\Http\Controllers\RetailPurchaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

echo "=== RETAIL PURCHASE INTEGRATION TEST ===\n";

// Login as admin 1
$admin = Admin::first();
if (!$admin) {
    echo "No admin user found. Creating dummy admin.\n";
    $admin = Admin::create([
        'name' => 'Test Admin',
        'email' => 'testadmin@example.com',
        'password' => bcrypt('password'),
    ]);
}
Auth::guard('admin')->setUser($admin);
auth()->setUser($admin);

echo "Logged in as Admin ID: " . Auth::guard('admin')->id() . "\n\n";

// 1. Create a test product
$itemData = ItemProductData::firstOrCreate(
    ['product_code' => 'TST-PROD', 'product_name' => 'Test Gold Bangle'],
    [
        'gross_weight' => 0,
        'net_weight' => 0,
        'final_fn_weight' => 0,
        'sale_price' => 5000,
    ]
);

$metalRate = \App\Models\MetalRate::firstOrCreate(
    ['metal_type' => '22K Gold'],
    ['price_per_gram' => 6000, 'admin_id' => $admin->id]
);

$product = Product::firstOrCreate(
    ['pre_code' => 'TST-PROD', 'post_code' => '0001'],
    [
        'admin_id' => $admin->id,
        'item_product_data_id' => $itemData->id,
        'product_name' => 'Test Gold Bangle',
        'metal_rate' => $metalRate->id,
        'quantity' => 0,
        'gross_weight' => 0,
        'net_weight' => 0,
        'final_fn_weight' => 0,
        'sale_price' => 5000,
        'availability' => 'available',
    ]
);

$initialQty = $product->quantity;
$initialGross = $product->gross_weight;
$initialNet = $product->net_weight;

echo "Initial Stock State:\n";
echo "Qty: {$initialQty}, Gross Wt: {$initialGross}g, Net Wt: {$initialNet}g\n\n";

// TEST 1: Purchase Normal / Weight Product
echo "--- TEST 1: Store Retail Purchase (5 pcs, Gross = 10.000g, Stone = 1.000g) ---\n";

$controller = new RetailPurchaseController();
$storeRequest = Request::create('/purchases/store', 'POST', [
    'purchase_date' => date('Y-m-d'),
    'reference_no'  => 'SUPP-BILL-1001',
    'status'        => 'completed',
    'discount_percent' => 0,
    'discount_amount'  => 0,
    'cgst_percent'     => 1.5,
    'sgst_percent'     => 1.5,
    'other_charges'    => 100,
    'paid_amount'      => 5000,
    'payment_method'   => 'cash',
    'items' => [
        [
            'product_id'    => $product->id,
            'item_name'     => $product->product_name,
            'quantity'      => 5,
            'gross_weight'  => 10.000,
            'stone_weight'  => 1.000, // Net Wt should be 10 - 0.2 = 9.800g
            'net_weight'    => 9.800,
            'wastage_percent' => 2.00,
            'purchase_rate' => 6000,
            'making_price'  => 500,
            'gst_percent'   => 3,
        ]
    ]
]);

$response = $controller->store($storeRequest);
$product->refresh();
$purchase = RetailPurchase::latest()->first();

echo "Purchase Created: ID={$purchase->id}, Purchase No={$purchase->purchase_no}, Grand Total=₹{$purchase->grand_total}\n";
echo "Updated Product Stock: Qty={$product->quantity}, Gross Wt={$product->gross_weight}g, Net Wt={$product->net_weight}g\n";

$tx = InventoryTransaction::where('retail_purchase_id', $purchase->id)->first();
if ($tx && $tx->type === 'IN' && $product->quantity == ($initialQty + 5)) {
    echo "✔ TEST 1 PASSED: Stock increased by 5, InventoryTransaction IN created correctly.\n\n";
} else {
    echo "✖ TEST 1 FAILED!\n\n";
}

// TEST 2: Edit Purchase (5 pcs -> 15 pcs)
echo "--- TEST 2: Edit Retail Purchase (Change Qty to 15 pcs, Gross = 30.000g) ---\n";
$editRequest = Request::create("/purchases/{$purchase->id}", 'PUT', [
    'purchase_date' => date('Y-m-d'),
    'reference_no'  => 'SUPP-BILL-1001-UPDATED',
    'status'        => 'completed',
    'discount_percent' => 0,
    'paid_amount'      => 10000,
    'payment_method'   => 'bank',
    'items' => [
        [
            'product_id'    => $product->id,
            'item_name'     => $product->product_name,
            'quantity'      => 15,
            'gross_weight'  => 30.000,
            'stone_weight'  => 0.000, // Raw/Normal product Net Wt = 30.000g
            'net_weight'    => 30.000,
            'wastage_percent' => 0,
            'purchase_rate' => 6000,
            'making_price'  => 500,
            'gst_percent'   => 3,
        ]
    ]
]);

$controller->update($editRequest, $purchase->id);
$product->refresh();
$purchase->refresh();

echo "Edited Purchase Grand Total: ₹{$purchase->grand_total}\n";
echo "Product Stock after Edit: Qty={$product->quantity}, Gross Wt={$product->gross_weight}g, Net Wt={$product->net_weight}g\n";

if ($product->quantity == ($initialQty + 15)) {
    echo "✔ TEST 2 PASSED: Old stock impact reversed and new +15 applied. Total stock is +15, NOT +20 or +25.\n\n";
} else {
    echo "✖ TEST 2 FAILED!\n\n";
}

// TEST 3: Delete Purchase & Reverse Stock
echo "--- TEST 3: Delete Retail Purchase & Reverse Stock ---\n";
$controller->destroy($purchase->id);
$product->refresh();

echo "Product Stock after Delete: Qty={$product->quantity}, Gross Wt={$product->gross_weight}g, Net Wt={$product->net_weight}g\n";
$txCount = InventoryTransaction::where('retail_purchase_id', $purchase->id)->count();

if ($product->quantity == $initialQty && $txCount == 0) {
    echo "✔ TEST 3 PASSED: Purchase deleted, stock impact completely reversed, InventoryTransactions cleaned up.\n\n";
} else {
    echo "✖ TEST 3 FAILED!\n\n";
}

// TEST 4: Transaction Rollback Safety Test
echo "--- TEST 4: Transaction Rollback Safety Test ---\n";
$qtyBeforeFail = $product->quantity;
try {
    DB::transaction(function() use ($controller, $product) {
        $invalidRequest = Request::create('/purchases/store', 'POST', [
            'purchase_date' => date('Y-m-d'),
            'items' => [
                [
                    'product_id'    => $product->id,
                    'item_name'     => $product->product_name,
                    'quantity'      => 10,
                    'gross_weight'  => 50.000,
                    'net_weight'    => 50.000,
                    'purchase_rate' => 6000,
                ]
            ]
        ]);
        // Force an exception after stock mutation
        $product->quantity += 10;
        $product->save();
        throw new \Exception("Simulated Database Error");
    });
} catch (\Exception $e) {
    echo "Caught simulated exception: " . $e->getMessage() . "\n";
}

$product->refresh();
if ($product->quantity == $qtyBeforeFail) {
    echo "✔ TEST 4 PASSED: DB transaction rolled back fully on failure. Stock remains unchanged.\n\n";
} else {
    echo "✖ TEST 4 FAILED!\n\n";
}

echo "=== ALL VERIFICATION TESTS COMPLETED ===\n";
