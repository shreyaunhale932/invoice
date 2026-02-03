<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SellInvoiceItem;
use App\Models\SellDiamondItem;
use App\Models\SellStoneItem;
use App\Models\SellInvoice;
use App\Models\InventoryTransaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class SellInvoiceController extends Controller
{
    public function addItem(Request $request)
    {
        DB::beginTransaction();

        try {
            // Clear invalid session
            if ($request->from == 'edit') {
                $UserInvoice = SellInvoice::find($request->sell_invoice_id);
                $invoiceId = $UserInvoice->id;
                $invoiceId = $UserInvoice->id;

                $itemFinalPrice = (float) $request->final_price;
                $item = SellInvoiceItem::create([
                    'admin_id' => Auth::id(),
                    'sell_invoice_id' => $invoiceId,
                    'product_id'   => $request->product_id,
                    'item_name' => $request->product_name,
                    'pre_code' => $request->pre_code,
                    'post_code' => $request->post_code,
                    'barcode' => $request->barcode,
                    'hsn_code' => $request->hsn_code,

                    // Weights & Rates
                    'gross_weight' => $request->gross_weight,
                    'net_weight' => $request->net_weight,
                    
                    'final_fn_weight' => $request->final_fn_weight,
                    'metal_rate' => $request->metal_rate,

                    // Pricing
                    'making_price' => $request->making_price,
                    'wastage_percent' => $request->wastage_percent,
                    'gst_percent' => $request->gst_percent,
                    'gst_amount' => $request->gst_amount,

                    // Other
                    'category' => $request->category,
                    'subcategory' => $request->subcategory,
                    'size' => $request->size,
                    'quantity' => $request->quantity ?? 1,

                    // Final
                    'total_amount' => $request->total_amount,
                    'final_price' => $itemFinalPrice,
                ]);

// Mark product as SOLD immediately
if ($request->product_id) {

    $product = Product::find($request->product_id);
    if ($product && $product->availability !== 'sold') {
        $product->update(['availability' => 'sold']);

        InventoryTransaction::create([
            'type' => 'OUT',
            'product_id' => $product->id,
            'item_product_data_id' => $product->item_product_data_id,
            'quantity' => $request->quantity ?? 1,
            'gross_weight' => $request->gross_weight,
            'net_weight' => $request->net_weight,
            'final_fn_weight' => $request->final_fn_weight,
            'size' => $request->size,
            'unit' => 'GM',
            'remarks' => 'Reserved via Invoice #' . $invoiceId,
            'admin_id' => Auth::id(),
            'sell_invoice_id' => $invoiceId,
            'sell_invoice_item_id' => $item->id,
        ]);
    }
}

                // Diamonds
                $diamondCharges = 0;
                if ($request->filled('diamonds') && is_array($request->diamonds)) {
                    foreach ($request->diamonds as $d) {

                        // Skip completely empty rows
                        if (
                            empty($d['clarity']) &&
                            empty($d['cut']) &&
                            empty($d['color']) &&
                            empty($d['pieces']) &&
                            empty($d['diamond_weight']) &&
                            empty($d['price_per_carat']) &&
                            empty($d['diamond_final_price'])
                        ) {
                            continue;
                        }
                        $diamondCharges += $d['diamond_final_price'];
                        SellDiamondItem::create([
                            'admin_id' => Auth::id(),
                            'sell_invoice_id' => $invoiceId,
                            'sell_invoice_item_id' => $item->id,
                            'clarity' => $d['clarity'] ?? null,
                            'cut' => $d['cut'] ?? null,
                            'color' => $d['color'] ?? null,
                            'pieces' => $d['pieces'] ?? 0,
                            'diamond_weight' => $d['diamond_weight'] ?? 0,
                            'price_per_carat' => $d['price_per_carat'] ?? 0,
                            'diamond_final_price' => $d['diamond_final_price'] ?? 0,
                        ]);
                    }
                }
                $item->update([
                    'diamond_amount' => $diamondCharges,
                ]);

                $stoneCharges = 0;
                // Stones
                if ($request->filled('stones') && is_array($request->stones)) {
                    foreach ($request->stones as $s) {

                        // Skip empty rows
                        if (
                            empty($s['stone_name']) &&
                            empty($s['stone_weight']) &&
                            empty($s['stone_price']) &&
                            empty($s['stone_final_price'])
                        ) {
                            continue;
                        }
                        $stoneCharges += $s['stone_final_price'];
                        SellStoneItem::create([
                            'admin_id' => Auth::id(),
                            'sell_invoice_id' => $invoiceId,
                            'sell_invoice_item_id' => $item->id,
                            'stone_name' => $s['stone_name'] ?? null,
                            'stone_weight' => $s['stone_weight'] ?? 0,
                            'stone_price' => $s['stone_price'] ?? 0,
                            'stone_final_price' => $s['stone_final_price'] ?? 0,
                        ]);
                    }
                }
                $item->update([
                    'stone_amount' => $stoneCharges,
                ]);
                $invoiceTotal = SellInvoiceItem::where('sell_invoice_id', $invoiceId)->sum('final_price');

                SellInvoice::where('id', $invoiceId)->update([
                    'final_amount' => $invoiceTotal,

                ]);
                DB::commit();

                return response()->json([
                    'success' => true,
                    'invoice_id' => $invoiceId,
                    'item_id' => $item->id
                ]);
            } else {
                $UserInvoice = SellInvoice::where('user_id', $request->customer_id)
                    ->whereIn('status', ['pending', 'draft'])
                    ->first();


                $invoiceDate = Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d');
                $dueDate     = Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d');

                // Create invoice only once
                if (!$UserInvoice) {
                    $UserInvoice = SellInvoice::create([
                        'admin_id' => Auth::id(),
                        'invoice_no' => $request->invoice_no,
                        'user_id' => $request->customer_id,
                        'invoice_date' => $invoiceDate,
                        'invoice_due_date' => $dueDate,
                        'status' => 'pending',
                        'final_amount' => 0,
                    ]);

                    // session(['sell_invoice_id' => $invoice->id]);
                }

                $invoiceId = $UserInvoice->id;

                $itemFinalPrice = (float) $request->final_price;
                // dd($request->quantity);

                // Create item
                // Create item
                $item = SellInvoiceItem::create([
                    'admin_id' => Auth::id(),
                    'sell_invoice_id' => $invoiceId,
                    'product_id'   => $request->product_id,
                    'item_name' => $request->product_name,
                    'pre_code' => $request->pre_code,
                    'post_code' => $request->post_code,
                    'barcode' => $request->barcode,
                    'hsn_code' => $request->hsn_code,

                    // Weights & Rates
                    'gross_weight' => $request->gross_weight,
                    'net_weight' => $request->net_weight,
                     'final_fn_weight' => $request->final_fn_weight,
                    'metal_rate' => $request->metal_rate,

                    // Pricing
                    'making_price' => $request->making_price,
                    'wastage_percent' => $request->wastage_percent,
                    'gst_percent' => $request->gst_percent,
                    'gst_amount' => $request->gst_amount,

                    // Other
                    'category' => $request->category,
                    'subcategory' => $request->subcategory,
                    'size' => $request->size,
                    'quantity' => $request->quantity ?? 1,

                    // Final
                    'total_amount' => $request->total_amount,
                    'final_price' => $itemFinalPrice,
                ]);
                if ($request->product_id) {

    $product = Product::find($request->product_id);
    if ($product && $product->availability !== 'sold') {
        $product->update(['availability' => 'sold']);

        InventoryTransaction::create([
            'type' => 'OUT',
            'product_id' => $product->id,
            'item_product_data_id' => $product->item_product_data_id,
            'quantity' => $request->quantity ?? 1,
            'gross_weight' => $request->gross_weight,
            'net_weight' => $request->net_weight,
             'final_fn_weight' => $request->final_fn_weight,
            'size' => $request->size,
            'unit' => 'GM',
            'remarks' => 'Reserved via Invoice #' . $invoiceId,
            'admin_id' => Auth::id(),
            'sell_invoice_id' => $invoiceId,
            'sell_invoice_item_id' => $item->id,
        ]);
    }
}

                // Diamonds
                $diamondAmount = 0;
                if ($request->filled('diamonds') && is_array($request->diamonds)) {
                    foreach ($request->diamonds as $d) {

                        // Skip completely empty rows
                        if (
                            empty($d['clarity']) &&
                            empty($d['cut']) &&
                            empty($d['color']) &&
                            empty($d['pieces']) &&
                            empty($d['diamond_weight']) &&
                            empty($d['price_per_carat']) &&
                            empty($d['diamond_final_price'])
                        ) {
                            continue;
                        }
                        $diamondAmount += $d['diamond_final_price'];
                        SellDiamondItem::create([
                            'admin_id' => Auth::id(),
                            'sell_invoice_id' => $invoiceId,
                            'sell_invoice_item_id' => $item->id,
                            'clarity' => $d['clarity'] ?? null,
                            'cut' => $d['cut'] ?? null,
                            'color' => $d['color'] ?? null,
                            'pieces' => $d['pieces'] ?? 0,
                            'diamond_weight' => $d['diamond_weight'] ?? 0,
                            'price_per_carat' => $d['price_per_carat'] ?? 0,
                            'diamond_final_price' => $d['diamond_final_price'] ?? 0,
                        ]);
                    }
                }
                $item->update([
                    'diamond_amount' => $diamondAmount,
                ]);

                // Stones
                $stoneAmount = 0;
                if ($request->filled('stones') && is_array($request->stones)) {
                    foreach ($request->stones as $s) {

                        // Skip empty rows
                        if (
                            empty($s['stone_name']) &&
                            empty($s['stone_weight']) &&
                            empty($s['stone_price']) &&
                            empty($s['stone_final_price'])
                        ) {
                            continue;
                        }
                        $stoneAmount += $s['stone_final_price'];
                        SellStoneItem::create([
                            'admin_id' => Auth::id(),
                            'sell_invoice_id' => $invoiceId,
                            'sell_invoice_item_id' => $item->id,
                            'stone_name' => $s['stone_name'] ?? null,
                            'stone_weight' => $s['stone_weight'] ?? 0,
                            'stone_price' => $s['stone_price'] ?? 0,
                            'stone_final_price' => $s['stone_final_price'] ?? 0,
                        ]);
                    }
                }
                $item->update([
                    'stone_amount' => $stoneAmount,
                ]);

                // Recalculate invoice total AFTER everything is saved
                $invoiceTotal = SellInvoiceItem::where('sell_invoice_id', $invoiceId)->sum('final_price');

                SellInvoice::where('id', $invoiceId)->update([
                    'final_amount' => $invoiceTotal
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'invoice_id' => $invoiceId,
                    'item_id' => $item->id
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getPendingInvoice($customerId)
    {
        $invoice = SellInvoice::with(['items.diamonds', 'items.stones', 'items.product'])
            ->where('user_id', $customerId)
            ->where('status', 'pending')
            ->first();

        if ($invoice) {
            return response()->json([
                'success' => true,
                'invoice' => $invoice
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No pending invoice found'
        ]);
    }

    public function removeItem(Request $request)
    {
        DB::beginTransaction();
        try {
            $itemId = $request->item_id;
            $item = SellInvoiceItem::findOrFail($itemId);

            $invoiceId = $item->sell_invoice_id;

            // Stock In reversal logic
            if ($item->product_id) {
                $product = Product::find($item->product_id);
                if ($product) {
                    // Update availability back to available
                    $product->update(['availability' => 'available']);

                    // Delete the OUT inventory transaction associated with this item
                    InventoryTransaction::where('sell_invoice_item_id', $item->id)
                        ->where('type', 'OUT')
                        ->delete();
                }
            }

            $item->delete();

            // Recalculate invoice total
            $invoiceTotal = SellInvoiceItem::where('sell_invoice_id', $invoiceId)->sum('final_price');
            SellInvoice::where('id', $invoiceId)->update([
                'final_amount' => $invoiceTotal
            ]);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function updateItem(Request $request)
    {
        DB::beginTransaction();
        try {
            $itemId = $request->item_id;
            $item = SellInvoiceItem::findOrFail($itemId);

            $itemFinalPrice = (float) $request->final_price;

            // Update item details
            $item->update([
                'product_id'   => $request->product_id,
                'item_name' => $request->product_name,
                'pre_code' => $request->pre_code,
                'post_code' => $request->post_code,
                'barcode' => $request->barcode,
                'hsn_code' => $request->hsn_code,

                // Weights & Rates
                'gross_weight' => $request->gross_weight,
                'net_weight' => $request->net_weight,
                 'final_fn_weight' => $request->final_fn_weight,
                'metal_rate' => $request->metal_rate,

                // Pricing
                'making_price' => $request->making_price,
                'wastage_percent' => $request->wastage_percent,
                'gst_percent' => $request->gst_percent,
                'gst_amount' => $request->gst_amount,

                // Other
                'category' => $request->category,
                'subcategory' => $request->subcategory,
                'size' => $request->size,
                'quantity' => $request->quantity ?? 1,

                // Final
                'total_amount' => $request->total_amount,
                'final_price' => $itemFinalPrice,
            ]);

            // Re-create Diamonds (Delete old, add new)
            SellDiamondItem::where('sell_invoice_item_id', $item->id)->delete();
            $diamondAmount = 0;
            foreach ($request->diamonds ?? [] as $d) {
                $diamondAmount += $d['diamond_final_price'];
                SellDiamondItem::create([
                    'admin_id' => Auth::id(),
                    'sell_invoice_id' => $item->sell_invoice_id,
                    'sell_invoice_item_id' => $item->id,
                    'clarity' => $d['clarity'],
                    'cut' => $d['cut'],
                    'color' => $d['color'],
                    'pieces' => $d['pieces'],
                    'diamond_weight' => $d['diamond_weight'],
                    'price_per_carat' => $d['price_per_carat'],
                    'diamond_final_price' => $d['diamond_final_price'],
                ]);
            }
            $item->update([
                'diamond_amount' => $diamondAmount,
            ]);

            // Re-create Stones
            SellStoneItem::where('sell_invoice_item_id', $item->id)->delete();
            $stoneAmount = 0;
            foreach ($request->stones ?? [] as $s) {
                $stoneAmount += $s['stone_final_price'];
                SellStoneItem::create([
                    'admin_id' => Auth::id(),
                    'sell_invoice_id' => $item->sell_invoice_id,
                    'sell_invoice_item_id' => $item->id,
                    'stone_name' => $s['stone_name'],
                    'stone_weight' => $s['stone_weight'],
                    'stone_price' => $s['stone_price'],
                    'stone_final_price' => $s['stone_final_price'],
                ]);
            }
            $item->update([
                'stone_amount' => $stoneAmount,
            ]);

            // Recalculate invoice total
            $invoiceTotal = SellInvoiceItem::where('sell_invoice_id', $item->sell_invoice_id)->sum('final_price');
            SellInvoice::where('id', $item->sell_invoice_id)->update([
                'final_amount' => $invoiceTotal
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Item updated successfully',
                'invoice_id' => $item->sell_invoice_id,
                'item_id' => $item->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function finalize(Request $request)
    {
        DB::beginTransaction();
        try {
            $invoiceId = $request->sell_invoice_id;
            if (!$invoiceId) {
                return response()->json(['success' => false, 'message' => 'Invoice ID is missing'], 400);
            }

            $invoice = SellInvoice::findOrFail($invoiceId);

            // Base Amount
            $finalAmount = round($invoice->final_amount, 2);

            // Discount
            $taxableAmount    = round($request->taxable_amount, 2);
            $discountPercent  = round($request->input('discount_percent', 0), 2);
            $discountAmount   = round(($finalAmount * $discountPercent) / 100, 2);
            $amountAfterDiscount = round($finalAmount - $discountAmount, 2);

            // GST %
            $cgstPercent = round($request->input('cgst_percent', 0), 2);
            $sgstPercent = round($request->input('sgst_percent', 0), 2);
            $igstPercent = round($request->input('igst_percent', 0), 2);

            // GST Amounts
            $cgstAmount = round(($amountAfterDiscount * $cgstPercent) / 100, 2);
            $sgstAmount = round(($amountAfterDiscount * $sgstPercent) / 100, 2);
            $igstAmount = round(($amountAfterDiscount * $igstPercent) / 100, 2);

            $totalTax  = round($cgstAmount + $sgstAmount + $igstAmount, 2);
            $grandTotal = round($amountAfterDiscount + $totalTax, 2);

            // Payments
            $cash   = round($request->input('cash_received', 0), 2);
            $bank   = round($request->input('bank_received', 0), 2);
            $online = round($request->input('online_received', 0), 2);
            $card   = round($request->input('card_received', 0), 2);

            $totalReceived = round($cash + $bank + $online + $card, 2);
            // $amountLeft = round(max(0, $grandTotal - $totalReceived), 2);
            $totalReceived = round($cash + $bank + $online + $card, 2);

            // Difference before rounding
            $balanceDiff = $grandTotal - $totalReceived;

            // Tolerance check (important)
            if (abs($balanceDiff) < 0.05) {
                $amountLeft = 0.00;
            } else {
                $amountLeft = round($balanceDiff, 2);
            }

            // dd('=='.$amountLeft);
            // Status
            $status = 'pending';
            if ($amountLeft <= 0) {
                $status = 'paid';
            } elseif ($totalReceived > 0) {
                $status = 'partial';
            }

            // Update Invoice
            $invoice->update([
                'discount_percent' => $discountPercent,
                'discount_amount'  => $discountAmount,

                'cgst_percent' => $cgstPercent,
                'cgst_amount'  => $cgstAmount,
                'sgst_percent' => $sgstPercent,
                'sgst_amount'  => $sgstAmount,
                'igst_percent' => $igstPercent,
                'igst_amount'  => $igstAmount,

                'taxable_amount' => $taxableAmount,

                'final_amount'   => $grandTotal,

                'cash_received'   => $cash,
                'bank_received'   => $bank,
                'online_received' => $online,
                'card_received'   => $card,

                'total_received' => $totalReceived,
                'amount_left'    => $amountLeft,
                'status'         => $status,

                'invoice_date'     => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                'invoice_due_date' => Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d'),
            ]);

            // Stock Out Logic
            foreach ($invoice->items as $item) {
                if ($item->product_id) {
                    $product = Product::find($item->product_id);
                    if ($product && $product->availability !== 'sold') {
                        // Mark as sold
                        $product->update(['availability' => 'sold']);

                        // Create Inventory Transaction (OUT)
                        InventoryTransaction::create([
                            'type' => 'OUT',
                            'product_id' => $product->id,
                            'item_product_data_id' => $product->item_product_data_id,
                            'quantity' => $item->quantity ?? 1,
                            'gross_weight' => $item->gross_weight,
                            'net_weight' => $item->net_weight,
                             'final_fn_weight' => $item->final_fn_weight,
                            'size' => $item->size,
                            'unit' => 'GM', // Default unit
                            'remarks' => 'Sold via Invoice #' . $invoice->invoice_no,
                            'admin_id' => Auth::id(),
                            'sell_invoice_id' => $invoice->id,
                            'sell_invoice_item_id' => $item->id,
                        ]);
                    }
                }
            }
            // Accounting Post
            try {
                app(\App\Services\AccountingService::class)->postSellInvoice($invoice);
            } catch (\Exception $e) {
                \Log::error("Accounting Post failed for Invoice Finalize #{$invoice->invoice_no}: " . $e->getMessage());
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Invoice finalized successfully',
                'redirect_url' => route('invoices')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $invoice = SellInvoice::findOrFail($id);

            // Delete items (Cascading should ideally handle this, but manual is safer)
            $items = SellInvoiceItem::where('sell_invoice_id', $id)->get();
            foreach ($items as $item) {
                if ($item->product_id) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->update(['availability' => 'available']);
                        InventoryTransaction::where('sell_invoice_item_id', $item->id)
                            ->where('type', 'OUT')
                            ->delete();
                    }
                }
                $item->delete();
            }

            // ✅ Delete associated journal entry
            \App\Models\JournalEntry::where('reference_type', get_class($invoice))
                ->where('reference_id', $invoice->id)
                ->delete();

            $invoice->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Invoice deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $invoiceId = $request->sell_invoice_id;
            if (! $invoiceId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invoice ID is missing'
                ], 400);
            }

            $invoice = SellInvoice::findOrFail($invoiceId);

            /**
             * IMPORTANT:
             * final_amount in DB already contains GRAND TOTAL.
             * We must NOT reuse it for recalculation.
             * Use taxable_amount or item total instead.
             */
            $itemsTotal = round($request->taxable_amount ?? 0, 2);

            /* --------------------
             | Discount
             -------------------- */
            $discountPercent = round($request->input('discount_percent', 0), 2);
            $discountAmount  = round(($itemsTotal * $discountPercent) / 100, 2);
            $amountAfterDiscount = round($itemsTotal - $discountAmount, 2);

            /* --------------------
             | GST
             -------------------- */
            $cgstPercent = round($request->input('cgst_percent', 0), 2);
            $sgstPercent = round($request->input('sgst_percent', 0), 2);
            $igstPercent = round($request->input('igst_percent', 0), 2);

            $cgstAmount = round(($amountAfterDiscount * $cgstPercent) / 100, 2);
            $sgstAmount = round(($amountAfterDiscount * $sgstPercent) / 100, 2);
            $igstAmount = round(($amountAfterDiscount * $igstPercent) / 100, 2);

            $totalTax  = round($cgstAmount + $sgstAmount + $igstAmount, 2);
            $grandTotal = round($amountAfterDiscount + $totalTax, 2);

            /* --------------------
             | Payments
             -------------------- */
            $cash   = round($request->input('cash_received', 0), 2);
            $bank   = round($request->input('bank_received', 0), 2);
            $online = round($request->input('online_received', 0), 2);
            $card   = round($request->input('card_received', 0), 2);

            $totalReceived = round($cash + $bank + $online + $card, 2);

            $balanceDiff = round($grandTotal - $totalReceived, 2);

            // Rounding tolerance (same as finalize)
            if (abs($balanceDiff) < 0.05) {
                $amountLeft = 0.00;
            } else {
                $amountLeft = max(0, $balanceDiff);
            }

            /* --------------------
             | Status
             -------------------- */
            $status = 'pending';
            if ($amountLeft <= 0) {
                $status = 'paid';
            } elseif ($totalReceived > 0) {
                $status = 'partial';
            }

            /* --------------------
             | Update Invoice
             -------------------- */
            $invoice->update([
                'invoice_no'       => $request->invoice_no,
                'invoice_date'     => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                'invoice_due_date' => Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d'),
                'user_id'          => $request->customer_id,

                'discount_percent' => $discountPercent,
                'discount_amount'  => $discountAmount,

                'cgst_percent' => $cgstPercent,
                'cgst_amount'  => $cgstAmount,
                'sgst_percent' => $sgstPercent,
                'sgst_amount'  => $sgstAmount,
                'igst_percent' => $igstPercent,
                'igst_amount'  => $igstAmount,

                'taxable_amount' => $itemsTotal,
                'final_amount'   => $grandTotal,

                'cash_received'   => $cash,
                'bank_received'   => $bank,
                'online_received' => $online,
                'card_received'   => $card,

                'total_received' => $totalReceived,
                'amount_left'    => $amountLeft,
                'status'         => $status,
            ]);

            // Stock Out Logic
            foreach ($invoice->items as $item) {
                if ($item->product_id) {
                    $product = Product::find($item->product_id);
                    if ($product && $product->availability !== 'sold') {
                        // Mark as sold
                        $product->update(['availability' => 'sold']);

                        // Create Inventory Transaction (OUT)
                        InventoryTransaction::create([
                            'type' => 'OUT',
                            'product_id' => $product->id,
                            'item_product_data_id' => $product->item_product_data_id,
                            'quantity' => $item->quantity ?? 1,
                            'gross_weight' => $item->gross_weight,
                            'net_weight' => $item->net_weight,
                             'final_fn_weight' => $item->final_fn_weight,
                            'size' => $item->size,
                            'unit' => 'GM', // Default unit
                            'remarks' => 'Sold via Invoice #' . $invoice->invoice_no,
                            'admin_id' => Auth::id(),
                            'sell_invoice_id' => $invoice->id,
                            'sell_invoice_item_id' => $item->id,
                        ]);
                    }
                }
            }
            // Accounting Post
            try {
                // For updates, we might need to reverse old entry or just update.
                // But the user said "One invoice = one journal entry".
                // I'll delete the old journal entry for this invoice if it exists.
                \App\Models\JournalEntry::where('reference_type', get_class($invoice))
                    ->where('reference_id', $invoice->id)
                    ->delete();

                app(\App\Services\AccountingService::class)->postSellInvoice($invoice);
            } catch (\Exception $e) {
                \Log::error("Accounting Post failed for Invoice Update #{$invoice->invoice_no}: " . $e->getMessage());
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Invoice updated successfully',
                'redirect_url' => route('invoices')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function edit($id)
    {
        $invoice = SellInvoice::with(['items.diamonds', 'items.stones', 'items.product'])->findOrFail($id);
        $adminId = Auth::id(); // Use Auth::id() for consistency

        $customers = \App\Models\Customer::where('admin_id', $adminId)->get();

        $banks = \App\Models\bankdetails::where('user_id', $adminId)->get();
        $business = \App\Models\BusinessDetail::where('user_id', $adminId)->first();
        $products = \App\Models\Product::where('availability', 'available')->get();

        $notes = DB::table('invoice_notes_terms')
            ->where('admin_id', $adminId)
            ->where('type', 'note')
            ->get();
        $terms = DB::table('invoice_notes_terms')
            ->where('admin_id', $adminId)
            ->where('type', 'term')
            ->get();
        $customFields = [];



        $columns = \App\Models\InvoiceColumn::orderBy('id')->where('user_id', $adminId)->get();

        $allColumns = \App\Models\InvoiceColumn::where('user_id', $adminId)
            ->where('is_visible', true)
            ->get()
            ->map(function ($col) {
                return [
                    'name' => $col->name,
                    'key' => $col->key ?? \Illuminate\Support\Str::slug(strtolower($col->name), '_'),
                    'type' => $col->type,
                    'is_custom' => $col->is_custom,
                    'is_visible' => $col->is_visible,
                    'position' => $col->position,
                ];
            })
            ->sortBy('position')
            ->values()
            ->all();

        $visibleColumns = \App\Models\InvoiceColumn::where('user_id', $adminId)
            ->orderBy('position')
            ->get()->map(function ($col) {
                return [
                    'name' => $col->name,
                    'key' => $col->key ?? \Illuminate\Support\Str::slug(strtolower($col->name), '_'),
                    'type' => $col->type,
                    'is_custom' => $col->is_custom,
                    'is_visible' => $col->is_visible,
                    'position' => $col->position,
                ];
            })
            ->sortBy('position')
            ->values()
            ->all();

        $previewInvoiceNo = $invoice->invoice_no;
        $invoice_id = $id;

        return view('Sales.Invoices.edit-invoice', compact(
            'invoice',
            'invoice_id',
            'customers',
            'products',
            'banks',
            'business',
            'notes',
            'terms',
            'customFields',
            'previewInvoiceNo',
            'columns',
            'allColumns',
            'visibleColumns'
        ) + ['customer_id' => $invoice->user_id]);
    }

    public function show($id)
    {
        $invoice = SellInvoice::with(['items.diamonds', 'items.stones', 'items.product', 'customer'])->findOrFail($id);
        $adminId = $invoice->admin_id;
        $customer = \App\Models\Customer::where('id', $invoice->user_id)->first();

        $business = \App\Models\BusinessDetail::where('user_id', $adminId)->first();
        $bank = \App\Models\bankdetails::where('user_id', $adminId)->first();

        // Get template settings
        $templateSettings = \App\Models\InvoiceTemplateSetting::where(function ($query) use ($adminId) {
            $query->where('admin_id', $adminId)
                ->orWhereNull('admin_id');
        })
            ->orderByRaw('CASE WHEN admin_id IS NOT NULL THEN 0 ELSE 1 END')
            ->get()
            ->keyBy(function ($item) {
                return $item->section_key . '.' . $item->field_key;
            });

        // Get custom blocks
        $customBlocks = \App\Models\InvoiceTemplateCustomBlock::where('admin_id', $adminId)
            ->where('is_visible', true)
            ->orderBy('display_order')
            ->get();

        return view('Sales.Invoices.invoice-one-a-dya', compact('invoice', 'business', 'bank', 'customer', 'templateSettings', 'customBlocks'));
    }
}
