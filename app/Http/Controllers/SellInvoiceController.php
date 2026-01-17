<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SellInvoiceItem;
use App\Models\SellDiamondItem;
use App\Models\SellStoneItem;
use App\Models\SellInvoice;
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

                // Diamonds
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

                // Diamonds
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

            // Delete associated diamonds/stones if any (cascading usually handled by DB, but safe to do here if needed)
            // SellDiamondItem::where('sell_invoice_item_id', $itemId)->delete();
            // SellStoneItem::where('sell_invoice_item_id', $itemId)->delete();

            $invoiceId = $item->sell_invoice_id;
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
            foreach ($request->diamonds ?? [] as $d) {
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

            // Re-create Stones
            SellStoneItem::where('sell_invoice_item_id', $item->id)->delete();
            foreach ($request->stones ?? [] as $s) {
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
            $invoiceId = $request->sell_invoice_id; // Using correct key from JS
            if (!$invoiceId) {
                return response()->json(['success' => false, 'message' => 'Invoice ID is missing'], 400);
            }

            $invoice = SellInvoice::findOrFail($invoiceId);

            // Calculate totals (could also verify against items, but trusting frontend/model alignment for now)
            $finalAmount = $invoice->final_amount; // Current item sum
// dd($request)
;            // Discount
             $taxableAmount = $request->taxable_amount;
            $discountPercent = $request->input('discount_percent', 0);
            $discountAmount = ($finalAmount * $discountPercent) / 100;
            $amountAfterDiscount = $finalAmount - $discountAmount;

            // GST
            $cgstPercent = $request->input('cgst_percent', 0);
            $sgstPercent = $request->input('sgst_percent', 0);
            $igstPercent = $request->input('igst_percent', 0);

            $cgstAmount = ($amountAfterDiscount * $cgstPercent) / 100;
            $sgstAmount = ($amountAfterDiscount * $sgstPercent) / 100;
            $igstAmount = ($amountAfterDiscount * $igstPercent) / 100;

            $totalTax = $cgstAmount + $sgstAmount + $igstAmount;
            $grandTotal = $amountAfterDiscount + $totalTax;

            // Payments
            $cash = $request->input('cash_received', 0);
            $bank = $request->input('bank_received', 0);
            $online = $request->input('online_received', 0);
            $card = $request->input('card_received', 0); // Assuming you might have card field

            $totalReceived = $cash + $bank + $online + $card;
            $amountLeft = $grandTotal - $totalReceived;
            $amountLeft = max(0, $amountLeft);
// dd('=='.$amountLeft);
            // Determine Status
            $status = 'pending';
            if ($amountLeft <= 0) {
                $status = 'paid';
            } elseif ($totalReceived > 0) {
                $status = 'partial';
            }

            // Update Invoice
            $invoice->update([
                'discount_percent' => $discountPercent,
                'discount_amount' => $discountAmount,
                'cgst_percent' => $cgstPercent,
                'cgst_amount' => $cgstAmount,
                'sgst_percent' => $sgstPercent,
                'sgst_amount' => $sgstAmount,
                'igst_percent' => $igstPercent,
                'igst_amount' => $igstAmount,
                // If you have IGST columns in DB, add them here. Assuming standard structure:
                // 'igst_percent' => $igstPercent,
                // 'igst_amount' => $igstAmount,
                'taxable_amount' => $taxableAmount,
                'final_amount' => $grandTotal, // IMPORTANT: Overwriting Item Sum with Grand Total (incl tax/discount)
                // Note: You might want to keep 'total_item_amount' separate if your DB specific 'final_amount' means something else.
                // Based on standard logs, usually final_amount is the 'To Pay' amount.

                'cash_received' => $cash,
                'bank_received' => $bank,
                'online_received' => $online,
                // 'card_received' => $card,

                'total_received' => $totalReceived,
                'amount_left' => $amountLeft,
                'status' => $status,
                'invoice_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                'invoice_due_date' => Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d'),
            ]);

            // TODO: Add Notes/Terms saving if linked tables exist

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Invoice finalized successfully',
                'redirect_url' => route('invoices') // Or invoice details
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
            SellInvoiceItem::where('sell_invoice_id', $id)->delete();
            // Diamonds/Stones linked to items should be deleted via cascade or loop if not set up in DB

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
            if (!$invoiceId) {
                return response()->json(['success' => false, 'message' => 'Invoice ID is missing'], 400);
            }

            $invoice = SellInvoice::findOrFail($invoiceId);

            // Calculate totals
            $finalAmount = $invoice->final_amount; // Keep existing item total? Or recalculate?
            // Better to assume final_amount is the sum of items which is already updated by addItem/removeItem.
            // But we need to apply Discount/Tax/Payments again.

            // Discount
            $discountPercent = $request->input('discount_percent', 0);
            $discountAmount = ($finalAmount * $discountPercent) / 100;
            $amountAfterDiscount = $finalAmount - $discountAmount;
            $taxableAmount = $request->taxable_amount;
            // GST
            $cgstPercent = $request->input('cgst_percent', 0);
            $sgstPercent = $request->input('sgst_percent', 0);
            $igstPercent = $request->input('igst_percent', 0);

            $cgstAmount = ($amountAfterDiscount * $cgstPercent) / 100;
            $sgstAmount = ($amountAfterDiscount * $sgstPercent) / 100;
            $igstAmount = ($amountAfterDiscount * $igstPercent) / 100;

            $totalTax = $cgstAmount + $sgstAmount + $igstAmount;
            $grandTotal = $amountAfterDiscount + $totalTax;

            // Payments
            $cash = $request->input('cash_received', 0);
            $bank = $request->input('bank_received', 0);
            $online = $request->input('online_received', 0);
            $card = $request->input('card_received', 0);

            $totalReceived = $cash + $bank + $online + $card;
            $amountLeft = $grandTotal - $totalReceived;
            $amountLeft = max(0, $amountLeft);

            // Determine Status
            $status = 'pending';
            if ($amountLeft <= 0) {
                $status = 'paid';
            } elseif ($totalReceived > 0) {
                $status = 'partial';
            }

            $invoice->update([

                'invoice_no' => $request->invoice_no, // Allow updating invoice number
                'invoice_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                'invoice_due_date' => Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d'),
                'user_id' => $request->customer_id,

                'discount_percent' => $discountPercent,
                'discount_amount' => $discountAmount,
                'cgst_percent' => $cgstPercent,
                'cgst_amount' => $cgstAmount,
                'sgst_percent' => $sgstPercent,
                'sgst_amount' => $sgstAmount,
                'igst_percent' => $igstPercent,
                'igst_amount' => $igstAmount,
                'taxable_amount' => $taxableAmount,

                'final_amount' => $grandTotal,

                'cash_received' => $cash,
                'bank_received' => $bank,
                'online_received' => $online,
                // 'card_received' => $card,

                'total_received' => $totalReceived,
                'amount_left' => $amountLeft,
                'status' => $status,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Invoice updated successfully',
                'redirect_url' => route('invoices')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function edit($id)
    {
        $invoice = SellInvoice::with(['items.diamonds', 'items.stones', 'items.product'])->findOrFail($id);
        $adminId = Auth::id(); // Use Auth::id() for consistency

        $customers = \App\Models\Customer::where('admin_id', $adminId)->get();

        $banks = \App\Models\bankdetails::where('user_id', $adminId)->get();
        $business = \App\Models\BusinessDetail::where('user_id', $adminId)->first();
        $products = \App\Models\Product::all();

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

        return view('Sales.Invoices.invoice-one-a', compact('invoice', 'business', 'bank', 'customer'));
    }
}
