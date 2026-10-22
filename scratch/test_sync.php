<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Services\DatabaseSwitcher;

DatabaseSwitcher::switch('invoice_admin_1');

echo "=== BEFORE SYNC ===\n";
$ws = DB::table('wholesale_stocks')->where('id', 2)->first();
echo "Stock 2: Qty: {$ws->available_quantity} | Gross: {$ws->available_gross_weight} | Net: {$ws->available_net_weight} | Fine: {$ws->available_fine_weight}\n";

$batches = DB::table('wholesale_stock_batches')->where('wholesale_stock_id', 2)->get();
echo "Batches count: " . $batches->count() . "\n";
foreach($batches as $b) {
    echo "  Batch {$b->id}: Qty: {$b->remaining_quantity} | Gross: {$b->remaining_gross_weight} | Net: {$b->remaining_net_weight} | Fine: {$b->remaining_fine_weight}\n";
}

$activeBatches = $batches->filter(function($b) {
    return $b->remaining_quantity > 0 || $b->remaining_net_weight > 0;
});

DB::table('wholesale_stocks')->where('id', 2)->update([
    'total_quantity'         => $batches->sum('initial_quantity'),
    'available_quantity'     => $activeBatches->sum('remaining_quantity'),
    'total_gross_weight'     => $batches->sum('initial_gross_weight'),
    'available_gross_weight' => $activeBatches->sum('remaining_gross_weight'),
    'total_net_weight'       => $batches->sum('initial_net_weight'),
    'available_net_weight'   => $activeBatches->sum('remaining_net_weight'),
    'total_fine_weight'      => $batches->sum('initial_fine_weight'),
    'available_fine_weight'  => $activeBatches->sum('remaining_fine_weight'),
]);

echo "\n=== AFTER SYNC ===\n";
$ws = DB::table('wholesale_stocks')->where('id', 2)->first();
echo "Stock 2: Qty: {$ws->available_quantity} | Gross: {$ws->available_gross_weight} | Net: {$ws->available_net_weight} | Fine: {$ws->available_fine_weight}\n";
