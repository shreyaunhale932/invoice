<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Services\DatabaseSwitcher;

DatabaseSwitcher::switch('invoice_admin_1');

echo "=== DB RETAIL PURCHASES IN invoice_admin_1 ===\n";
$purchases = DB::table('retail_purchases')->latest('id')->take(5)->get();
foreach($purchases as $p) {
    echo "ID: {$p->id} | No: {$p->purchase_no} | Firm: {$p->firm_id} | Date: {$p->purchase_date} | GrandTotal: {$p->grand_total}\n";
    $items = DB::table('retail_purchase_items')->where('retail_purchase_id', $p->id)->get();
    foreach($items as $it) {
        echo "  Item ID: {$it->id} | Name: {$it->item_name} | Qty: {$it->quantity} | Gross: {$it->gross_weight} | Net: {$it->net_weight} | Fine: {$it->final_fn_weight} | Wastage%: {$it->wastage_percent} | Rate: {$it->purchase_rate} | Pre: {$it->pre_code} | Purity: {$it->purity_id}\n";
    }
}

echo "\n=== DB WHOLESALE STOCKS IN invoice_admin_1 ===\n";
$stocks = DB::table('wholesale_stocks')->latest('id')->take(10)->get();
foreach($stocks as $ws) {
    echo "Stock ID: {$ws->id} | Item: {$ws->item_name} | Pre: {$ws->pre_code} | Firm: {$ws->firm_id} | Purity: {$ws->purity_id} | Qty: {$ws->available_quantity} / {$ws->total_quantity} | Net: {$ws->available_net_weight} / {$ws->total_net_weight} | Gross: {$ws->available_gross_weight} / {$ws->total_gross_weight} | Fine: {$ws->available_fine_weight} / {$ws->total_fine_weight}\n";
    $batches = DB::table('wholesale_stock_batches')->where('wholesale_stock_id', $ws->id)->get();
    foreach($batches as $b) {
        echo "    Batch ID: {$b->id} | Purch ID: {$b->retail_purchase_id} | Rem Qty: {$b->remaining_quantity} | Rem Net: {$b->remaining_net_weight} | Rem Gross: {$b->remaining_gross_weight} | Rem Fine: {$b->remaining_fine_weight}\n";
    }
}
