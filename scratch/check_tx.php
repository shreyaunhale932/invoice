<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Services\DatabaseSwitcher;

DatabaseSwitcher::switch('invoice_admin_1');

echo "=== INVENTORY TRANSACTIONS FOR STOCK ID 2 ===\n";
foreach(DB::table('inventory_transactions')->where('wholesale_stock_id', 2)->get() as $t) {
    echo "Tx ID: {$t->id} | Type: {$t->type} | Qty: {$t->quantity} | Gross: {$t->gross_weight} | Net: {$t->net_weight} | Fine: {$t->final_fn_weight} | Remarks: {$t->remarks} | Created: {$t->created_at}\n";
}

echo "\n=== ALL INVENTORY TRANSACTIONS ===\n";
foreach(DB::table('inventory_transactions')->latest('id')->take(10)->get() as $t) {
    echo "Tx ID: {$t->id} | Stock ID: {$t->wholesale_stock_id} | Type: {$t->type} | Qty: {$t->quantity} | Gross: {$t->gross_weight} | Net: {$t->net_weight} | Fine: {$t->final_fn_weight} | Remarks: {$t->remarks}\n";
}

echo "\n=== DELETED PURCHASES ===\n";
foreach(DB::table('retail_purchases')->whereNotNull('deleted_at')->get() as $p) {
    echo "Deleted Purch ID: {$p->id} | No: {$p->purchase_no}\n";
}

echo "\n=== PRODUCTS ===\n";
foreach(DB::table('products')->get() as $pr) {
    echo "Product ID: {$pr->id} | Name: {$pr->product_name} | Barcode: {$pr->barcode} | Pre: {$pr->pre_code} | Gross: {$pr->gross_weight} | Net: {$pr->net_weight} | Stock ID: {$pr->wholesale_stock_id}\n";
}
