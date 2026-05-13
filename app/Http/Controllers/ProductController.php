<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DiamondDetail;
use App\Models\InventoryTransaction;
use App\Models\ItemDiamondDetail;
use App\Models\ItemProductData;
use App\Models\ItemProductStone;
use App\Models\MetalRate;
use App\Models\PacketMaster;
use App\Models\Product;
use App\Models\ProductPacket;
use App\Models\PurityModel;
use App\Models\StoneDetail;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all);
        DB::transaction(function () use ($request) {
            $request->validate([
                'barcode' => 'nullable|unique:products,barcode',
                'pre_code' => 'required|string',
                'post_code' => 'required|string',
            ]);

            $preCode = trim($request->pre_code);
            $postCode = trim($request->post_code);

            /*
            |--------------------------------------------------------------------------
            | Check if pre_code already exists in ItemProductData
            |--------------------------------------------------------------------------
            */
            $originalItem = ItemProductData::where('product_name', $request->product_name)
                ->where('purity_id', $request->purity_id)
                ->first();

            if ($originalItem && $originalItem->product_code !== $preCode) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'pre_code' => 'This product already exists with Pre Code: '.$originalItem->product_code,
                    ])
                    ->withInput();
            }
            $itemProduct = ItemProductData::where('product_code', $preCode)->first();
            //  dd($itemProduct);
            if ($itemProduct) {
                 dd('Reequest product name=>'.$request->product_name.'   Item product name=>'.$itemProduct->product_name);
                //  echo ''
                // pre_code used for another product → ERROR
                if (
                    $itemProduct->product_name != $request->product_name ||
                    $itemProduct->purity_id != $request->purity_id
                ) {
                    return redirect()
                        ->back()
                        ->withErrors([
                            'pre_code' => 'Pre code already present for another product.',
                        ])
                        ->withInput();
                }
            }
            /*
            |--------------------------------------------------------------------------
            | Ensure post_code is unique for this pre_code
            |--------------------------------------------------------------------------
            */
            // $exists = Product::where('pre_code', $preCode)
            //     ->where('post_code', $postCode)
            //     ->exists();

            // if ($exists) {
            //     return redirect()
            //         ->back()
            //         ->withErrors([
            //             'post_code' => 'This Post Code already exists for the selected Pre Code.',
            //         ])
            //         ->withInput(); // keeps entered values
            // }

            // dd( $request->making_type);
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
                    'final_fn_weight' => $request->final_fn_weight,
                    'diamond_weight' => $request->diamond_weight ?? 0,
                    'stone_weight' => $request->stone_weight ?? 0,
                    'wastage_percent' => $request->wastage_percent,
                    'making_price' => $request->making_price,
                    'gst_percent' => $request->gst_percent,
                    'gst_amount' => $request->gst_amount,
                    'gold_price' => $request->gold_price,
                    'mrp_price' => $request->mrp_price,
                    'sale_price' => $request->sale_price,
                    'final_price' => $request->final_price,
                    'making_type' => $request->making_type,
                    'making_final_amount' => $request->making_final_amount,

                ]
            );

            // Create Product linked to item_product_data
            $oldProduct = Product::withTrashed()
                ->where('item_product_data_id', $itemProductData->id)
                ->orderByDesc('post_code')
                ->first();

            if ($oldProduct) {
                $postid = $oldProduct->post_code + 1;
            } else {
                $postid = $request->post_code;
            }

            $product = Product::create([
                'admin_id' => Auth::guard('admin')->id(),
                'product_name' => $request->product_name,
                'item_product_data_id' => $itemProductData->id,
                'pre_code' => $request->pre_code,
                'post_code' => $postid,
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
                'quantity' => $request->quantity,
                'final_fn_weight' => $request->final_fn_weight,
                'size' => $request->size,
                'final_price' => $request->final_price,
                'making_type' => $request->making_type,
                'making_final_amount' => $request->making_final_amount,
                'hallmarking' => $request->hallmarking,

            ]);
            // if (empty($product->barcode)) {
            //     $productCodePart = strtoupper(substr($product->pre_code, 0, 3));
            //     $purity          = $product->purity_id;
            //     $productId       = str_pad($product->id, 4, '0', STR_PAD_LEFT);

            //     do {
            //         $barcode = $productCodePart . '-' . $purity . '-' . $productId;
            //         $exists  = Product::where('barcode', $barcode)->exists();

            //         // edge case fallback
            //         $productId++;
            //     } while ($exists);

            //     $product->update([
            //         'barcode' => $barcode
            //     ]);
            // }

            if ($request->hasFile('image')) {

                $manager = new ImageManager(new GdDriver);
                $file = $request->file('image');
                $filename = 'Product_'.time().'.'.$file->getClientOriginalExtension();

                $image = $manager->read($file->getPathname());
                $image->resize(500, 500);

                $path = public_path('assets/products/'.$filename);
                $image->toJpeg(90)->save($path);

                $product->image = 'assets/products/'.$filename;
                $product->save();
            }
            /* =======================
           SAVE DIAMONDS (Product and Item)
        ======================== */
            if ($request->has('diamond.clarity')) {
                foreach ($request->diamond['clarity'] as $index => $value) {
                    // Create product diamond
                    DiamondDetail::create([
                        'admin_id' => Auth::guard('admin')->id(),
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
                        'admin_id' => Auth::guard('admin')->id(),
                        'product_id' => $product->id,
                        'stone_name' => $request->stone['stone_name'][$index],
                        'stone_weight' => $request->stone['stone_weight'][$index],
                        'stone_price' => $request->stone['stone_price'][$index],
                        'stone_final_price' => $request->stone['stone_final_price'][$index],
                    ]);

                    // Create item stone
                    ItemProductStone::create([
                        'item_product_data_id' => $itemProductData->id,
                        'admin_id' => Auth::guard('admin')->id(),
                        'stone_name' => $request->stone['stone_name'][$index],
                        'stone_weight' => $request->stone['stone_weight'][$index],
                        'stone_price' => $request->stone['stone_price'][$index],
                        'stone_final_price' => $request->stone['stone_final_price'][$index],
                    ]);
                }
            }
            /* =======================
           SAVE PACKETS (Product Only)
        ======================== */
            if ($request->has('packet.packet_no')) {
                foreach ($request->packet['packet_no'] as $index => $value) {
                    if (! empty($value)) {
                        ProductPacket::create([
                            'product_id' => $product->id,
                            'packet_no' => $value,
                            'packet_master_id' => $request->packet['packet_master_id'][$index] ?? null,
                            'stone_id' => $request->packet['stone_id'][$index] ?? null,
                            'clarity_id' => $request->packet['clarity_id'][$index] ?? null,
                            'color_id' => $request->packet['color_id'][$index] ?? null,
                            'cut_id' => $request->packet['cut_id'][$index] ?? null,
                            'shape_id' => $request->packet['shape_id'][$index] ?? null,
                            'chalni_id' => $request->packet['chalni_id'][$index] ?? null,
                            'mm_id' => $request->packet['mm_id'][$index] ?? null,
                            'weight' => $request->packet['weight'][$index] ?? 0,
                            'wt_in_gram' => $request->packet['wt_in_gram'][$index] ?? 0,
                            'pcs' => $request->packet['pcs'][$index] ?? 0,
                            'amount' => $request->packet['amount'][$index] ?? 0,
                            'uom' => $request->packet['uom'][$index] ?? 0,
                            'rate' => $request->packet['rate'][$index] ?? 0,
                            'solitaire' => isset($request->packet['solitaire'][$index]) ? 1 : 0,
                            'certificate_no' => $request->packet['certificate_no'][$index] ?? null,
                        ]);
                    }
                }
            }

            // Create transaction using item_product_data_id
            if ($product->item_product_data_id) {
                InventoryTransaction::create([
                    'admin_id' => Auth::guard('admin')->id(),
                    'item_product_data_id' => $product->item_product_data_id,
                    'product_id' => $product->id,
                    'type' => 'IN',
                    'gross_weight' => $request->gross_weight,
                    'net_weight' => $request->net_weight,
                    'final_fn_weight' => $request->final_fn_weight,
                    'quantity' => $request->quantity,
                    'unit' => 'GM',
                    'remarks' => 'Initial stock added with product creation',
                ]);
            }

            // Accounting Post
            // try {
            //     app(\App\Services\AccountingService::class)->postStockIn($product, $product->final_price);
            // } catch (\Exception $e) {
            //     // Log or handle error if needed, but don't break transaction if accounting is secondary
            //     // Actually, user wants Trial Balance to always match, so maybe it SHOULD break transaction.
            //     // But for safety against missing accounts:
            //     \Log::error('Accounting Post failed for Stock In: '.$e->getMessage());
            // }
        });

        return redirect()->back()->with('success', 'Product added successfully');
    }

    public function checkProductCode(Request $request)
    {
        $exists = Product::where('product_code', $request->product_code)
            ->where('admin_id', Auth::guard('admin')->id()) // important for multi-admin
            ->exists();

        return response()->json([
            'exists' => $exists,
        ]);
    }

    public function edit($id)
    {
        $product = Product::with([
            'category',
            'subcategory',
            'diamonds',
            'stones',
            'packets.packetMaster', // Eager load packet relation
            'packets.stone',
            'packets.clarity',
            'packets.color',
            'packets.cut',
            'packets.shape',
            'packets.chalni',
            'packets.mm',
        ])->findOrFail($id);

        $categories = Category::where('admin_id', Auth::guard('admin')->id())->get();

        $subcategories = Subcategory::where('admin_id', Auth::guard('admin')->id())->get();

        $purities = PurityModel::where('admin_id', Auth::guard('admin')->id())->get();

        $metalRates = MetalRate::where('admin_id', Auth::guard('admin')->id())->get();

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
                'barcode' => 'nullable|unique:products,barcode,'.$id,
                'pre_code' => 'required|string',
                'post_code' => 'required|string',
            ]);

            $product = Product::where('id', $id)
                ->where('admin_id', Auth::guard('admin')->id())
                ->firstOrFail();

            $preCode = trim($request->pre_code);
            $postCode = trim($request->post_code);

            /*
        |--------------------------------------------------------------------------
        | Validate Post Code uniqueness (excluding current product)
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
        |Update ItemProductData (shared data)
        |--------------------------------------------------------------------------
        */
            $itemProductData = ItemProductData::where('id', $product->item_product_data_id)->first();

            if ($itemProductData) {
                $itemProductData->update([
                    'product_code' => $preCode,
                    'product_name' => $request->product_name,
                    'purity_id' => $request->purity_id,
                    'barcode' => $request->barcode,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'metal_rate' => $request->metal_rate_id,
                    'hsn_code' => $request->hsn_code,
                    'gold_purity' => $request->gold_color,
                    'gross_weight' => $request->gross_weight,
                    'net_weight' => $request->net_weight,
                    'final_fn_weight' => $request->final_fn_weight,
                    'diamond_weight' => $request->diamond_weight ?? 0,
                    'stone_weight' => $request->stone_weight ?? 0,
                    'wastage_percent' => $request->wastage_percent,
                    'making_price' => $request->making_price,
                    'making_type' => $request->making_type,
                    'making_final_amount' => $request->making_final_amount,
                    'gst_percent' => $request->gst_percent,
                    'gst_amount' => $request->gst_amount,
                    'gold_price' => $request->gold_price,
                    'mrp_price' => $request->mrp_price,
                    'sale_price' => $request->sale_price,
                    'final_price' => $request->final_price,
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | Update Product
        |--------------------------------------------------------------------------
        */
            $product->update([
                'product_name' => $request->product_name,
                'pre_code' => $preCode,
                'post_code' => $postCode,
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
                'quantity' => $request->quantity,
                'final_fn_weight' => $request->final_fn_weight,
                'size' => $request->size,
                'final_price' => $request->final_price,
                'making_type' => $request->making_type,
                'making_final_amount' => $request->making_final_amount,
                'hallmarking' => $request->hallmarking,

            ]);

            /*
        |--------------------------------------------------------------------------
        | Auto-generate barcode if empty
        |--------------------------------------------------------------------------
        */
            // if (empty($product->barcode)) {
            //     $productCodePart = strtoupper(substr($product->pre_code, 0, 3));
            //     $purity          = $product->purity_id;
            //     $productId       = str_pad($product->id, 4, '0', STR_PAD_LEFT);

            //     do {
            //         $barcode = $productCodePart . '-' . $purity . '-' . $productId;
            //         $exists  = Product::where('barcode', $barcode)->exists();
            //         $productId++;
            //     } while ($exists);

            //     $product->update(['barcode' => $barcode]);
            // }

            /*
        |--------------------------------------------------------------------------
        | Image Upload
        |--------------------------------------------------------------------------
        */
            if ($request->hasFile('image')) {
                // dd('hii');

                if ($product->image && file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }

                // $manager = new ImageManager(new GdDriver);
                // $file = $request->file('image');
                // $filename = 'Product_'.time().'.'.$file->getClientOriginalExtension();

                // $image = $manager->read($file->getPathname());
                // $image->resize(500, 500);

                // $path = public_path('assets/products/'.$filename);
                // $image->toJpeg(90)->save($path);

                // $product->update(['image' => 'assets/products/'.$filename]);

                $manager = new ImageManager(new GdDriver);
                $file = $request->file('image');
                $filename = 'Product_'.time().'.'.$file->getClientOriginalExtension();

                $image = $manager->read($file->getPathname());
                $image->resize(500, 500);

                $path = public_path('assets/products/'.$filename);
                $image->toJpeg(90)->save($path);

                $product->image = 'assets/products/'.$filename;
                $product->save();

            }

            /*
        |--------------------------------------------------------------------------
        | Diamonds (Delete + Reinsert Product + Item)
        |--------------------------------------------------------------------------
        */
            DiamondDetail::where('product_id', $product->id)->forceDelete();
            ItemDiamondDetail::where('item_product_data_id', $itemProductData->id)->delete();

            if ($request->has('diamond.clarity')) {
                foreach ($request->diamond['clarity'] as $index => $value) {

                    DiamondDetail::create([
                        'admin_id' => Auth::guard('admin')->id(),
                        'product_id' => $product->id,
                        'clarity' => $value,
                        'cut' => $request->diamond['cut'][$index],
                        'color' => $request->diamond['color'][$index],
                        'pieces' => $request->diamond['pieces'][$index],
                        'diamond_weight' => $request->diamond['diamond_weight'][$index],
                        'price_per_carat' => $request->diamond['price_per_carat'][$index],
                        'diamond_final_price' => $request->diamond['diamond_final_price'][$index],
                    ]);

                    ItemDiamondDetail::create([
                        'item_product_data_id' => $itemProductData->id,
                        'clarity' => $value,
                        'cut' => $request->diamond['cut'][$index],
                        'color' => $request->diamond['color'][$index],
                        'pieces' => $request->diamond['pieces'][$index],
                        'diamond_weight' => $request->diamond['diamond_weight'][$index],
                        'price_per_carat' => $request->diamond['price_per_carat'][$index],
                        'diamond_final_price' => $request->diamond['diamond_final_price'][$index],
                    ]);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Stones (Delete + Reinsert Product + Item)
        |--------------------------------------------------------------------------
        */
            StoneDetail::where('product_id', $product->id)->forceDelete();
            ItemProductStone::where('item_product_data_id', $itemProductData->id)->delete();

            if ($request->has('stone.stone_name')) {
                foreach ($request->stone['stone_name'] as $index => $value) {

                    StoneDetail::create([
                        'admin_id' => Auth::guard('admin')->id(),
                        'product_id' => $product->id,
                        'stone_name' => $value,
                        'stone_weight' => $request->stone['stone_weight'][$index],
                        'stone_price' => $request->stone['stone_price'][$index],
                        'stone_final_price' => $request->stone['stone_final_price'][$index],
                    ]);

                    ItemProductStone::create([
                        'admin_id' => Auth::guard('admin')->id(),
                        'item_product_data_id' => $itemProductData->id,
                        'stone_name' => $value,
                        'stone_weight' => $request->stone['stone_weight'][$index],
                        'stone_price' => $request->stone['stone_price'][$index],
                        'stone_final_price' => $request->stone['stone_final_price'][$index],
                    ]);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Packets (Delete + Reinsert)
        |--------------------------------------------------------------------------
        */
            ProductPacket::where('product_id', $product->id)
                ->get()
                ->each(function ($packet) {
                    $packet->forceDelete();
                });

            if ($request->has('packet.packet_no')) {
                foreach ($request->packet['packet_no'] as $index => $value) {
                    if (! empty($value)) {
                        ProductPacket::create([
                            'product_id' => $product->id,
                            'packet_no' => $value,
                            'packet_master_id' => $request->packet['packet_master_id'][$index] ?? null,
                            'stone_id' => $request->packet['stone_id'][$index] ?? null,
                            'clarity_id' => $request->packet['clarity_id'][$index] ?? null,
                            'color_id' => $request->packet['color_id'][$index] ?? null,
                            'cut_id' => $request->packet['cut_id'][$index] ?? null,
                            'shape_id' => $request->packet['shape_id'][$index] ?? null,
                            'chalni_id' => $request->packet['chalni_id'][$index] ?? null,
                            'mm_id' => $request->packet['mm_id'][$index] ?? null,
                            'weight' => $request->packet['weight'][$index] ?? 0,
                            'rate' => $request->packet['rate'][$index] ?? 0,
                            'solitaire' => isset($request->packet['solitaire'][$index]) ? 1 : 0,
                            'certificate_no' => $request->packet['certificate_no'][$index] ?? null,
                            'pcs' => $request->packet['pcs'][$index] ?? null,
                            'wt_in_gram' => $request->packet['wt_in_gram'][$index] ?? null,
                            'uom' => $request->packet['uom'][$index] ?? null,
                            'amount' => $request->packet['amount'][$index] ?? 0,
                        ]);
                    }
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
                    'gross_weight' => $request->gross_weight,
                    'net_weight' => $request->net_weight,
                    'final_fn_weight' => $request->final_fn_weight,
                    'quantity' => $request->quantity,
                    'remarks' => 'Product updated',
                ]);
            } else {

                // ✅ CREATE only if not exists (optional safety)
                InventoryTransaction::create([
                    'admin_id' => Auth::guard('admin')->id(),
                    'item_product_data_id' => $itemProductData->id,
                    'product_id' => $product->id,
                    'type' => 'IN',
                    'gross_weight' => $request->gross_weight,
                    'net_weight' => $request->net_weight,
                    'final_fn_weight' => $request->final_fn_weight,
                    'quantity' => $request->quantity,
                    'unit' => 'GM',
                    'remarks' => 'Product updated',
                ]);
            }
            // Accounting Post
            // \App\Models\JournalEntry::where('reference_type', get_class($product))
            //     ->where('reference_id', $product->id)
            //     ->delete();
            // try {
            //     app(\App\Services\AccountingService::class)->postStockIn($product, $product->final_price);
            // } catch (\Exception $e) {
            //     \Log::error('Accounting Post failed for Stock In: '.$e->getMessage());
            // }
        });

        return redirect()->back()->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $product = Product::where('id', $id)
                ->where('admin_id', Auth::guard('admin')->id())
                ->firstOrFail();

            // ✅ Soft delete inventory transactions
            InventoryTransaction::where('product_id', $product->id)->delete();

            // ✅ Soft delete diamond & stone details
            DiamondDetail::where('product_id', $product->id)->delete();
            StoneDetail::where('product_id', $product->id)->delete();

            // ✅ Soft delete journal entries
            \App\Models\JournalEntry::where('reference_type', get_class($product))
                ->where('reference_id', $product->id)
                ->delete();

            // ✅ Soft delete product packets
            ProductPacket::where('product_id', $product->id)->delete();

            // ✅ Finally soft delete product
            $product->delete();
        });

        return redirect()->route('product-list')
            ->with('success', 'Product and related entries soft deleted successfully');
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
            $query->where('product_name', 'LIKE', '%'.trim($request->product_name).'%');
        }

        // Combined Pre + Post Code Search (BR, BR1, BR12 etc.)
        if ($request->filled('product_code')) {
            $search = strtoupper(trim($request->product_code));

            $query->where(function ($q) use ($search) {
                $q->whereRaw(
                    'LOWER(CONCAT(pre_code, post_code)) LIKE ?',
                    ['%'.strtolower($search).'%']
                );
            });
        }

        // Category filter
        if ($request->filled('category_name')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('category_name', 'LIKE', '%'.trim($request->category_name).'%');
            });
        }

        $products = $query->get();

        return view('Inventory/Products/product-list', compact('products'));
    }

    public function searchPacket(Request $request)
    {
        $term = $request->input('term');

        $packets = PacketMaster::where('packet_no', 'LIKE', '%'.$term.'%')
            // ->where('firm_id', \App\Models\Firm::first()->id) // Adjust firm logic if needed
            ->with(['stone', 'clarity', 'color', 'cut', 'shape', 'chalni', 'mm'])
            ->limit(10)
            ->get();

        $results = [];
        foreach ($packets as $packet) {
            $results[] = [
                'id' => $packet->id,
                'label' => $packet->packet_no,
                'value' => $packet->packet_no,
                'details' => [
                    'stone_id' => $packet->stone_id,
                    'stone_name' => $packet->stone ? $packet->stone->name : '',
                    'clarity_id' => $packet->clarity_id,
                    'clarity_name' => $packet->clarity ? $packet->clarity->name : '',
                    'color_id' => $packet->color_id,
                    'color_name' => $packet->color ? $packet->color->name : '',
                    'cut_id' => $packet->cut_id,
                    'cut_name' => $packet->cut ? $packet->cut->name : '',
                    'shape_id' => $packet->shape_id,
                    'shape_name' => $packet->shape ? $packet->shape->name : '',
                    'chalni_id' => $packet->chalni_id,
                    'chalni_name' => $packet->chalni ? $packet->chalni->name : '',
                    'mm_id' => $packet->mm_id,
                    'mm_name' => $packet->mm ? $packet->mm->name : '',
                    'weight' => $packet->average_wt, // or appropriate weight field
                    'rate' => $packet->rate_retail, // or appropriate rate
                    'solitaire' => $packet->solitaire,
                    'certificate_no' => $packet->certificate_no,
                ],
            ];
        }

        return response()->json($results);
    }
}
