<?php

namespace App\Services;

use App\Models\InventoryTransaction;
use App\Models\ItemProductData;
use App\Models\MetalRate;
use App\Models\PurityModel;
use App\Models\Product;
use App\Models\RetailPurchase;
use App\Models\RetailPurchaseItem;
use App\Models\WholesaleStock;
use App\Models\WholesaleStockBatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WholesaleStockService
{
    /**
     * Add purchase item stock into Wholesale Stock & Wholesale Stock Batch.
     *
     * @param RetailPurchase $purchase
     * @param RetailPurchaseItem $purchaseItem
     * @param array $itemData
     * @return WholesaleStockBatch
     */
    public function addPurchaseItemToWholesaleStock(RetailPurchase $purchase, RetailPurchaseItem $purchaseItem, array $itemData)
    {
        $adminId = $purchase->admin_id ?? Auth::guard('admin')->id();
        $firmId  = $purchase->firm_id ?? (auth()->check() ? auth()->user()->firm_id : null);

        $preCode = strtoupper(trim($itemData['pre_code'] ?? ($purchaseItem->pre_code ?? 'DEF')));
        $itemName = $itemData['item_name'] ?? $purchaseItem->item_name;
        $categoryId = $itemData['category_id'] ?? $purchaseItem->category_id;
        $subcategoryId = $itemData['subcategory_id'] ?? $purchaseItem->subcategory_id;
        $purityId = $itemData['purity_id'] ?? $purchaseItem->purity_id;

        $metalRateId = null;
        if ($purityId) {
            $purityObj = PurityModel::find($purityId);
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

        // 1. Find or create master ItemProductData
        $itemProductData = ItemProductData::firstOrCreate(
            [
                'product_code' => $preCode,
                'product_name' => $itemName,
            ],
            [
                'admin_id'        => $adminId,
                'firm_id'         => $firmId,
                'category_id'     => $categoryId,
                'subcategory_id'  => $subcategoryId,
                'purity_id'       => $purityId,
                'metal_rate'      => $metalRateId,
                'gross_weight'    => 0,
                'net_weight'      => 0,
                'final_fn_weight' => 0,
                'sale_price'      => $purchaseItem->purchase_rate ?? 0,
            ]
        );

        // Update purchase item's item_product_data_id
        $purchaseItem->update(['item_product_data_id' => $itemProductData->id]);

        // 2. Find or create WholesaleStock by Product Identity Key
        $wsQuery = WholesaleStock::where('admin_id', $adminId)->where('pre_code', $preCode);
        if ($firmId) {
            $wsQuery->where('firm_id', $firmId);
        }
        if ($purityId) {
            $wsQuery->where('purity_id', $purityId);
        } else {
            $wsQuery->whereNull('purity_id');
        }

        $wholesaleStock = $wsQuery->first();

        if (!$wholesaleStock) {
            $wholesaleStock = WholesaleStock::create([
                'admin_id'               => $adminId,
                'firm_id'                => $firmId,
                'item_product_data_id'   => $itemProductData->id,
                'category_id'            => $categoryId,
                'subcategory_id'         => $subcategoryId,
                'purity_id'              => $purityId,
                'item_name'              => $itemName,
                'pre_code'               => $preCode,
                'total_quantity'         => 0,
                'available_quantity'     => 0,
                'total_gross_weight'     => 0,
                'available_gross_weight' => 0,
                'total_net_weight'       => 0,
                'available_net_weight'   => 0,
                'total_fine_weight'      => 0,
                'available_fine_weight'  => 0,
            ]);
        }

        $qty     = floatval($purchaseItem->quantity ?? 1);
        $grossWt = floatval($purchaseItem->gross_weight ?? 0);
        $netWt   = floatval($purchaseItem->net_weight ?? 0);
        $fineWt  = floatval($purchaseItem->final_fn_weight ?? 0);

        // Aggregate wholesale stock quantities & weights
        $wholesaleStock->total_quantity         += $qty;
        $wholesaleStock->available_quantity     += $qty;
        $wholesaleStock->total_gross_weight     += $grossWt;
        $wholesaleStock->available_gross_weight += $grossWt;
        $wholesaleStock->total_net_weight       += $netWt;
        $wholesaleStock->available_net_weight   += $netWt;
        $wholesaleStock->total_fine_weight      += $fineWt;
        $wholesaleStock->available_fine_weight  += $fineWt;
        $wholesaleStock->save();

        // 3. Create WholesaleStockBatch row for supplier & invoice batch tracking
        $batch = WholesaleStockBatch::create([
            'admin_id'                => $adminId,
            'firm_id'                 => $firmId,
            'wholesale_stock_id'      => $wholesaleStock->id,
            'retail_purchase_id'      => $purchase->id,
            'retail_purchase_item_id' => $purchaseItem->id,
            'supplier_id'             => $purchase->supplier_id,
            'purchase_date'           => $purchase->purchase_date,
            'purchase_rate'           => $purchaseItem->purchase_rate ?? 0,
            'making_price'            => $purchaseItem->making_price ?? 0,
            'making_type'             => $purchaseItem->making_type ?? null,
            'wastage_percent'         => $purchaseItem->wastage_percent ?? 0,
            'sale_price'              => $purchaseItem->sale_price ?? ($purchaseItem->purchase_rate ?? 0),
            'initial_quantity'        => $qty,
            'remaining_quantity'      => $qty,
            'initial_gross_weight'    => $grossWt,
            'remaining_gross_weight'  => $grossWt,
            'initial_net_weight'      => $netWt,
            'remaining_net_weight'    => $netWt,
            'initial_fine_weight'     => $fineWt,
            'remaining_fine_weight'   => $fineWt,
        ]);

        // 4. Log InventoryTransaction for PURCHASE_IN
        InventoryTransaction::create([
            'admin_id'                => $adminId,
            'firm_id'                 => $firmId,
            'item_product_data_id'    => $itemProductData->id,
            'wholesale_stock_id'      => $wholesaleStock->id,
            'wholesale_stock_batch_id'=> $batch->id,
            'retail_purchase_id'      => $purchase->id,
            'retail_purchase_item_id' => $purchaseItem->id,
            'type'                    => 'IN',
            'quantity'                => $qty,
            'gross_weight'            => $grossWt,
            'net_weight'              => $netWt,
            'final_fn_weight'         => $fineWt,
            'unit'                    => $purchaseItem->unit ?? 'GM',
            'size'                    => $purchaseItem->size ?? null,
            'remarks'                 => "Wholesale Purchase #{$purchase->purchase_no}",
        ]);

        return $batch;
    }

    /**
     * Check if a purchase can be safely reversed/deleted.
     * Throws an exception if any portion of wholesale stock from this purchase has been tagged.
     *
     * @param RetailPurchase $purchase
     * @throws \Exception
     */
    public function validatePurchaseCanBeReversed(RetailPurchase $purchase)
    {
        $batches = WholesaleStockBatch::where('retail_purchase_id', $purchase->id)->get();

        foreach ($batches as $batch) {
            // Check if remaining quantity < initial quantity (meaning some items were tagged)
            if ($batch->remaining_quantity < $batch->initial_quantity || $batch->remaining_net_weight < $batch->initial_net_weight) {
                throw new \Exception("Cannot edit/cancel Purchase #{$purchase->purchase_no} because stock from line item #{$batch->retail_purchase_item_id} has already been converted to Retail Tags.");
            }
        }
    }

    /**
     * Reverse wholesale stock for a purchase (during edit or deletion).
     *
     * @param RetailPurchase $purchase
     */
    public function reverseWholesalePurchase(RetailPurchase $purchase)
    {
        $batches = WholesaleStockBatch::where('retail_purchase_id', $purchase->id)->get();

        foreach ($batches as $batch) {
            $ws = WholesaleStock::lockForUpdate()->find($batch->wholesale_stock_id);
            if ($ws) {
                $ws->total_quantity         = max(0, $ws->total_quantity - $batch->initial_quantity);
                $ws->available_quantity     = max(0, $ws->available_quantity - $batch->remaining_quantity);
                $ws->total_gross_weight     = max(0, $ws->total_gross_weight - $batch->initial_gross_weight);
                $ws->available_gross_weight = max(0, $ws->available_gross_weight - $batch->remaining_gross_weight);
                $ws->total_net_weight       = max(0, $ws->total_net_weight - $batch->initial_net_weight);
                $ws->available_net_weight   = max(0, $ws->available_net_weight - $batch->remaining_net_weight);
                $ws->total_fine_weight      = max(0, $ws->total_fine_weight - $batch->initial_fine_weight);
                $ws->available_fine_weight  = max(0, $ws->available_fine_weight - $batch->remaining_fine_weight);
                $ws->save();
            }

            // Log InventoryTransaction for PURCHASE_REVERSAL
            InventoryTransaction::create([
                'admin_id'                => $purchase->admin_id,
                'firm_id'                 => $purchase->firm_id,
                'item_product_data_id'    => $ws ? $ws->item_product_data_id : null,
                'wholesale_stock_id'      => $batch->wholesale_stock_id,
                'wholesale_stock_batch_id'=> $batch->id,
                'retail_purchase_id'      => $purchase->id,
                'retail_purchase_item_id' => $batch->retail_purchase_item_id,
                'type'                    => 'OUT',
                'quantity'                => $batch->initial_quantity,
                'gross_weight'            => $batch->initial_gross_weight,
                'net_weight'              => $batch->initial_net_weight,
                'final_fn_weight'         => $batch->initial_fine_weight,
                'unit'                    => 'GM',
                'remarks'                 => "Reversal of Purchase #{$purchase->purchase_no}",
            ]);

            $batch->delete();

            if ($ws) {
                self::reconcileStock($ws);
            }
        }
    }

    /**
     * Reconcile WholesaleStock available totals with active batches.
     * Ensures WholesaleStock available_quantity, available_gross_weight, available_net_weight,
     * and available_fine_weight always match the exact sum of remaining active batches.
     */
    public static function reconcileStock(WholesaleStock $stock)
    {
        $batchTotals = WholesaleStockBatch::where('wholesale_stock_id', $stock->id)
            ->selectRaw('
                COALESCE(SUM(remaining_quantity), 0) as rem_qty,
                COALESCE(SUM(remaining_gross_weight), 0) as rem_gross,
                COALESCE(SUM(remaining_net_weight), 0) as rem_net,
                COALESCE(SUM(remaining_fine_weight), 0) as rem_fine,
                COALESCE(SUM(initial_quantity), 0) as init_qty,
                COALESCE(SUM(initial_gross_weight), 0) as init_gross,
                COALESCE(SUM(initial_net_weight), 0) as init_net,
                COALESCE(SUM(initial_fine_weight), 0) as init_fine
            ')
            ->first();

        if ($batchTotals) {
            $stock->available_quantity     = floatval($batchTotals->rem_qty);
            $stock->available_gross_weight = floatval($batchTotals->rem_gross);
            $stock->available_net_weight   = floatval($batchTotals->rem_net);
            $stock->available_fine_weight  = floatval($batchTotals->rem_fine);
            if ($batchTotals->init_qty > 0) {
                $stock->total_quantity     = max(floatval($stock->total_quantity), floatval($batchTotals->init_qty));
            }
            if ($batchTotals->init_gross > 0) {
                $stock->total_gross_weight = max(floatval($stock->total_gross_weight), floatval($batchTotals->init_gross));
            }
            if ($batchTotals->init_net > 0) {
                $stock->total_net_weight   = max(floatval($stock->total_net_weight), floatval($batchTotals->init_net));
            }
            if ($batchTotals->init_fine > 0) {
                $stock->total_fine_weight  = max(floatval($stock->total_fine_weight), floatval($batchTotals->init_fine));
            }
            $stock->save();
        }

        return $stock;
    }
}

