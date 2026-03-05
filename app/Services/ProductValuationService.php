<?php

namespace App\Services;

use App\Models\Product;
use App\Models\MetalRate;
use App\Models\ItemProductData;
use Illuminate\Support\Facades\Log;

class ProductValuationService
{
    /**
     * Recalculate and update valuations for a list of products based on a metal rate.
     *
     * @param MetalRate $metalRate
     * @return void
     */
    public function updateProductValuations(MetalRate $metalRate)
    {
        // Only update 'available' products
        $products = Product::where('metal_rate', $metalRate->id)
            ->where(function($query) {
                $query->where('availability', 'available')
                      ->orWhereNull('availability');
            })
            ->get();

        foreach ($products as $product) {
            $this->recalculateProduct($product, $metalRate);
        }
    }

    /**
     * Recalculate valuation for a single product.
     *
     * @param Product $product
     * @param MetalRate|null $metalRate
     * @return void
     */
    public function recalculateProduct(Product $product, MetalRate $metalRate = null)
    {
        if (!$metalRate) {
            $metalRate = MetalRate::find($product->metal_rate);
        }

        if (!$metalRate) {
            Log::warning("No metal rate found for product ID: {$product->id}");
            return;
        }

        $metalPricePerGram = $metalRate->price_per_gram;
        $fineWeight = $product->final_fn_weight ?? 0;
        $netWeight = $product->net_weight ?? 0;
        $grossWeight = $product->gross_weight ?? 0;
        $makingInput = $product->making_price ?? 0;
        $makingType = $product->making_type;
        $gstPerc = $product->gst_percent ?? 0;
        $quantity = $product->quantity ?? 1;

        // 1. Calculate Gold Value
        $goldValue = $metalPricePerGram * $fineWeight;

        // 2. Calculate Making Charges
        $makingFinal = 0;
        switch ($makingType) {
            case "val":
                $makingFinal = $makingInput;
                break;
            case "per_gld_val":
                $makingFinal = ($goldValue * $makingInput) / 100;
                break;
            case "per_pcs":
                $makingFinal = $makingInput * $quantity;
                break;
            case "per_gm_nw":
                $makingFinal = $makingInput * $netWeight;
                break;
            case "per_gm_gw":
                $makingFinal = $makingInput * $grossWeight;
                break;
            case "per_gm_fine_wt":
                $makingFinal = $makingInput * $fineWeight;
                break;
        }

        // 3. Sum Components (Diamond, Stone, Packet)
        $diamondTotal = $product->diamonds()->sum('diamond_final_price') ?: 0;
        $stoneTotal = $product->stones()->sum('stone_final_price') ?: 0;
        $packetTotal = $product->packets()->sum('amount') ?: 0;

        // 4. Calculate Subtotal and GST
        $subTotal = $goldValue + $makingFinal + $diamondTotal + $stoneTotal + $packetTotal;
        $gstAmountFinal = ($subTotal * $gstPerc) / 100;

        // 5. Final Price
        $finalPrice = $subTotal + $gstAmountFinal;

        // Update Product
        $product->update([
            'gold_price' => round($goldValue + $makingFinal + (($goldValue + $makingFinal) * $gstPerc / 100), 2), // Based on calculation.js line 75: goldFinalPrice = goldValue + makingFinal + gstAmount
            'making_final_amount' => round($makingFinal, 2),
            'gst_amount' => round($gstAmountFinal, 2),
            'final_price' => round($finalPrice, 2),
        ]);

        // Synchronize with ItemProductData if it exists
        if ($product->item_product_data_id) {
            ItemProductData::where('id', $product->item_product_data_id)->update([
                'gold_price' => $product->gold_price,
                'making_final_amount' => $product->making_final_amount,
                'gst_amount' => $product->gst_amount,
                'final_price' => $product->final_price,
            ]);
        }
    }
}
