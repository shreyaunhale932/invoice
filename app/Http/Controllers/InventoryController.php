<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\InventoryTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
 public function index()
{
    $products = Product::withSum([
            'inventoryTransactions as in_qty' => fn ($q) => $q->where('type', 'IN')
        ], 'quantity')
        ->withSum([
            'inventoryTransactions as out_qty' => fn ($q) => $q->where('type', 'OUT')
        ], 'quantity')

        ->withSum([
            'inventoryTransactions as in_gross' => fn ($q) => $q->where('type', 'IN')
        ], 'gross_weight')
        ->withSum([
            'inventoryTransactions as out_gross' => fn ($q) => $q->where('type', 'OUT')
        ], 'gross_weight')

        ->withSum([
            'inventoryTransactions as in_net' => fn ($q) => $q->where('type', 'IN')
        ], 'net_weight')
        ->withSum([
            'inventoryTransactions as out_net' => fn ($q) => $q->where('type', 'OUT')
        ], 'net_weight')

        ->get();

    return view('Inventory.inventory', compact('products'));
}

public function stockIn(Request $request)
{
    $request->validate([
        'product_id'        => 'required|exists:products,id',
        'quantity'          => 'required|numeric|min:1',
        'gross_weight'      => 'required|numeric|min:0',
        'net_weight'        => 'required|numeric|min:0',
        'gross_weight_unit' => 'required',
    ]);

    DB::transaction(function () use ($request) {

        $product = Product::lockForUpdate()->findOrFail($request->product_id);

        InventoryTransaction::create([
            'product_id'   => $request->product_id,
            'type'         => 'IN',
            'quantity'     => $request->quantity,
            'gross_weight' => $request->gross_weight,
            'net_weight'   => $request->net_weight,
            'unit'         => $request->gross_weight_unit,
            'remarks'      => $request->remarks ?? 'Stock In',
            'admin_id'     => Auth::id(),
        ]);

        $product->update([
            'quantity'     => $product->quantity + $request->quantity,
            'gross_weight' => $product->gross_weight + $request->gross_weight,
            'net_weight'   => $product->net_weight + $request->net_weight,
        ]);
    });

    return back()->with('success', 'Stock added successfully');
}
public function stockOut(Request $request)
{
   $request->validate([
        'product_id'   => 'required|exists:products,id',
        'quantity'     => 'required|numeric|min:1',
        'gross_weight' => 'required|numeric|min:0.001',
        'net_weight'   => 'required|numeric|min:0.001',
    ]);

    DB::transaction(function () use ($request) {

        $product = Product::lockForUpdate()->findOrFail($request->product_id);

        if (
            $product->quantity < $request->quantity ||
            $product->gross_weight < $request->gross_weight ||
            $product->net_weight < $request->net_weight
        ) {
            throw new \Exception('Insufficient stock');
        }

       $product->quantity -= $request->quantity;
        $product->gross_weight -= $request->gross_weight;
        $product->net_weight -= $request->net_weight;
        $product->save();

        InventoryTransaction::create([
            'product_id'        => $product->id,
            'type'              => 'OUT',
            'quantity'          => $request->quantity,
            'gross_weight'      => $request->gross_weight,
            'net_weight'        => $request->net_weight,
            'gross_weight_unit' => $request->gross_weight_unit,
            'net_weight_unit'   => $request->net_weight_unit,
            'remarks'           => $request->remarks,
        ]);
    });

    return redirect()->back()->with('success', 'Stock out successfully');
}
public function history($id)
{
    $product = Product::findOrFail($id);

    $transactions = InventoryTransaction::where('product_id', $id)
                        ->orderBy('created_at', 'desc')
                        ->get();

    return view('Inventory.inventory-history', compact('product', 'transactions'));
}

}
