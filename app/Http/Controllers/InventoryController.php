<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
{
    $products = Product::withSum([
        'inventoryTransactions as stock_in' => function ($q) {
            $q->where('type', 'IN');
        }
    ], 'gross_weight')
    ->withSum([
        'inventoryTransactions as stock_out' => function ($q) {
            $q->where('type', 'OUT');
        }
    ], 'gross_weight')
    ->get();

    return view('Inventory.inventory', compact('products'));
}

}
