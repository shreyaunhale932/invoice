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
        ]);

        // Save data to database
        $metalRate = MetalRate::create([
            'admin_id' => Auth::id(),
            'metal_type'      => $request->metal_type,
            'price_per_gram'  => $request->price_per_gram,
            // 'gram'            => $request->gram,
            'karat'           => $request->karat,
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
    ]);

    return redirect()->back()->with('success', 'Metal rate updated successfully!');
}
public function destroy($id)
{
    $rate = MetalRate::findOrFail($id);
    $rate->delete();

    return redirect()->back()->with('success', 'Metal rate deleted successfully.');
}



}
