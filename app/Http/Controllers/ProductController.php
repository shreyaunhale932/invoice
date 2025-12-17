<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\DiamondDetail;
use App\Models\StoneDetail;
use Illuminate\Http\Request;
use App\Models\MetalRate;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

use App\Models\PurityModel;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
   public function store(Request $request)
{
    DB::transaction(function () use ($request) {

        // Product
        $product = Product::create([
            'admin_id' => Auth::id(),
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
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
        ]);
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
           SAVE DIAMONDS
        ======================== */
        if ($request->has('diamond.clarity')) {
            foreach ($request->diamond['clarity'] as $index => $value) {
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
            }
        }

        /* =======================
           SAVE STONES
        ======================== */
        if ($request->has('stone.stone_name')) {
            foreach ($request->stone['stone_name'] as $index => $value) {
                StoneDetail::create([
                    'admin_id' => Auth::id(),
                    'product_id' => $product->id,
                    'stone_name' => $request->stone['stone_name'][$index],
                    'stone_weight' => $request->stone['stone_weight'][$index],
                    'stone_price' => $request->stone['stone_price'][$index],
                    'stone_final_price' => $request->stone['stone_final_price'][$index],
                ]);
            }
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

        // 🔹 Update Product
        $product = Product::where('id', $id)
            ->where('admin_id', Auth::id())
            ->firstOrFail();

        $product->update([
            'product_name'      => $request->product_name,
            'product_code'      => $request->product_code,
            'barcode'           => $request->barcode,
            'category_id'       => $request->category_id,
            'subcategory_id'    => $request->subcategory_id,
            'purity_id'         => $request->purity_id,
            'metal_rate'        => $request->metal_rate_id,
            'gross_weight'      => $request->gross_weight,
            'net_weight'        => $request->net_weight,
            'hsn_code'          => $request->hsn_code,
            'gold_color'        => $request->gold_color,
            'wastage_percent'   => $request->wastage_percent,
            'making_price'      => $request->making_price,
            'gold_price'        => $request->gold_price,
            'gst_percent'       => $request->gst_percent,
            'gst_amount'        => $request->gst_amount,
            'mrp_price'         => $request->mrp_price,
            'sale_price'        => $request->sale_price,
        ]);
        if ($request->hasFile('image')) {

            // delete old image
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

            $product->image = 'assets/products/' . $filename;
            $product->save();
        }

        /* =======================
           DELETE OLD DIAMONDS
        ======================== */
        DiamondDetail::where('product_id', $product->id)->delete();

        /* =======================
           SAVE UPDATED DIAMONDS
        ======================== */
        if ($request->has('diamond.clarity')) {
            foreach ($request->diamond['clarity'] as $index => $value) {
                DiamondDetail::create([
                    'admin_id'             => Auth::id(),
                    'product_id'           => $product->id,
                    'clarity'              => $request->diamond['clarity'][$index],
                    'cut'                  => $request->diamond['cut'][$index],
                    'color'                => $request->diamond['color'][$index],
                    'pieces'               => $request->diamond['pieces'][$index],
                    'diamond_weight'       => $request->diamond['diamond_weight'][$index],
                    'price_per_carat'      => $request->diamond['price_per_carat'][$index],
                    'diamond_final_price'  => $request->diamond['diamond_final_price'][$index],
                ]);
            }
        }

        /* =======================
           DELETE OLD STONES
        ======================== */
        StoneDetail::where('product_id', $product->id)->delete();

        /* =======================
           SAVE UPDATED STONES
        ======================== */
        if ($request->has('stone.stone_name')) {
            foreach ($request->stone['stone_name'] as $index => $value) {
                StoneDetail::create([
                    'admin_id'            => Auth::id(),
                    'product_id'          => $product->id,
                    'stone_name'          => $request->stone['stone_name'][$index],
                    'stone_weight'        => $request->stone['stone_weight'][$index],
                    'stone_price'         => $request->stone['stone_price'][$index],
                    'stone_final_price'   => $request->stone['stone_final_price'][$index],
                ]);
            }
        }

    });

   return redirect()->back()->with('success', 'Product Updated successfully');
}
public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete(); // soft delete

    return redirect()->route('product-list')
        ->with('success', 'Product deleted successfully');
}



}
