<?php

namespace App\Services;

use App\Models\InventoryTransaction;
use App\Models\ItemProductData;
use App\Models\MetalRate;
use App\Models\PurityModel;
use App\Models\Product;
use App\Models\WholesaleStock;
use App\Models\WholesaleStockBatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaggingService
{
    /**
     * Tag Wholesale Stock and convert it into individual Retail Products.
     *
     * @param WholesaleStock $wholesaleStock
     * @param WholesaleStockBatch|null $batch
     * @param array $tagData Array containing:
     *   - tag_quantity: int
     *   - piece_details: array of ['gross_weight', 'net_weight', 'wastage_percent', 'final_fn_weight', 'barcode', 'size', 'sale_price', 'mrp_price', 'making_price', 'making_type', 'making_final_amount', 'hallmarking']
     * @return array Created Product models
     * @throws \Exception
     */
    public function convertWholesaleToRetailTags(WholesaleStock $wholesaleStock, ?WholesaleStockBatch $batch, array $tagData)
    {
        return DB::transaction(function () use ($wholesaleStock, $batch, $tagData) {
            $adminId = Auth::guard('admin')->id();
            $firmId  = auth()->user()->firm_id ?? $wholesaleStock->firm_id;

            $tagQuantity = intval($tagData['tag_quantity'] ?? count($tagData['piece_details'] ?? []));
            if ($tagQuantity <= 0) {
                throw new \Exception("Tag quantity must be greater than zero.");
            }

            // Lock wholesale stock for update
            $wholesaleStock = WholesaleStock::lockForUpdate()->findOrFail($wholesaleStock->id);

            // Calculate total requested weights
            $totalGrossWt = 0;
            $totalNetWt   = 0;
            $totalFineWt  = 0;

            $pieces = $tagData['piece_details'] ?? [];
            if (empty($pieces)) {
                throw new \Exception("Piece weight details are required for tagging.");
            }

            foreach ($pieces as $piece) {
                $totalGrossWt += floatval($piece['gross_weight'] ?? 0);
                $totalNetWt   += floatval($piece['net_weight'] ?? 0);
                $totalFineWt  += floatval($piece['final_fn_weight'] ?? $piece['net_weight'] ?? 0);
            }

            // Validation against available stock
            if ($tagQuantity > $wholesaleStock->available_quantity) {
                throw new \Exception("Requested tagging quantity ({$tagQuantity}) exceeds available wholesale quantity ({$wholesaleStock->available_quantity}).");
            }

            if ($totalNetWt > ($wholesaleStock->available_net_weight + 0.001)) {
                throw new \Exception("Requested tagging net weight ({$totalNetWt}g) exceeds available wholesale net weight ({$wholesaleStock->available_net_weight}g).");
            }

            // If a specific batch was selected, validate batch limits
            if ($batch) {
                $batch = WholesaleStockBatch::lockForUpdate()->findOrFail($batch->id);
                if ($tagQuantity > $batch->remaining_quantity) {
                    throw new \Exception("Requested tagging quantity ({$tagQuantity}) exceeds available batch quantity ({$batch->remaining_quantity}).");
                }
                if ($totalNetWt > ($batch->remaining_net_weight + 0.001)) {
                    throw new \Exception("Requested tagging net weight ({$totalNetWt}g) exceeds available batch net weight ({$batch->remaining_net_weight}g).");
                }
            } else {
                // FIFO batch selection if no specific batch provided
                $batch = WholesaleStockBatch::where('wholesale_stock_id', $wholesaleStock->id)
                    ->where('remaining_quantity', '>', 0)
                    ->orderBy('purchase_date', 'asc')
                    ->orderBy('id', 'asc')
                    ->lockForUpdate()
                    ->first();
            }

            // Deduct from WholesaleStock
            $wholesaleStock->available_quantity     = max(0, $wholesaleStock->available_quantity - $tagQuantity);
            $wholesaleStock->available_gross_weight = max(0, $wholesaleStock->available_gross_weight - $totalGrossWt);
            $wholesaleStock->available_net_weight   = max(0, $wholesaleStock->available_net_weight - $totalNetWt);
            $wholesaleStock->available_fine_weight  = max(0, $wholesaleStock->available_fine_weight - $totalFineWt);
            $wholesaleStock->save();

            // Deduct from WholesaleStockBatch
            if ($batch) {
                $batch->remaining_quantity     = max(0, $batch->remaining_quantity - $tagQuantity);
                $batch->remaining_gross_weight = max(0, $batch->remaining_gross_weight - $totalGrossWt);
                $batch->remaining_net_weight   = max(0, $batch->remaining_net_weight - $totalNetWt);
                $batch->remaining_fine_weight  = max(0, $batch->remaining_fine_weight - $totalFineWt);
                $batch->save();
            }

            // Log InventoryTransaction for TAGGING_OUT (Wholesale)
            InventoryTransaction::create([
                'admin_id'                => $adminId,
                'firm_id'                 => $firmId,
                'item_product_data_id'    => $wholesaleStock->item_product_data_id,
                'wholesale_stock_id'      => $wholesaleStock->id,
                'wholesale_stock_batch_id'=> $batch ? $batch->id : null,
                'retail_purchase_id'      => $batch ? $batch->retail_purchase_id : null,
                'retail_purchase_item_id' => $batch ? $batch->retail_purchase_item_id : null,
                'type'                    => 'OUT',
                'quantity'                => $tagQuantity,
                'gross_weight'            => $totalGrossWt,
                'net_weight'              => $totalNetWt,
                'final_fn_weight'         => $totalFineWt,
                'unit'                    => 'GM',
                'remarks'                 => "Wholesale Stock converted into {$tagQuantity} Retail Tag(s)",
            ]);

            $createdProducts = [];
            $preCode = $wholesaleStock->pre_code;
            $itemProductData = ItemProductData::find($wholesaleStock->item_product_data_id);

            // Create individual tagged Product rows
            foreach ($pieces as $idx => $piece) {
                // Determine next sequential post_code
                $lastProduct = Product::withTrashed()
                    ->where('pre_code', $preCode)
                    ->orderBy('id', 'desc')
                    ->first();

                $postCode = $lastProduct ? (intval($lastProduct->post_code) + 1) : 1;

                while (Product::withTrashed()
                    ->where('pre_code', $preCode)
                    ->where('post_code', (string)$postCode)
                    ->exists()) {
                    $postCode++;
                }

                $grossWt = floatval($piece['gross_weight'] ?? 0);
                $netWt   = floatval($piece['net_weight'] ?? 0);
                $wastagePerc = floatval(isset($piece['wastage_percent']) && $piece['wastage_percent'] !== '' ? $piece['wastage_percent'] : ($batch ? $batch->wastage_percent : 0));
                $fineWt = floatval($piece['final_fn_weight'] ?? 0);
                if ($fineWt <= 0 && $netWt > 0) {
                    $fineWt = $netWt + (($netWt * $wastagePerc) / 100);
                }

                $makingPrice = floatval(isset($piece['making_price']) && $piece['making_price'] !== '' ? $piece['making_price'] : ($batch ? $batch->making_price : 0));
                $makingType  = $piece['making_type'] ?? ($batch ? $batch->making_type : 'per_gram');
                $makingFinal = floatval($piece['making_final_amount'] ?? ($makingType === 'fixed' ? $makingPrice : ($makingPrice * $netWt)));
                $purchaseRate = floatval($batch ? $batch->purchase_rate : 0);
                $salePrice = floatval(!empty($piece['sale_price']) ? $piece['sale_price'] : ($batch && !empty($batch->sale_price) ? $batch->sale_price : $purchaseRate));

                $metalRateId = $itemProductData ? $itemProductData->metal_rate : null;
                if (!$metalRateId && $wholesaleStock->purity_id) {
                    $purityObj = PurityModel::find($wholesaleStock->purity_id);
                    if ($purityObj) {
                        $mr = MetalRate::where('admin_id', $adminId)
                            ->where(function($q) use ($purityObj) {
                                $q->where('karat', $purityObj->purity_name)
                                  ->orWhere('purity_type', $purityObj->purity_name);
                            })->first();
                        if ($mr) {
                            $metalRateId = $mr->id;
                        }
                    }
                }
                if (!$metalRateId) {
                    $firstMr = MetalRate::where('admin_id', $adminId)->first() ?? MetalRate::first();
                    $metalRateId = $firstMr ? $firstMr->id : 1;
                }

                $metalRateObj = MetalRate::find($metalRateId);
                $metalRatePrice = $metalRateObj ? floatval($metalRateObj->price_per_gram) : $purchaseRate;

                $finalPrice = floatval($piece['final_price'] ?? ($fineWt * $metalRatePrice + $makingFinal));

                $product = Product::create([
                    'admin_id'                 => $adminId,
                    'firm_id'                  => $firmId,
                    'item_product_data_id'     => $wholesaleStock->item_product_data_id,
                    'wholesale_stock_id'       => $wholesaleStock->id,
                    'wholesale_stock_batch_id' => $batch ? $batch->id : null,
                    'retail_purchase_id'       => $batch ? $batch->retail_purchase_id : null,
                    'retail_purchase_item_id'  => $batch ? $batch->retail_purchase_item_id : null,
                    'supplier_id'              => $batch ? $batch->supplier_id : null,
                    'product_name'             => $wholesaleStock->item_name,
                    'pre_code'                 => $preCode,
                    'post_code'                => (string)$postCode,
                    'barcode'                  => $piece['barcode'] ?? null,
                    'category_id'              => $wholesaleStock->category_id,
                    'subcategory_id'           => $wholesaleStock->subcategory_id,
                    'purity_id'                => $wholesaleStock->purity_id,
                    'metal_rate'               => $metalRateId,
                    'gross_weight'             => $grossWt,
                    'net_weight'               => $netWt,
                    'final_fn_weight'          => $fineWt,
                    'wastage_percent'          => $wastagePerc,
                    'making_price'             => $makingPrice,
                    'making_type'              => $makingType,
                    'making_final_amount'      => $makingFinal,
                    'quantity'                 => 1,
                    'size'                     => $piece['size'] ?? null,
                    'sale_price'               => $salePrice,
                    'mrp_price'                => floatval($piece['mrp_price'] ?? $salePrice),
                    'final_price'              => $finalPrice,
                    'availability'             => 'available',
                    'hallmarking'              => $piece['hallmarking'] ?? null,
                    'tagged_at'                => now(),
                    'tagged_by'                => Auth::id(),
                ]);

                // Auto-generate barcode if not set
                if (empty($product->barcode)) {
                    $prefix   = strtoupper(substr($preCode, 0, 4));
                    $purityId = $wholesaleStock->purity_id ?? 1;
                    $prodPad  = str_pad($product->id, 4, '0', STR_PAD_LEFT);
                    $autoBarcode = "{$prefix}-{$purityId}-{$prodPad}";

                    while (Product::where('barcode', $autoBarcode)->exists()) {
                        $prodPad++;
                        $autoBarcode = "{$prefix}-{$purityId}-{$prodPad}";
                    }

                    $product->update(['barcode' => $autoBarcode]);
                }

                // Log InventoryTransaction for TAGGING_IN (Retail Product)
                InventoryTransaction::create([
                    'admin_id'                 => $adminId,
                    'firm_id'                  => $firmId,
                    'product_id'               => $product->id,
                    'item_product_data_id'     => $wholesaleStock->item_product_data_id,
                    'wholesale_stock_id'       => $wholesaleStock->id,
                    'wholesale_stock_batch_id' => $batch ? $batch->id : null,
                    'retail_purchase_id'       => $batch ? $batch->retail_purchase_id : null,
                    'retail_purchase_item_id'  => $batch ? $batch->retail_purchase_item_id : null,
                    'type'                     => 'TAGGING_IN',
                    'quantity'                 => 1,
                    'gross_weight'             => $grossWt,
                    'net_weight'               => $netWt,
                    'final_fn_weight'          => $fineWt,
                    'unit'                     => 'GM',
                    'size'                     => $piece['size'] ?? null,
                    'remarks'                  => "Retail Tag generated from Wholesale Stock #{$wholesaleStock->id}",
                ]);

                $createdProducts[] = $product;
            }

            return $createdProducts;
        });
    }
}
