<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Services\DatabaseSwitcher;

DatabaseSwitcher::switch('invoice_admin_1');

echo "=== ALL PURCHASES ===\n";
foreach(DB::table('retail_purchases')->get() as $p) {
    echo "Purchase ID: {$p->id} | No: {$p->purchase_no} | Supplier: {$p->supplier_id} | Date: {$p->purchase_date} | Subtotal: {$p->subtotal} | GrandTotal: {$p->grand_total}\n";
    foreach(DB::table('retail_purchase_items')->where('retail_purchase_id', $p->id)->get() as $it) {
        echo "  Item ID: {$it->id} | Name: {$it->item_name} | Qty: {$it->quantity} | Gross: {$it->gross_weight} | StoneWt: {$it->stone_weight} | DiamondWt: {$it->diamond_weight} | PacketWt: {$it->packet_weight} | Net: {$it->net_weight} | Wastage%: {$it->wastage_percent} | Fine: {$it->final_fn_weight}\n";
    }
}

echo "\n=== ALL WHOLESALE STOCKS ===\n";
foreach(DB::table('wholesale_stocks')->get() as $ws) {
    echo "Stock ID: {$ws->id} | Item: {$ws->item_name} | Pre: {$ws->pre_code} | Purity: {$ws->purity_id} | Avail Qty: {$ws->available_quantity} | Avail Gross: {$ws->available_gross_weight} | Avail Net: {$ws->available_net_weight} | Avail Fine: {$ws->available_fine_weight}\n";
    foreach(DB::table('wholesale_stock_batches')->where('wholesale_stock_id', $ws->id)->get() as $b) {
        echo "  Batch ID: {$b->id} | Purch ID: {$b->retail_purchase_id} | Item ID: {$b->retail_purchase_item_id} | Init Qty: {$b->initial_quantity} | Rem Qty: {$b->remaining_quantity} | Init Gross: {$b->initial_gross_weight} | Rem Gross: {$b->remaining_gross_weight} | Init Net: {$b->initial_net_weight} | Rem Net: {$b->remaining_net_weight}\n";
    }
}
