<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetalRate;
use Illuminate\Support\Facades\Auth;

class MetalRateController extends Controller
{
    public function addmetalrates(Request $request)
    {
        // Validate incoming fields
        $request->validate([
            'metal_type'      => 'required|string|max:255',
            'price_per_gram'  => 'required|numeric',
            // 'gram'            => 'required|numeric',
            'karat'           => 'nullable|string|max:10',
            'purity_type'  => 'required|in:karat,percent',
        ]);

        // Save data to database
        $metalRate = MetalRate::create([
            'admin_id' => Auth::guard('admin')->id(),
            'metal_type'      => $request->metal_type,
            'price_per_gram'  => $request->price_per_gram,
            // 'gram'            => $request->gram,
            'karat'           => $request->karat,
            'purity_type' => $request->purity_type,
        ]);

        return redirect()->back()->with('success', 'Metal rate added successfully!');
    }
    public function update(Request $request, $id)
    {
        $metalRate = MetalRate::findOrFail($id);

        $metalRate->update([
            'metal_type' => $request->metal_type,
            'price_per_gram' => $request->price_per_gram,
            'karat' => $request->karat,
            'purity_type' => $request->purity_type,
        ]);

        // Automaticaly update valuation for all available products
        app(\App\Services\ProductValuationService::class)->updateProductValuations($metalRate);

        return redirect()->back()->with('success', 'Metal rate updated and product valuations refreshed successfully!');
    }
    public function destroy($id)
    {
        $rate = MetalRate::findOrFail($id);
        $rate->delete();

        return redirect()->back()->with('success', 'Metal rate deleted successfully.');
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'rate_24k' => 'required|numeric|min:0',
            'silver_rate' => 'nullable|numeric|min:0',
        ]);

        $rate24k = $request->rate_24k;
        $karats = [24, 22, 20, 18, 14, 9];
        $adminId = Auth::guard('admin')->id();

        foreach ($karats as $karat) {
            $price = ($rate24k * $karat) / 24;
            $price = round($price, 2);

            $rate = MetalRate::where('admin_id', $adminId)
                ->where('metal_type', 'Gold')
                ->where('karat', (string)$karat)
                ->where('purity_type', 'karat')
                ->first();

            if ($rate) {
                $rate->update(['price_per_gram' => $price]);
                if (class_exists(\App\Services\ProductValuationService::class)) {
                    app(\App\Services\ProductValuationService::class)->updateProductValuations($rate);
                }
            } else {
                MetalRate::create([
                    'admin_id' => $adminId,
                    'metal_type' => 'Gold',
                    'price_per_gram' => $price,
                    'karat' => (string)$karat,
                    'purity_type' => 'karat',
                ]);
            }
        }

        if ($request->filled('silver_rate')) {
            $silverPrice = $request->silver_rate;
            $rate = MetalRate::where('admin_id', $adminId)
                ->where('metal_type', 'Silver')
                ->where('purity_type', 'karat')
                ->first();

            if ($rate) {
                $rate->update(['price_per_gram' => $silverPrice]);
                if (class_exists(\App\Services\ProductValuationService::class)) {
                    app(\App\Services\ProductValuationService::class)->updateProductValuations($rate);
                }
            } else {
                MetalRate::create([
                    'admin_id' => $adminId,
                    'metal_type' => 'Silver',
                    'price_per_gram' => $silverPrice,
                    'karat' => '24',
                    'purity_type' => 'karat',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Metal rates updated successfully!');
    }
}
