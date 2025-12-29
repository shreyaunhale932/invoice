<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\DiamondDetail;
use App\Models\StoneDetail;
use App\Models\ItemProductData;
use App\Models\ItemDiamondDetail;
use App\Models\ItemProductStone;
use Illuminate\Http\Request;
use App\Models\MetalRate;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

use App\Models\PurityModel;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\InventoryTransaction;



class ProductController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all);
        DB::transaction(function () use ($request) {
            $request->validate([
                'barcode'   => 'nullable|unique:products,barcode',
                'pre_code'  => 'required|string',
                'post_code' => 'required|string',
            ]);

            $preCode  = trim($request->pre_code);
            $postCode = trim($request->post_code);

            /*
            |--------------------------------------------------------------------------
            | Check if pre_code already exists in ItemProductData
            |--------------------------------------------------------------------------
            */
            $itemProduct = ItemProductData::where('product_code', $preCode)->first();

            if ($itemProduct) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'pre_code' => 'Invalid Pre Code. Item already exists.',
                    ])
                    ->withInput(); // ✅ keeps entered values
            }

            /*
            |--------------------------------------------------------------------------
            | Ensure post_code is unique for this pre_code
            |--------------------------------------------------------------------------
            */
            $exists = Product::where('pre_code', $preCode)
                ->where('post_code', $postCode)
                ->exists();

            if ($exists) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'post_code' => 'This Post Code already exists for the selected Pre Code.',
                    ])
                    ->withInput(); // keeps entered values
            }



            // Create or find item_product_data (shared data: product_name, pre_code, purity_id)
            $itemProductData = ItemProductData::firstOrCreate(
                [
                    'product_code' => $request->pre_code,
                    'product_name' => $request->product_name,
                    'purity_id' => $request->purity_id,
                ],
                [
                    'barcode' => $request->barcode,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'metal_rate' => $request->metal_rate_id,
                    'hsn_code' => $request->hsn_code,
                    'gold_purity' => $request->gold_color,
                    'gross_weight' => $request->gross_weight,
                    'net_weight' => $request->net_weight,
                    'diamond_weight' => $request->diamond_weight ?? 0,
                    'stone_weight' => $request->stone_weight ?? 0,
                    'wastage_percent' => $request->wastage_percent,
                    'making_price' => $request->making_price,
                    'gst_percent' => $request->gst_percent,
                    'gst_amount' => $request->gst_amount,
                    'gold_price' => $request->gold_price,
                    'mrp_price' => $request->mrp_price,
                    'sale_price' => $request->sale_price,
                ]
            );

            // Create Product linked to item_product_data
            $oldProduct = Product::where('item_product_data_id', $itemProductData->id)->first();
            if ($oldProduct) {
                $postid = $oldProduct->post_code;
                $postid++;
            } else {
                $postid = $request->post_code;
            }
            $product = Product::create([
                'admin_id' => Auth::id(),
                'product_name' => $request->product_name,
                'item_product_data_id' => $itemProductData->id,
                'pre_code' => $request->pre_code,
                'post_code' => $request->post_code,
                'barcode' => $request->barcode,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'purity_id' => $request->purity_id,
                'metal_rate' => $request->metal_rate_id,
                'gross_weight' => $request->gross_weight,
                'net_weight' => $request->net_weight,
                'hsn_code' => $request->hsn_code,
                'gold_color' => $request->gold_color,
                'wastage_percent' => $request->wastage_percent,
                'making_price' => $request->making_price,
                'gold_price' => $request->gold_price,
                'gst_percent' => $request->gst_percent,
                'gst_amount' => $request->gst_amount,
                'mrp_price' => $request->mrp_price,
                'sale_price' => $request->sale_price,
                'quantity' =>  $request->quantity,
                'final_fn_weight' =>  $request->final_fn_weight,
                'size'     =>  $request->size,
            ]);
            if (empty($product->barcode)) {
                $productCodePart = strtoupper(substr($product->pre_code, 0, 3));
                $purity          = $product->purity_id;
                $productId       = str_pad($product->id, 4, '0', STR_PAD_LEFT);

                do {
                    $barcode = $productCodePart . '-' . $purity . '-' . $productId;
                    $exists  = Product::where('barcode', $barcode)->exists();

                    // edge case fallback
                    $productId++;
                } while ($exists);

                $product->update([
                    'barcode' => $barcode
                ]);
            }



            if ($request->hasFile('image')) {

                $manager  = new ImageManager(new GdDriver());
                $file     = $request->file('image');
                $filename = 'Product_' . time() . '.' . $file->getClientOriginalExtension();

                $image = $manager->read($file->getPathname());
                $image->resize(500, 500);

                $path = public_path('assets/products/' . $filename);
                $image->toJpeg(90)->save($path);

                $product->image = 'assets/products/' . $filename;
                $product->save();
            }
            /* =======================
           SAVE DIAMONDS (Product and Item)
        ======================== */
            if ($request->has('diamond.clarity')) {
                foreach ($request->diamond['clarity'] as $index => $value) {
                    // Create product diamond
                    DiamondDetail::create([
                        'admin_id' => Auth::id(),
                        'product_id' => $product->id,
                        'clarity' => $request->diamond['clarity'][$index],
                        'cut' => $request->diamond['cut'][$index],
                        'color' => $request->diamond['color'][$index],
                        'pieces' => $request->diamond['pieces'][$index],
                        'diamond_weight' => $request->diamond['diamond_weight'][$index],
                        'price_per_carat' => $request->diamond['price_per_carat'][$index],
                        'diamond_final_price' => $request->diamond['diamond_final_price'][$index],
                    ]);

                    // Create item diamond
                    ItemDiamondDetail::create([
                        'item_product_data_id' => $itemProductData->id,
                        'clarity' => $request->diamond['clarity'][$index],
                        'cut' => $request->diamond['cut'][$index],
                        'color' => $request->diamond['color'][$index],
                        'pieces' => $request->diamond['pieces'][$index],
                        'diamond_weight' => $request->diamond['diamond_weight'][$index],
                        'price_per_carat' => $request->diamond['price_per_carat'][$index],
                        'diamond_final_price' => $request->diamond['diamond_final_price'][$index],
                    ]);
                }
            }

            /* =======================
           SAVE STONES (Product and Item)
        ======================== */
            if ($request->has('stone.stone_name')) {
                foreach ($request->stone['stone_name'] as $index => $value) {
                    // Create product stone
                    StoneDetail::create([
                        'admin_id' => Auth::id(),
                        'product_id' => $product->id,
                        'stone_name' => $request->stone['stone_name'][$index],
                        'stone_weight' => $request->stone['stone_weight'][$index],
                        'stone_price' => $request->stone['stone_price'][$index],
                        'stone_final_price' => $request->stone['stone_final_price'][$index],
                    ]);

                    // Create item stone
                    ItemProductStone::create([
                        'item_product_data_id' => $itemProductData->id,
                        'admin_id' => Auth::id(),
                        'stone_name' => $request->stone['stone_name'][$index],
                        'stone_weight' => $request->stone['stone_weight'][$index],
                        'stone_price' => $request->stone['stone_price'][$index],
                        'stone_final_price' => $request->stone['stone_final_price'][$index],
                    ]);
                }
            }
            // Create transaction using item_product_data_id
            if ($product->item_product_data_id) {
                InventoryTransaction::create([
                    'admin_id'             => Auth::id(),
                    'item_product_data_id' => $product->item_product_data_id,
                    'product_id'          => $product->id,
                    'type'                 => 'IN',
                    'gross_weight'         => $request->gross_weight,
                    'net_weight'           => $request->net_weight,
                    'final_fn_weight'      => $request->final_fn_weight,
                    'quantity'             => $request->quantity,
                    'unit'                 => 'GM',
                    'remarks'              => 'Initial stock added with product creation',
                ]);
            }
        });

        return redirect()->back()->with('success', 'Product added successfully');
    }

    public function checkProductCode(Request $request)
    {
        $exists = Product::where('product_code', $request->product_code)
            ->where('admin_id', Auth::id()) // important for multi-admin
            ->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }
    public function edit($id)
    {
        $product = Product::with([
            'category',
            'subcategory',
            'diamonds',
            'stones'
        ])->findOrFail($id);

        $categories = Category::where('admin_id', Auth::id())->get();

        $subcategories = Subcategory::where('admin_id', Auth::id())->get();

        $purities = PurityModel::where('admin_id', Auth::id())->get();

        $metalRates = MetalRate::where('admin_id', Auth::id())->get();

        return view(
            'Inventory.Products.add-products',
            compact(
                'product',
                'categories',
                'subcategories',
                'purities',
                'metalRates'
            )
        );
    }
    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $request->validate([
                'barcode'   => 'nullable|unique:products,barcode,' . $id,
                'pre_code'  => 'required|string',
                'post_code' => 'required|string',
            ]);

            $product = Product::where('id', $id)
                ->where('admin_id', Auth::id())
                ->firstOrFail();

            $preCode  = trim($request->pre_code);
            $postCode = trim($request->post_code);

            /*
        |--------------------------------------------------------------------------
        | 1️⃣ Validate Post Code uniqueness (excluding current product)
        |--------------------------------------------------------------------------
        */
            $exists = Product::where('pre_code', $preCode)
                ->where('post_code', $postCode)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withErrors(['post_code' => 'This Post Code already exists for this Pre Code.'])
                    ->withInput();
            }

            /*
        |--------------------------------------------------------------------------
        | 2️⃣ Update ItemProductData (shared data)
        |--------------------------------------------------------------------------
        */
            $itemProductData = ItemProductData::where('id', $product->item_product_data_id)->first();

            if ($itemProductData) {
                $itemProductData->update([
                    'product_code'     => $preCode,
                    'product_name'     => $request->product_name,
                    'purity_id'        => $request->purity_id,
                    'barcode'          => $request->barcode,
                    'category_id'      => $request->category_id,
                    'subcategory_id'   => $request->subcategory_id,
                    'metal_rate'       => $request->metal_rate_id,
                    'hsn_code'         => $request->hsn_code,
                    'gold_purity'      => $request->gold_color,
                    'gross_weight'     => $request->gross_weight,
                    'net_weight'       => $request->net_weight,
                    'diamond_weight'   => $request->diamond_weight ?? 0,
                    'stone_weight'     => $request->stone_weight ?? 0,
                    'wastage_percent'  => $request->wastage_percent,
                    'making_price'     => $request->making_price,
                    'gst_percent'      => $request->gst_percent,
                    'gst_amount'       => $request->gst_amount,
                    'gold_price'       => $request->gold_price,
                    'mrp_price'        => $request->mrp_price,
                    'sale_price' => $request->sale_price,
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | Update Product
        |--------------------------------------------------------------------------
        */
            $product->update([
                'product_name'     => $request->product_name,
                'pre_code'         => $preCode,
                'post_code'        => $postCode,
                'barcode'          => $request->barcode,
                'category_id'      => $request->category_id,
                'subcategory_id'   => $request->subcategory_id,
                'purity_id'        => $request->purity_id,
                'metal_rate'       => $request->metal_rate_id,
                'gross_weight'     => $request->gross_weight,
                'net_weight'       => $request->net_weight,
                'hsn_code'         => $request->hsn_code,
                'gold_color'       => $request->gold_color,
                'wastage_percent'  => $request->wastage_percent,
                'making_price'     => $request->making_price,
                'gold_price'       => $request->gold_price,
                'gst_percent'      => $request->gst_percent,
                'gst_amount'       => $request->gst_amount,
                'mrp_price'        => $request->mrp_price,
                'sale_price'       => $request->sale_price,
                'quantity'         => $request->quantity,
                'final_fn_weight'  => $request->final_fn_weight,
                'size'             => $request->size,
            ]);

            /*
        |--------------------------------------------------------------------------
        | 4️⃣ Auto-generate barcode if empty
        |--------------------------------------------------------------------------
        */
            if (empty($product->barcode)) {
                $productCodePart = strtoupper(substr($product->pre_code, 0, 3));
                $purity          = $product->purity_id;
                $productId       = str_pad($product->id, 4, '0', STR_PAD_LEFT);

                do {
                    $barcode = $productCodePart . '-' . $purity . '-' . $productId;
                    $exists  = Product::where('barcode', $barcode)->exists();
                    $productId++;
                } while ($exists);

                $product->update(['barcode' => $barcode]);
            }

            /*
        |--------------------------------------------------------------------------
        | Image Upload
        |--------------------------------------------------------------------------
        */
            if ($request->hasFile('image')) {

                if ($product->image && file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }

                $manager  = new ImageManager(new GdDriver());
                $file     = $request->file('image');
                $filename = 'Product_' . time() . '.' . $file->getClientOriginalExtension();

                $image = $manager->read($file->getPathname());
                $image->resize(500, 500);

                $path = public_path('assets/products/' . $filename);
                $image->toJpeg(90)->save($path);

                $product->update(['image' => 'assets/products/' . $filename]);
            }

            /*
        |--------------------------------------------------------------------------
        | Diamonds (Delete + Reinsert Product + Item)
        |--------------------------------------------------------------------------
        */
            DiamondDetail::where('product_id', $product->id)->delete();
            ItemDiamondDetail::where('item_product_data_id', $itemProductData->id)->delete();

            if ($request->has('diamond.clarity')) {
                foreach ($request->diamond['clarity'] as $index => $value) {

                    DiamondDetail::create([
                        'admin_id'            => Auth::id(),
                        'product_id'          => $product->id,
                        'clarity'             => $value,
                        'cut'                 => $request->diamond['cut'][$index],
                        'color'               => $request->diamond['color'][$index],
                        'pieces'              => $request->diamond['pieces'][$index],
                        'diamond_weight'      => $request->diamond['diamond_weight'][$index],
                        'price_per_carat'     => $request->diamond['price_per_carat'][$index],
                        'diamond_final_price' => $request->diamond['diamond_final_price'][$index],
                    ]);

                    ItemDiamondDetail::create([
                        'item_product_data_id' => $itemProductData->id,
                        'clarity'             => $value,
                        'cut'                 => $request->diamond['cut'][$index],
                        'color'               => $request->diamond['color'][$index],
                        'pieces'              => $request->diamond['pieces'][$index],
                        'diamond_weight'      => $request->diamond['diamond_weight'][$index],
                        'price_per_carat'     => $request->diamond['price_per_carat'][$index],
                        'diamond_final_price' => $request->diamond['diamond_final_price'][$index],
                    ]);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Stones (Delete + Reinsert Product + Item)
        |--------------------------------------------------------------------------
        */
            StoneDetail::where('product_id', $product->id)->delete();
            ItemProductStone::where('item_product_data_id', $itemProductData->id)->delete();

            if ($request->has('stone.stone_name')) {
                foreach ($request->stone['stone_name'] as $index => $value) {

                    StoneDetail::create([
                        'admin_id'          => Auth::id(),
                        'product_id'        => $product->id,
                        'stone_name'        => $value,
                        'stone_weight'      => $request->stone['stone_weight'][$index],
                        'stone_price'       => $request->stone['stone_price'][$index],
                        'stone_final_price' => $request->stone['stone_final_price'][$index],
                    ]);

                    ItemProductStone::create([
                        'admin_id'              => Auth::id(),
                        'item_product_data_id'  => $itemProductData->id,
                        'stone_name'            => $value,
                        'stone_weight'          => $request->stone['stone_weight'][$index],
                        'stone_price'           => $request->stone['stone_price'][$index],
                        'stone_final_price'     => $request->stone['stone_final_price'][$index],
                    ]);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Inventory Transaction
        |--------------------------------------------------------------------------
        */
            $inventoryTransaction = InventoryTransaction::where('product_id', $product->id)
                ->where('item_product_data_id', $itemProductData->id)
                ->where('type', 'IN')
                ->first();

            if ($inventoryTransaction) {

                // ✅ UPDATE existing inventory transaction
                $inventoryTransaction->update([
                    'gross_weight'    => $request->gross_weight,
                    'net_weight'      => $request->net_weight,
                    'final_fn_weight' => $request->final_fn_weight,
                    'quantity'        => $request->quantity,
                    'remarks'         => 'Product updated',
                ]);
            } else {

                // ✅ CREATE only if not exists (optional safety)
                InventoryTransaction::create([
                    'admin_id'             => Auth::id(),
                    'item_product_data_id' => $itemProductData->id,
                    'product_id'           => $product->id,
                    'type'                 => 'IN',
                    'gross_weight'         => $request->gross_weight,
                    'net_weight'           => $request->net_weight,
                    'final_fn_weight'      => $request->final_fn_weight,
                    'quantity'             => $request->quantity,
                    'unit'                 => 'GM',
                    'remarks'              => 'Product updated',
                ]);
            }
        });

        return redirect()->back()->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $product = Product::where('id', $id)
                ->where('admin_id', Auth::id())
                ->firstOrFail();

            // ✅ Delete inventory transactions
            InventoryTransaction::where('product_id', $product->id)->delete();

            // Optional: delete related product details
            DiamondDetail::where('product_id', $product->id)->delete();
            StoneDetail::where('product_id', $product->id)->delete();

            // ✅ Finally delete product
            $product->delete();
        });

        return redirect()->route('product-list')
            ->with('success', 'Product and inventory transactions deleted successfully');
    }

    public function getSubcategories($category_id)
    {
        return Subcategory::where('category_id', $category_id)
            ->select('subcategory_id', 'subcategory_name')
            ->get();
    }
    public function index(Request $request)
    {

        $query = Product::with('category');

        // Product name search
        if ($request->filled('product_name')) {
            $query->where('product_name', $request->product_name);
        }


        // Product code filter
        if ($request->filled('product_code')) {
            $query->where('product_code', 'LIKE', '%' . trim($request->product_code) . '%');
        }


        // Category filter
        if ($request->filled('category_name')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('category_name', 'LIKE', '%' . trim($request->category_name) . '%');
            });
        }


        $products = $query->get();

        return view('Inventory/Products/product-list', compact('products'));
    }
}
