<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\WholesaleStock;
use App\Services\TaggingService;
use Illuminate\Support\Facades\Auth;

Auth::guard('admin')->loginUsingId(3);

$stock = WholesaleStock::where('available_quantity', '>', 0)->first();
if (!$stock) {
    echo "No wholesale stock available to test tagging.\n";
    exit(0);
}

echo "Testing Tagging for Stock ID: {$stock->id} ({$stock->item_name})...\n";

$taggingService = app(TaggingService::class);
try {
    $products = $taggingService->processTagging($stock->id, [
        'tag_quantity' => 1,
        'piece_details' => [
            [
                'gross_weight' => 1.000,
                'net_weight' => 1.000,
                'wastage_percent' => 0,
                'final_fn_weight' => 1.000,
                'making_price' => 100,
                'sale_price' => 5000,
            ]
        ]
    ]);

    echo "SUCCESS! Created Product ID: {$products[0]->id}, Barcode: {$products[0]->barcode}, Metal Rate: {$products[0]->metal_rate}\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
