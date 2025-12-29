<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\InventoryTransaction;
use App\Models\ItemProductData;
use App\Models\ItemDiamondDetail;
use App\Models\ItemProductStone;
use App\Models\DiamondDetail;
use App\Models\StoneDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
 public function index()
{
    $products = ItemProductData::with(['category', 'subcategory', 'purity'])
        ->withSum([
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
        ->get()
        ->map(function ($item) {
            // Add sale_price - use mrp_price as sale_price for ItemProductData
            $item->sale_price = $item->sale_price ?? 0;
            return $item;
        });

    return view('Inventory.inventory', compact('products'));
}

public function stockIn(Request $request)
{
    // Validate that at least one ID is provided

    $request->validate([
        'product_id'           => 'nullable|exists:products,id',
        'item_product_data_id' => 'nullable|exists:item_product_data,id',
        'item_diamond_id'      => 'nullable|exists:item_diamond_details,diamond_id',
        'item_stone_id'        => 'nullable|exists:item_product_stones,stone_id',
        'quantity'             => 'required|numeric|min:1',
        'gross_weight'         => 'required|numeric|min:0',
        'net_weight'           => 'required|numeric|min:0',
        'gross_weight_unit'    => 'required',
    ], [
        // 'product_id.required' => 'Please select a product or item.',
        'item_product_data_id.required' => 'Please select a product or item.',
    ]);
    // dd($request->all());
    // Ensure at least one ID is provided
    if (!$request->product_id && !$request->item_product_data_id && !$request->item_diamond_id && !$request->item_stone_id) {
        return back()->withErrors(['error' => 'Please select a product, item product, item diamond, or item stone.']);
    }

    DB::transaction(function () use ($request) {
        $transactionData = [
            'type'         => 'IN',
            'quantity'     => $request->quantity,
            'gross_weight' => $request->gross_weight,
            'net_weight'   => $request->net_weight,
            'unit'         => $request->gross_weight_unit,
            'remarks'      => $request->remarks ?? 'Stock In',
            'admin_id'     => Auth::id(),
        ];

        // Handle regular product
        if ($request->product_id) {
            $product = Product::lockForUpdate()->findOrFail($request->product_id);

            // Get item_product_data_id from product
            if ($product->item_product_data_id) {
                $itemProduct = ItemProductData::with(['diamonds', 'stones'])->lockForUpdate()->findOrFail($product->item_product_data_id);

                // Generate unique post_code for this product instance
                $preCode = $request->pre_code ?? substr($itemProduct->product_code, 0, strpos($itemProduct->product_code, '-') ?: strlen($itemProduct->product_code));
                $lastProduct = Product::where('item_product_data_id', $itemProduct->id)
                    ->where('pre_code', $preCode)
                    ->orderBy('id', 'desc')
                    ->first();

                $postCode = $request->post_code ?? ($lastProduct ? (intval($lastProduct->post_code) + 1) : 1);

                // Ensure post_code is unique for this pre_code
                while (Product::where('item_product_data_id', $itemProduct->id)
                    ->where('pre_code', $preCode)
                    ->where('post_code', $postCode)
                    ->withTrashed()
                    ->exists()) {
                    $postCode++;
                }

                // Create new product from item_product_data
                $newProduct = Product::create([
                    'admin_id' => Auth::id(),
                    'product_name' => $itemProduct->product_name,
                    'item_product_data_id' => $itemProduct->id,
                    'pre_code' => $preCode,
                    'post_code' => (string)$postCode,
                    'barcode' => $request->barcode ?? null,
                    'category_id' => $itemProduct->category_id,
                    'subcategory_id' => $itemProduct->subcategory_id,
                    'purity_id' => $itemProduct->purity_id,
                    'metal_rate' => $itemProduct->metal_rate,
                    'gross_weight' => $request->gross_weight,
                    'net_weight' => $request->net_weight,
                    'hsn_code' => $itemProduct->hsn_code,
                    'gold_color' => $itemProduct->gold_purity,
                    'wastage_percent' => $itemProduct->wastage_percent,
                    'making_price' => $itemProduct->making_price,
                    'gold_price' => $itemProduct->gold_price,
                    'gst_percent' => $itemProduct->gst_percent,
                    'gst_amount' => $itemProduct->gst_amount,
                    'sale_price' => $itemProduct->sale_price,
                    'mrp_price' => $itemProduct->mrp_price,
                    'quantity' => $request->quantity,
                    'final_fn_weight' => $request->final_fn_weight ?? 0,
                ]);

                // Copy diamonds from item_product_data to new product
                foreach ($itemProduct->diamonds as $itemDiamond) {
                    DiamondDetail::create([
                        'admin_id' => Auth::id(),
                        'product_id' => $newProduct->id,
                        'clarity' => $itemDiamond->clarity,
                        'cut' => $itemDiamond->cut,
                        'color' => $itemDiamond->color,
                        'pieces' => $itemDiamond->pieces,
                        'diamond_weight' => $itemDiamond->diamond_weight,
                        'price_per_carat' => $itemDiamond->price_per_carat,
                        'diamond_final_price' => $itemDiamond->diamond_final_price,
                    ]);
                }

                // Copy stones from item_product_data to new product
                foreach ($itemProduct->stones as $itemStone) {
                    StoneDetail::create([
                        'admin_id' => Auth::id(),
                        'product_id' => $newProduct->id,
                        'stone_name' => $itemStone->stone_name,
                        'stone_weight' => $itemStone->stone_weight,
                        'stone_price' => $itemStone->stone_price,
                        'stone_final_price' => $itemStone->stone_final_price,
                    ]);
                }

                // Create inventory transaction using item_product_data_id
                $transactionData['item_product_data_id'] = $itemProduct->id;
                $transactionData['product_id'] = $newProduct->id;
                InventoryTransaction::create($transactionData);

                // Update product quantity
                $newProduct->update([
                    'quantity' => ($newProduct->quantity ?? 0) + $request->quantity,
                ]);
            } else {
                // Product without item_product_data_id - this shouldn't happen in new system
                // But handle it gracefully
                throw new \Exception('Product must be linked to an item_product_data');
            }
        }
        // Handle item product data - Create new product entry from item_product_data
        elseif ($request->item_product_data_id) {
            $itemProduct = ItemProductData::with(['diamonds', 'stones'])->lockForUpdate()->findOrFail($request->item_product_data_id);

            // Generate unique post_code for this product instance
            $preCode = $request->pre_code ?? substr($itemProduct->product_code, 0, strpos($itemProduct->product_code, '-') ?: strlen($itemProduct->product_code));
            $lastProduct = Product::where('item_product_data_id', $itemProduct->id)
                ->where('pre_code', $preCode)
                ->orderBy('id', 'desc')
                ->first();

            $postCode = $request->post_code ?? ($lastProduct ? (intval($lastProduct->post_code) + 1) : 1);

            // Ensure post_code is unique for this pre_code
            while (Product::where('item_product_data_id', $itemProduct->id)
                ->where('pre_code', $preCode)
                ->where('post_code', $postCode)
                ->withTrashed()
                ->exists()) {
                $postCode++;
            }

            // Create new product from item_product_data
            $newProduct = Product::create([
                'admin_id' => Auth::id(),
                'product_name' => $itemProduct->product_name,
                'item_product_data_id' => $itemProduct->id,
                'pre_code' => $preCode,
                'post_code' => (string)$postCode,
                'barcode' => $request->barcode ?? null,
                'category_id' => $itemProduct->category_id,
                'subcategory_id' => $itemProduct->subcategory_id,
                'purity_id' => $itemProduct->purity_id,
                'metal_rate' => $itemProduct->metal_rate,
                'gross_weight' => $request->gross_weight,
                'net_weight' => $request->net_weight,
                'hsn_code' => $itemProduct->hsn_code,
                'gold_color' => $itemProduct->gold_purity,
                'wastage_percent' => $itemProduct->wastage_percent,
                'making_price' => $itemProduct->making_price,
                'gold_price' => $itemProduct->gold_price,
                'gst_percent' => $itemProduct->gst_percent,
                'gst_amount' => $itemProduct->gst_amount,
                'sale_price' => $itemProduct->sale_price,
                'mrp_price' => $itemProduct->mrp_price,
                'quantity' => $request->quantity,
                'final_fn_weight' => $request->final_fn_weight ?? 0,
            ]);
            if (empty($product->barcode)) {
                $productCodePart = strtoupper(substr($newProduct->pre_code, 0, 3));
                $purity          = $newProduct->purity_id;
                $productId       = str_pad($newProduct->id, 4, '0', STR_PAD_LEFT);

                do {
                    $barcode = $productCodePart . '-' . $purity . '-' . $productId;
                    $exists  = Product::where('barcode', $barcode)->exists();

                    // edge case fallback
                    $productId++;
                } while ($exists);

                $newProduct->update([
                    'barcode' => $barcode
                ]);
            }

            // Copy diamonds from item_product_data to new product
            foreach ($itemProduct->diamonds as $itemDiamond) {
                DiamondDetail::create([
                    'admin_id' => Auth::id(),
                    'product_id' => $newProduct->id,
                    'clarity' => $itemDiamond->clarity,
                    'cut' => $itemDiamond->cut,
                    'color' => $itemDiamond->color,
                    'pieces' => $itemDiamond->pieces,
                    'diamond_weight' => $itemDiamond->diamond_weight,
                    'price_per_carat' => $itemDiamond->price_per_carat,
                    'diamond_final_price' => $itemDiamond->diamond_final_price,
                ]);
            }

            // Copy stones from item_product_data to new product
            foreach ($itemProduct->stones as $itemStone) {
                StoneDetail::create([
                    'admin_id' => Auth::id(),
                    'product_id' => $newProduct->id,
                    'stone_name' => $itemStone->stone_name,
                    'stone_weight' => $itemStone->stone_weight,
                    'stone_price' => $itemStone->stone_price,
                    'stone_final_price' => $itemStone->stone_final_price,
                ]);
            }

            // Create inventory transaction using item_product_data_id
            $transactionData['item_product_data_id'] = $itemProduct->id;
            $transactionData['product_id'] = $newProduct->id;
            InventoryTransaction::create($transactionData);

            // Update product quantity
            // $newProduct->update([
            //     'quantity' => ($newProduct->quantity ?? 0) + $request->quantity,
            // ]);
        }
        // Handle item diamond
        elseif ($request->item_diamond_id) {
            $transactionData['item_diamond_id'] = $request->item_diamond_id;
            InventoryTransaction::create($transactionData);
        }
        // Handle item stone
        elseif ($request->item_stone_id) {
            $transactionData['item_stone_id'] = $request->item_stone_id;
            InventoryTransaction::create($transactionData);
        }
    });

    return back()->with('success', 'Stock added successfully');
}
public function stockOut(Request $request)
{
    // Validate that at least one ID is provided
    // dd($request->all());
    $request->validate([
        'product_id'           => 'nullable|exists:products,id',
        'item_product_data_id' => 'nullable|exists:item_product_data,id',
        'selected_product_id'  => 'nullable|exists:products,id',
        'item_diamond_id'      => 'nullable|exists:item_diamond_details,diamond_id',
        'item_stone_id'        => 'nullable|exists:item_product_stones,stone_id',
    ]);

    // Ensure at least one ID is provided
    if (!$request->product_id && !$request->item_product_data_id && !$request->item_diamond_id && !$request->item_stone_id) {
        return back()->withErrors(['error' => 'Please select a product, item product, item diamond, or item stone.']);
    }

    DB::transaction(function () use ($request) {
        $transactionData = [
            'type'         => 'OUT',
            'quantity'     => $request->quantity,
            'gross_weight' => $request->gross_weight,
            'net_weight'   => $request->net_weight,
            'unit'         => $request->gross_weight_unit ?? 'GM',
            'remarks'      => $request->remarks ?? 'Stock Out',
            'admin_id'     => Auth::id(),
        ];

        // Handle regular product
        if ($request->product_id) {
            $product = Product::lockForUpdate()->findOrFail($request->product_id);

            if (
                ($product->quantity ?? 0) < $request->quantity ||
                ($product->gross_weight ?? 0) < $request->gross_weight ||
                ($product->net_weight ?? 0) < $request->net_weight
            ) {
                throw new \Exception('Insufficient stock');
            }

            // Get item_product_data_id from product
            if (!$product->item_product_data_id) {
                throw new \Exception('Product must be linked to an item_product_data');
            }

            // Create transaction using item_product_data_id
            $transactionData['item_product_data_id'] = $product->item_product_data_id;
            InventoryTransaction::create($transactionData);

            $product->quantity -= $request->quantity;
            $product->gross_weight -= $request->gross_weight;
            $product->net_weight -= $request->net_weight;
            $product->save();
        }
        // Handle item product data - requires product selection (stock out only on selected product)
        elseif ($request->item_product_data_id) {
            // Must have selected_product_id for stock out
            if (!$request->selected_product_id) {
                throw new \Exception('Please select a product to stock out');
            }

            $selectedProduct = Product::lockForUpdate()->findOrFail($request->selected_product_id);
            // dd($selectedProduct);
            $itemProduct = ItemProductData::lockForUpdate()->findOrFail($selectedProduct->item_product_data_id);

            // Verify product belongs to this item_product_data
            if ($selectedProduct->item_product_data_id != $itemProduct->id) {
                throw new \Exception('Selected product does not belong to this item');
            }

            // Verify sufficient stock
            // if (
            //     ($selectedProduct->quantity ?? 0) < $request->quantity ||
            //     ($selectedProduct->gross_weight ?? 0) < $request->gross_weight ||
            //     ($selectedProduct->net_weight ?? 0) < $request->net_weight
            // ) {
            //     throw new \Exception('Insufficient stock in selected product');
            // }

            // Create transaction using item_product_data_id
            $transactionData = [
                'type'         => 'OUT',
                'quantity'     => $selectedProduct->quantity,
                'gross_weight' => $selectedProduct->gross_weight,
                'net_weight'   => $selectedProduct->net_weight,
                'unit'         => $selectedProduct->gross_weight_unit ?? 'GM',
                'remarks'      => $selectedProduct->remarks ?? 'Stock Out',
                'admin_id'     => Auth::id(),
            ];
            $transactionData['item_product_data_id'] = $itemProduct->id;
            InventoryTransaction::create($transactionData);

            // Soft delete the product
            $itemProduct->gross_weight = max(0, ($itemProduct->gross_weight ?? 0) - $selectedProduct->gross_weight);
            $itemProduct->net_weight = max(0, ($itemProduct->net_weight ?? 0) - $selectedProduct->net_weight );
            // $itemProduct->quantity = max(0, ($itemProduct->quantity ?? 0) - $selectedProduct->quantity );
            $itemProduct->save();

            $selectedProduct->delete();

            // Update item_product_data totals

        }
        // Handle item diamond
        elseif ($request->item_diamond_id) {
            $transactionData['item_diamond_id'] = $request->item_diamond_id;
            InventoryTransaction::create($transactionData);
        }
        // Handle item stone
        elseif ($request->item_stone_id) {
            $transactionData['item_stone_id'] = $request->item_stone_id;
            InventoryTransaction::create($transactionData);
        }
    });

    return redirect()->back()->with('success', 'Stock out successfully');
}

public function getProductsForItem($itemId)
{

    $itemProduct = ItemProductData::findOrFail($itemId);
    $products = Product::where('item_product_data_id', $itemId)
        ->whereNull('deleted_at') // Only non-deleted products
        ->select('id', 'pre_code', 'post_code', 'product_name', 'quantity', 'gross_weight', 'net_weight', 'barcode')
        ->get()
        ->map(function($product) {
            return [
                'id' => $product->id,
                'code' => ($product->pre_code ?? '') . '-' . ($product->post_code ?? ''),
                'name' => $product->product_name,
                'quantity' => $product->quantity ?? 0,
                'gross_weight' => $product->gross_weight ?? 0,
                'net_weight' => $product->net_weight ?? 0,
                'barcode' => $product->barcode,
            ];
        });

    return response()->json($products);
}
public function history($id)
{
    // Try to find as ItemProductData first
    $itemProduct = ItemProductData::find($id);

    if ($itemProduct) {
        // Get all transactions for this item_product_data
        $transactions = InventoryTransaction::with(['product', 'itemProductData', 'itemDiamond', 'itemStone'])
            ->where('item_product_data_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Inventory.inventory-history', compact('itemProduct', 'transactions'));
    }

    // Fallback to Product - get its item_product_data_id and show those transactions
    $product = Product::findOrFail($id);

    if ($product->item_product_data_id) {
        $itemProduct = ItemProductData::find($product->item_product_data_id);
        $transactions = InventoryTransaction::with(['product', 'itemProductData'])
            ->where('item_product_data_id', $product->item_product_data_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Inventory.inventory-history', compact('itemProduct', 'transactions'));
    }

    // Product without item_product_data_id (legacy)
    $transactions = collect();
    return view('Inventory.inventory-history', compact('product', 'transactions'));
}

public function itemHistory($type, $id)
{
    $item = null;
    $transactions = collect();

    switch ($type) {
        case 'item_product':
            $item = ItemProductData::findOrFail($id);
            $transactions = InventoryTransaction::where('item_product_data_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
            break;
        case 'item_diamond':
            $item = ItemDiamondDetail::findOrFail($id);
            $transactions = InventoryTransaction::where('item_diamond_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
            break;
        case 'item_stone':
            $item = ItemProductStone::findOrFail($id);
            $transactions = InventoryTransaction::where('item_stone_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
            break;
        default:
            abort(404);
    }

    return view('Inventory.inventory-history', compact('item', 'transactions', 'type'));
}
public function indexInventory(Request $request)
{
    $query = Product::with('category')
        ->withSum([
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
        ], 'net_weight');

    // Product name search
    if ($request->filled('product_name')) {
        $query->where('product_name', 'LIKE', '%' . trim($request->product_name) . '%');
    }

    // Product code search
    if ($request->filled('product_code')) {
        $query->where('product_code', 'LIKE', '%' . trim($request->product_code) . '%');
    }

    // Category search
    if ($request->filled('category_name')) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('category_name', 'LIKE', '%' . trim($request->category_name) . '%');
        });
    }

    $products = $query->get();

    return view('Inventory.Inventory', compact('products'));
}

}
