<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\SellDiamondItem;
use App\Models\SellInvoice;
use App\Models\SellInvoiceItem;
use App\Models\SellPacketItem;
use App\Models\SellStoneItem;
use App\Services\MailjetService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// use App\Http\Controllers\Pdf;

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
                    'product_id' => $request->product_id,
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
                    'making_type' => $request->making_type,
                    'making_final_amount' => $request->making_final_amount,
                    'wastage_percent' => $request->wastage_percent,
                    'wastage_amount' => $request->wastage_amount,
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
                            'remarks' => 'Reserved via Invoice #'.$invoiceId,
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

                // Packets (EDIT MODE)
                $packetAmount = 0;

                if (! empty($request->packets) && is_array($request->packets)) {

                    foreach ($request->packets as $packet) {

                        // Skip empty rows
                        if (
                            empty($packet['packet_no']) &&
                            empty($packet['pcs']) &&
                            empty($packet['weight']) &&
                            empty($packet['amount'])
                        ) {
                            continue;
                        }

                        $packetAmount += $packet['amount'] ?? 0;

                        SellPacketItem::create([
                            'admin_id' => Auth::id(),
                            'sell_invoice_id' => $invoiceId,
                            'sell_invoice_item_id' => $item->id,
                            'packet_no' => $packet['packet_no'] ?? null,
                            'pcs' => $packet['pcs'] ?? 0,
                            'stone' => $packet['stone'] ?? null,
                            'clarity' => $packet['clarity'] ?? null,
                            'color' => $packet['color'] ?? null,
                            'cut' => $packet['cut'] ?? null,
                            'shape' => $packet['shape'] ?? null,
                            // 'chalni' => $packet['chalni'] ?? null,
                            'mm' => $packet['mm'] ?? null,
                            'solitaire' => $packet['solitaire'] ?? 0,
                            'rate' => $packet['rate'] ?? 0,
                            'amount' => $packet['amount'] ?? 0,
                            'weight' => $packet['weight'] ?? 0,
                            'wt_in_gram' => $packet['wt_in_gram'] ?? 0,
                            'uom' => $packet['uom'] ?? null,
                            'certificate_no' => $packet['certificate_no'] ?? null,
                            'packet_type' => $packet['packet_type'] ?? 'Diamond',
                        ]);
                    }
                }

                // Update packet total in item
                $item->update([
                    'packet_amount' => $packetAmount,
                ]);
                $invoiceTotal = SellInvoiceItem::where('sell_invoice_id', $invoiceId)->sum('final_price');

                SellInvoice::where('id', $invoiceId)->update([
                    'final_amount' => $invoiceTotal,

                ]);
                DB::commit();

                return response()->json([
                    'success' => true,
                    'invoice_id' => $invoiceId,
                    'item_id' => $item->id,
                ]);
            } else {
                $UserInvoice = SellInvoice::where('user_id', $request->customer_id)
                    ->whereIn('status', ['pending', 'draft'])
                    ->first();

                $invoiceDate = Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d');
                $dueDate = $request->due_date ? Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d') : $invoiceDate;

                // Create invoice only once
                if (! $UserInvoice) {
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
                    'product_id' => $request->product_id,
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
                    'making_type' => $request->making_type,
                    'making_final_amount' => $request->making_final_amount,
                    'wastage_percent' => $request->wastage_percent,
                    'wastage_amount' => $request->wastage_amount,
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
                            'remarks' => 'Reserved via Invoice #'.$invoiceId,
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
                $packetAmount = 0;
                // Packets
                if (! empty($request->packets) && is_array($request->packets)) {

                    foreach ($request->packets as $packet) {

                        // Skip empty packet rows
                        if (
                            empty($packet['packet_no']) &&
                            empty($packet['pcs']) &&
                            empty($packet['weight']) &&
                            empty($packet['amount'])
                        ) {
                            continue;
                        }
                        $packetAmount += $packet['amount'];
                        SellPacketItem::create([
                            'sell_invoice_id' => $invoiceId,
                            'sell_invoice_item_id' => $item->id,
                            'packet_no' => $packet['packet_no'] ?? null,
                            'pcs' => $packet['pcs'] ?? 0,
                            'stone' => $packet['stone'] ?? null,
                            'clarity' => $packet['clarity'] ?? null,
                            'color' => $packet['color'] ?? null,
                            'cut' => $packet['cut'] ?? null,
                            'shape' => $packet['shape'] ?? null,
                            // 'chalni' => $packet['chalni'] ?? null,
                            'mm' => $packet['mm'] ?? null,
                            'solitaire' => $packet['solitaire'] ?? 0,
                            'rate' => $packet['rate'] ?? 0,
                            'amount' => $packet['amount'] ?? 0,
                            'weight' => $packet['weight'] ?? 0,
                            'wt_in_gram' => $packet['wt_in_gram'] ?? 0,
                            'uom' => $packet['uom'] ?? null,
                            'certificate_no' => $packet['certificate_no'] ?? null,
                            'packet_type' => $packet['packet_type'] ?? 'Diamond',
                        ]);
                    }
                }
                $item->update([
                    'packet_amount' => $packetAmount,
                ]);

                // Recalculate invoice total AFTER everything is saved
                $invoiceTotal = SellInvoiceItem::where('sell_invoice_id', $invoiceId)->sum('final_price');

                SellInvoice::where('id', $invoiceId)->update([
                    'final_amount' => $invoiceTotal,
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'invoice_id' => $invoiceId,
                    'item_id' => $item->id,
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
        $invoice = SellInvoice::with(['items.diamonds', 'items.stones', 'items.product', 'items.packets', 'exchangeItems', 'exchangeDiamonds'])
            ->where('user_id', $customerId)
            ->where('status', 'pending')
            ->first();

        if ($invoice) {
            return response()->json([
                'success' => true,
                'invoice' => $invoice,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No pending invoice found',
        ]);
    }

    public function getInvoiceById($id)
    {
        $invoice = SellInvoice::with(['items.diamonds', 'items.stones', 'items.product', 'items.packets', 'exchangeItems', 'exchangeDiamonds', 'payments'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'invoice' => $invoice,
        ]);
    }

    public function getCustomerUnsettledEntries($customerId, $invoiceId = null)
    {
        $query = \App\Models\PaymentTransaction::where('customer_id', $customerId)
            ->whereIn('transaction_type', ['advance', 'udhaar_payment', 'udhaar_get']);

        if ($invoiceId) {
            // Exclude the current invoice's own balance transactions (Advance/Udhaar created FROM this invoice)
            $query->where(function ($q) use ($invoiceId) {
                $q->where('invoice_id', '!=', $invoiceId)
                    ->orWhereNull('invoice_id');
            });
        }

        $transactions = $query->get()
            ->map(function ($t) use ($invoiceId) {
                $alreadySettledAmount = 0;
                if ($invoiceId) {
                    $alreadySettledAmount = $t->children()
                        ->where('invoice_id', $invoiceId)
                        ->whereIn('transaction_type', ['refund', 'udhaar_return'])
                        ->sum('amount');
                }

                $totalRefunded = $t->refunded_amount; // sum of all child settlements
                $otherRefunded = $totalRefunded - $alreadySettledAmount;
                $remainingAmount = $t->amount - $otherRefunded;

                return [
                    'id' => $t->id,
                    'transaction_date' => \Carbon\Carbon::parse($t->transaction_date)->format('d-m-Y'),
                    'transaction_type' => $t->transaction_type,
                    'amount' => $t->amount,
                    'remaining_amount' => $remainingAmount,
                    'already_settled_amount' => $alreadySettledAmount,
                    'is_already_settled' => $alreadySettledAmount > 0,
                ];
            })
            ->filter(function ($t) {
                // Keep if there is still something to settle OR it was already settled in this invoice
                return $t['remaining_amount'] > 0 || $t['is_already_settled'];
            })
            ->values();

        return response()->json([
            'success' => true,
            'data' => $transactions,
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
                'final_amount' => $invoiceTotal,
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
                'product_id' => $request->product_id,
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
                'making_type' => $request->making_type,
                'making_final_amount' => $request->making_final_amount,
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

            // Delete old packets
            SellPacketItem::where('sell_invoice_item_id', $item->id)->forcedelete();
            $packetAmount = 0;
            // Re-create packets
            if (! empty($request->packets)) {
                foreach ($request->packets as $packet) {

                    if (
                        empty($packet['packet_no']) &&
                        empty($packet['pcs']) &&
                        empty($packet['weight']) &&
                        empty($packet['amount'])
                    ) {
                        continue;
                    }
                    $packetAmount += $packet['amount'];
                    SellPacketItem::create([
                        'sell_invoice_id' => $item->sell_invoice_id,
                        'sell_invoice_item_id' => $item->id,
                        'packet_no' => $packet['packet_no'] ?? null,
                        'pcs' => $packet['pcs'] ?? 0,
                        'stone' => $packet['stone'] ?? null,
                        'clarity' => $packet['clarity'] ?? null,
                        'color' => $packet['color'] ?? null,
                        'cut' => $packet['cut'] ?? null,
                        'shape' => $packet['shape'] ?? null,
                        // 'chalni' => $packet['chalni'] ?? null,
                        'mm' => $packet['mm'] ?? null,
                        'solitaire' => $packet['solitaire'] ?? 0,
                        'rate' => $packet['rate'] ?? 0,
                        'amount' => $packet['amount'] ?? 0,
                        'weight' => $packet['weight'] ?? 0,
                        'wt_in_gram' => $packet['wt_in_gram'] ?? 0,
                        'uom' => $packet['uom'] ?? null,
                        'certificate_no' => $packet['certificate_no'] ?? null,
                        'packet_type' => $packet['packet_type'] ?? 'Diamond',
                    ]);
                }
            }
            $item->update([
                'packet_amount' => $packetAmount,
            ]);

            // Recalculate invoice total
            $invoiceTotal = SellInvoiceItem::where('sell_invoice_id', $item->sell_invoice_id)->sum('final_price');
            SellInvoice::where('id', $item->sell_invoice_id)->update([
                'final_amount' => $invoiceTotal,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Item updated successfully',
                'invoice_id' => $item->sell_invoice_id,
                'item_id' => $item->id,
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
            if (! $invoiceId) {
                return response()->json(['success' => false, 'message' => 'Invoice ID is missing'], 400);
            }

            $invoice = SellInvoice::findOrFail($invoiceId);

            // Base Amount
            $finalAmount = round($invoice->final_amount, 2);

            // New Discount Fields
            $totalMakingCharge = round($request->input('total_making_charge', 0), 2);
            $makingDiscountPercent = round($request->input('making_discount_percent', 0), 2);
            $makingDiscountAmount = round($request->input('making_discount_amount', 0), 2);

            $totalDiaStonePacket = round($request->input('total_diamond_stone_packet', 0), 2);
            $diamondDiscountPercent = round($request->input('diamond_discount_percent', 0), 2);
            $diamondDiscountAmount = round($request->input('diamond_discount_amount', 0), 2);
            $diamondTotalAmount = round($request->input('diamond_total_amount', 0), 2);

            $totalWastageCharge = round($request->input('total_wastage_charge', 0), 2);
            $wastageDiscountPercent = round($request->input('wastage_discount_percent', 0), 2);
            $wastageDiscountAmount = round($request->input('wastage_discount_amount', 0), 2);

            // Discount
            $taxableAmount = round($request->taxable_amount, 2);
            $discountPercent = round($request->input('discount_percent', 0), 2);
            $discountAmount = round(($finalAmount * $discountPercent) / 100, 2);
            $amountAfterDiscount = round($finalAmount - $discountAmount - $diamondDiscountAmount - $makingDiscountAmount - $wastageDiscountAmount, 2);

            // GST %
            $cgstPercent = round($request->input('cgst_percent', 0), 2);
            $sgstPercent = round($request->input('sgst_percent', 0), 2);
            $igstPercent = round($request->input('igst_percent', 0), 2);

            // GST Amounts
            $cgstAmount = round(($amountAfterDiscount * $cgstPercent) / 100, 2);
            $sgstAmount = round(($amountAfterDiscount * $sgstPercent) / 100, 2);
            $igstAmount = round(($amountAfterDiscount * $igstPercent) / 100, 2);

            $totalTax = round($cgstAmount + $sgstAmount + $igstAmount, 2);
            $totalInvoiceAmount = round($amountAfterDiscount + $totalTax, 2);

            // Exchange Reduction
            $totalExchangeAmount = round($request->input('total_exchange_amount', 0), 2);
            $grandTotal = round($totalInvoiceAmount - $totalExchangeAmount, 2);
            $finalPayable = round($grandTotal);
            $roundOff = round($finalPayable - $grandTotal, 2);

            // Payments
            $cash = 0;
            $bank = 0;
            $online = 0;
            $card = 0;
            $hasPayments = $request->filled('payments') && is_array($request->payments);

            if ($hasPayments) {
                foreach ($request->payments as $p) {
                    $amt = round($p['amount'] ?? 0, 2);
                    if ($p['payment_method'] === 'cash') {
                        $cash += $amt;
                    } elseif ($p['payment_method'] === 'cheque') {
                        $bank += $amt;
                    } elseif ($p['payment_method'] === 'upi') {
                        $online += $amt;
                    } elseif ($p['payment_method'] === 'card') {
                        $card += $amt;
                    }
                }
            } else {
                $cash = round($request->input('cash_received', 0), 2);
                $bank = round($request->input('bank_received', 0), 2);
                $online = round($request->input('online_received', 0), 2);
                $card = round($request->input('card_received', 0), 2);
            }

            $totalReceived = round($cash + $bank + $online + $card, 2);

            $totaludharSettled = 0;
            $totaladvSettled = 0;
            if ($request->filled('settled_transactions') && is_array($request->settled_transactions)) {
                foreach ($request->settled_transactions as $settlement) {
                    if (empty($settlement['amount']) || $settlement['amount'] <= 0) {
                        continue;
                    }

                    $originalTx = \App\Models\PaymentTransaction::find($settlement['id']);
                    if (! $originalTx) {
                        continue;
                    }

                    if ($originalTx->transaction_type === 'advance') {
                        // Advance or Overpayment reduces balance (acts as payment)
                        $totaladvSettled += round($settlement['amount'], 2);
                    } elseif ($originalTx->transaction_type === 'udhaar_get' || $originalTx->transaction_type === 'udhaar_payment') {
                        // Udhaar debt increases balance (acts as extra charge)
                        $totaludharSettled += round($settlement['amount'], 2);
                    }
                }
            }

            // $amountLeft = round(max(0, $grandTotal - $totalReceived), 2);
            $totalReceived = round($cash + $bank + $online + $card, 2);
            // Difference before rounding
            $balanceDiff = (($finalPayable + $totaludharSettled) - ($totalReceived + $totaladvSettled));
            // Tolerance check (important)
            if (abs($balanceDiff) < 0.05) {
                $amountLeft = 0.00;
            } else {
                $amountLeft = round($balanceDiff, 2);
            }

            // dd('=='.$amountLeft);
            // Status
            $status = 'partial';
            if ($amountLeft <= 0) {
                $status = 'paid';
            } elseif ($totalReceived > 0) {
                $status = 'partial';
            }

            // Update Invoice
            $invoice->update([
                'total_making_charge' => $totalMakingCharge,
                'making_discount_percent' => $makingDiscountPercent,
                'making_discount_amount' => $makingDiscountAmount,
                'total_wastage_charge' => $totalWastageCharge,
                'wastage_discount_percent' => $wastageDiscountPercent,
                'wastage_discount_amount' => $wastageDiscountAmount,
                'total_diamond_stone_packet' => $totalDiaStonePacket,
                'diamond_discount_percent' => $diamondDiscountPercent,
                'diamond_discount_amount' => $diamondDiscountAmount,
                'diamond_total_amount' => $diamondTotalAmount,

                'discount_percent' => $discountPercent,
                'discount_amount' => $discountAmount,

                'cgst_percent' => $cgstPercent,
                'cgst_amount' => $cgstAmount,
                'sgst_percent' => $sgstPercent,
                'sgst_amount' => $sgstAmount,
                'igst_percent' => $igstPercent,
                'igst_amount' => $igstAmount,

                'taxable_amount' => $taxableAmount,
                'final_amount' => $finalPayable,
                'round_off' => $roundOff,

                'total_exchange_amount' => $totalExchangeAmount,

                'cash_received' => $cash,
                'bank_received' => $bank,
                'online_received' => $online,
                'card_received' => $card,

                'total_received' => $totalReceived,
                'amount_left' => $amountLeft,
                'status' => $status,

                'invoice_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                'invoice_due_date' => $request->due_date ? Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d') : Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
            ]);

            // Save payments breakdown
            $invoice->payments()->delete();
            if ($hasPayments) {
                foreach ($request->payments as $p) {
                    $amt = round($p['amount'] ?? 0, 2);
                    if ($amt <= 0) {
                        continue;
                    }
                    $invoice->payments()->create([
                        'firm_id' => $invoice->firm_id,
                        'account_id' => $p['account_id'] ?? null,
                        'payment_method' => $p['payment_method'],
                        'amount' => $amt,
                        'reference_no' => $p['reference_no'] ?? null,
                        'payment_details' => $p['payment_details'] ?? null,
                        'transaction_date' => ! empty($p['transaction_date']) ? Carbon::parse($p['transaction_date'])->format('Y-m-d') : Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    ]);
                }
            } else {
                if ($cash > 0) {
                    $invoice->payments()->create([
                        'firm_id' => $invoice->firm_id,
                        'account_id' => \App\Models\Account::where('name', 'Cash in Hand')->first()?->id,
                        'payment_method' => 'cash',
                        'amount' => $cash,
                        'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    ]);
                }
                if ($bank > 0) {
                    $invoice->payments()->create([
                        'firm_id' => $invoice->firm_id,
                        'account_id' => \App\Models\Account::where('name', 'Bank')->first()?->id,
                        'payment_method' => 'cheque',
                        'amount' => $bank,
                        'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    ]);
                }
                if ($online > 0) {
                    $invoice->payments()->create([
                        'firm_id' => $invoice->firm_id,
                        'account_id' => \App\Models\Account::where('name', 'UPI Clearing')->first()?->id,
                        'payment_method' => 'upi',
                        'amount' => $online,
                        'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    ]);
                }
                if ($card > 0) {
                    $invoice->payments()->create([
                        'firm_id' => $invoice->firm_id,
                        'account_id' => \App\Models\Account::where('name', 'Card Receivable')->first()?->id,
                        'payment_method' => 'card',
                        'amount' => $card,
                        'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    ]);
                }
            }

            // Automatically record balance as Advance or Udhaar Get
            // dd($amountLeft);
            if (abs($amountLeft) >= 0.05) {
                $type = $amountLeft > 0 ? 'udhaar_get' : 'advance';
                $label = $amountLeft > 0 ? 'Udhaar (Debt)' : 'Advance';

                \App\Models\PaymentTransaction::create([
                    'firm_id' => $invoice->firm_id,
                    'admin_id' => Auth::id(),
                    'customer_id' => $invoice->user_id,
                    'invoice_id' => $invoice->id,
                    'amount' => abs($amountLeft),
                    'transaction_type' => $type,
                    'payment_method' => 'cash', // Default
                    'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    'narration' => "{$label} recorded from balance of Invoice #{$invoice->invoice_no}",
                ]);
                // Note: We don't call postCustomerTransaction here because postSellInvoice
                // handles the Sundry Debtors / Customer Advance posting for the invoice balance.
            }

            // Save Exchange Items
            $invoice->exchangeItems()->delete();
            if ($request->filled('exchange_items') && is_array($request->exchange_items)) {
                foreach ($request->exchange_items as $ex) {
                    if (empty($ex['amount']) || $ex['amount'] == 0) {
                        continue;
                    }
                    $invoice->exchangeItems()->create([
                        'admin_id' => Auth::id(),
                        'firm_id' => $invoice->firm_id,
                        'description' => $ex['description'] ?? null,
                        'metal' => $ex['metal'] ?? null,
                        'purity' => $ex['purity'] ?? null,
                        'gross_weight' => $ex['gross_weight'] ?? 0,
                        'less_weight' => $ex['less_weight'] ?? 0,
                        'net_weight' => $ex['net_weight'] ?? 0,
                        'fine_weight' => $ex['fine_weight'] ?? 0,
                        'wanted_amt' => $ex['wanted_amt'] ?? 0,
                        'rate' => $ex['rate'] ?? 0,
                        'amount' => $ex['amount'] ?? 0,
                    ]);
                }
            }

            // Save Exchange Diamonds
            $invoice->exchangeDiamonds()->delete();
            if ($request->filled('exchange_diamonds') && is_array($request->exchange_diamonds)) {
                foreach ($request->exchange_diamonds as $dia) {
                    if (empty($dia['amount']) || $dia['amount'] == 0) {
                        continue;
                    }
                    $invoice->exchangeDiamonds()->create([
                        'admin_id' => Auth::id(),
                        'firm_id' => $invoice->firm_id,
                        'description' => $dia['description'] ?? null,
                        'clarity' => $dia['clarity'] ?? null,
                        'cut' => $dia['cut'] ?? null,
                        'color' => $dia['color'] ?? null,
                        'pieces' => $dia['pieces'] ?? 0,
                        'weight' => $dia['weight'] ?? 0,
                        'rate' => $dia['rate'] ?? 0,
                        'amount' => $dia['amount'] ?? 0,
                    ]);
                }
            }

            // Save settled transactions (Udhar/Advance)
            if ($request->filled('settled_transactions') && is_array($request->settled_transactions)) {
                foreach ($request->settled_transactions as $settlement) {
                    if (empty($settlement['amount']) || $settlement['amount'] <= 0) {
                        continue;
                    }

                    $originalTx = \App\Models\PaymentTransaction::find($settlement['id']);
                    if (! $originalTx) {
                        continue;
                    }

                    $type = 'refund'; // For advance
                    $label = 'Refund';
                    if ($originalTx->transaction_type == 'udhaar_payment' || $originalTx->transaction_type == 'udhaar_get') {
                        $type = 'udhaar_return';
                        $label = 'Return';
                    }

                    $newTx = \App\Models\PaymentTransaction::create([
                        'firm_id' => $invoice->firm_id,
                        'admin_id' => Auth::id(),
                        'customer_id' => $invoice->user_id,
                        'invoice_id' => $invoice->id,
                        'parent_id' => $originalTx->id,
                        'amount' => $settlement['amount'],
                        'transaction_type' => $type,
                        'payment_method' => 'cash',
                        'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                        'narration' => "{$label} settled during Invoice #{$invoice->invoice_no}",
                    ]);

                    try {
                        app(\App\Services\AccountingService::class)->postCustomerTransaction($newTx);
                    } catch (\Exception $e) {
                        \Log::error("Accounting Post failed for Settlement Tx #{$newTx->id}: ".$e->getMessage());
                    }
                }
            }

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
                            'remarks' => 'Sold via Invoice #'.$invoice->invoice_no,
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
                \Log::error("Accounting Post failed for Invoice Finalize #{$invoice->invoice_no}: ".$e->getMessage());
            }

            DB::commit();

            // return response()->json([
            //     'success' => true,
            //     'message' => 'Invoice finalized successfully',
            //     'redirect_url' => route('invoices'),
            //     'print_url' => route('sell.invoice.view', $invoice->id),
            // ]);

            // Flash success message to session
            session()->flash('success', 'Invoice finalized successfully.');

            return response()->json([
                'success' => true,
                'redirect_url' => route('invoices'),
                'print_url' => route('sell.invoice.view', $invoice->id),
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
            $usedInAnotherInvoice = \App\Models\PaymentTransaction::where('invoice_id', $id)
                ->whereIn('transaction_type', ['advance', 'udhaar_get'])
                ->whereHas('children', function ($q) {
                    $q->whereIn('transaction_type', ['refund', 'udhaar_return']);
                })
                ->exists();

            if ($usedInAnotherInvoice) {

                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'message' => 'Invoice cannot be deleted because its due/advance amount is already settled in another invoice.',
                ], 400);
            }
            $invoice->exchangeItems()->delete();
            $invoice->exchangeDiamonds()->delete();
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

            // ✅ Delete all associated PaymentTransactions (Settlements & Balance records)
            $transactions = \App\Models\PaymentTransaction::where('invoice_id', $id)->get();
            foreach ($transactions as $tx) {
                // Delete associated journal entries for each transaction
                \App\Models\JournalEntry::where('reference_type', get_class($tx))
                    ->where('reference_id', $tx->id)
                    ->delete();
                $tx->delete();
            }

            // ✅ Delete associated journal entry for the invoice itself
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
        // dd('hiii');
        DB::beginTransaction();
        try {
            $invoiceId = $request->sell_invoice_id;
            if (! $invoiceId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invoice ID is missing',
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

            $totalMakingCharge = round($request->input('total_making_charge', 0), 2);
            $makingDiscountPercent = round($request->input('making_discount_percent', 0), 2);
            $makingDiscountAmount = round($request->input('making_discount_amount', 0), 2);

            $totalDiaStonePacket = round($request->input('total_diamond_stone_packet', 0), 2);
            $diamondDiscountPercent = round($request->input('diamond_discount_percent', 0), 2);
            $diamondDiscountAmount = round($request->input('diamond_discount_amount', 0), 2);
            $diamondTotalAmount = round($request->input('diamond_total_amount', 0), 2);

            $totalWastageCharge = round($request->input('total_wastage_charge', 0), 2);
            $wastageDiscountPercent = round($request->input('wastage_discount_percent', 0), 2);
            $wastageDiscountAmount = round($request->input('wastage_discount_amount', 0), 2);

            /* --------------------
             | Discount
             -------------------- */
            $discountPercent = round($request->input('discount_percent', 0), 2);
            $discountAmount = round(($itemsTotal * $discountPercent) / 100, 2);
            $amountAfterDiscount = round($itemsTotal - $discountAmount - $diamondDiscountAmount - $makingDiscountAmount - $wastageDiscountAmount, 2);

            /* --------------------
             | GST
             -------------------- */
            $cgstPercent = round($request->input('cgst_percent', 0), 2);
            $sgstPercent = round($request->input('sgst_percent', 0), 2);
            $igstPercent = round($request->input('igst_percent', 0), 2);

            $cgstAmount = round(($amountAfterDiscount * $cgstPercent) / 100, 2);
            $sgstAmount = round(($amountAfterDiscount * $sgstPercent) / 100, 2);
            $igstAmount = round(($amountAfterDiscount * $igstPercent) / 100, 2);

            $totalTax = round($cgstAmount + $sgstAmount + $igstAmount, 2);
            $totalInvoiceAmount = round($amountAfterDiscount + $totalTax, 2);

            // Exchange Reduction
            $totalExchangeAmount = round($request->input('total_exchange_amount', 0), 2);
            $grandTotal = round($totalInvoiceAmount - $totalExchangeAmount, 2);
            $finalPayable = round($grandTotal);
            $roundOff = round($finalPayable - $grandTotal, 2);

            /* --------------------
             | Payments
             -------------------- */
            $cash = 0;
            $bank = 0;
            $online = 0;
            $card = 0;
            $hasPayments = $request->filled('payments') && is_array($request->payments);

            if ($hasPayments) {
                foreach ($request->payments as $p) {
                    $amt = round($p['amount'] ?? 0, 2);
                    if ($p['payment_method'] === 'cash') {
                        $cash += $amt;
                    } elseif ($p['payment_method'] === 'cheque') {
                        $bank += $amt;
                    } elseif ($p['payment_method'] === 'upi') {
                        $online += $amt;
                    } elseif ($p['payment_method'] === 'card') {
                        $card += $amt;
                    }
                }
            } else {
                $cash = round($request->input('cash_received', 0), 2);
                $bank = round($request->input('bank_received', 0), 2);
                $online = round($request->input('online_received', 0), 2);
                $card = round($request->input('card_received', 0), 2);
            }

            $totalReceivedPayments = round($cash + $bank + $online + $card, 2);

            /* --------------------
             | Settlements (Udhar/Advance)
             -------------------- */
            // $totalSettled = 0;
            // if ($request->filled('settled_transactions') && is_array($request->settled_transactions)) {
            //     foreach ($request->settled_transactions as $settlement) {
            //         $totalSettled += (float) ($settlement['amount'] ?? 0);
            //     }
            // }

            // 1. Delete existing settlements for this invoice to prevent duplication
            $oldSettlements = \App\Models\PaymentTransaction::where('invoice_id', $invoice->id)
                ->whereIn('transaction_type', ['refund', 'udhaar_return'])
                ->get();

            foreach ($oldSettlements as $oldTx) {
                // Delete associated journal entries
                \App\Models\JournalEntry::where('reference_type', get_class($oldTx))
                    ->where('reference_id', $oldTx->id)
                    ->delete();
                $oldTx->delete();
            }

            $alreadySettled = 0; // Reset to 0 since we deleted old entries

            // NEW settlements from request
            $newSettled = 0;
            $newadvsettled = 0;
            $newudharsettled = 0;
            if ($request->filled('settled_transactions')) {
                foreach ($request->settled_transactions as $settlement) {
                    $originalTx = \App\Models\PaymentTransaction::find($settlement['id'] ?? null);
                    if (! $originalTx) {
                        continue;
                    }

                    if ($originalTx->transaction_type === 'advance') {
                        // $newSettled += (float) ($settlement['amount'] ?? 0);
                        $newadvsettled += (float) ($settlement['amount'] ?? 0);
                    } elseif ($originalTx->transaction_type === 'udhaar_get' || $originalTx->transaction_type === 'udhaar_payment') {
                        // $newSettled -= (float) ($settlement['amount'] ?? 0);
                        $newudharsettled += (float) ($settlement['amount'] ?? 0);
                    }
                }
            }

            // TOTAL settlement
            $totalSettled = $alreadySettled + $newSettled;

            // In this system, total_received includes both payments and settlements
            $totalReceivedTotal = round($totalReceivedPayments, 2);
            $balanceDiff = round(
                ($finalPayable + $newudharsettled) - ($totalReceivedTotal + $newadvsettled),
                2
            );

            // Rounding tolerance (same as finalize)
            if (abs($balanceDiff) < 0.05) {
                $amountLeft = 0.00;
            } else {
                $amountLeft = $balanceDiff;
            }

            /* --------------------
             | Status
             -------------------- */
            $status = 'partial';
            if ($amountLeft <= 0) {
                $status = 'paid';
            } elseif ($totalReceivedTotal > 0) {
                $status = 'partial';
            }

            /* --------------------
             | Update Invoice
             -------------------- */
            $invoice->update([
                'invoice_no' => $request->invoice_no,
                'invoice_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                'invoice_due_date' => $request->due_date ? Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d') : Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                'user_id' => $request->customer_id,

                'total_making_charge' => $totalMakingCharge,
                'making_discount_percent' => $makingDiscountPercent,
                'making_discount_amount' => $makingDiscountAmount,
                'total_wastage_charge' => $totalWastageCharge,
                'wastage_discount_percent' => $wastageDiscountPercent,
                'wastage_discount_amount' => $wastageDiscountAmount,
                'total_diamond_stone_packet' => $totalDiaStonePacket,
                'diamond_discount_percent' => $diamondDiscountPercent,
                'diamond_discount_amount' => $diamondDiscountAmount,
                'diamond_total_amount' => $diamondTotalAmount,

                'discount_percent' => $discountPercent,
                'discount_amount' => $discountAmount,

                'cgst_percent' => $cgstPercent,
                'cgst_amount' => $cgstAmount,
                'sgst_percent' => $sgstPercent,
                'sgst_amount' => $sgstAmount,
                'igst_percent' => $igstPercent,
                'igst_amount' => $igstAmount,

                'taxable_amount' => $itemsTotal,
                'final_amount' => $finalPayable,
                'round_off' => $roundOff,

                'total_exchange_amount' => $totalExchangeAmount,

                'cash_received' => $cash,
                'bank_received' => $bank,
                'online_received' => $online,
                'card_received' => $card,

                'total_received' => $totalReceivedTotal,
                'amount_left' => $amountLeft,
                'status' => $status,
            ]);

            // Save payments breakdown
            $invoice->payments()->delete();
            if ($hasPayments) {
                foreach ($request->payments as $p) {
                    $amt = round($p['amount'] ?? 0, 2);
                    if ($amt <= 0) {
                        continue;
                    }
                    $invoice->payments()->create([
                        'firm_id' => $invoice->firm_id,
                        'account_id' => $p['account_id'] ?? null,
                        'payment_method' => $p['payment_method'],
                        'amount' => $amt,
                        'reference_no' => $p['reference_no'] ?? null,
                        'payment_details' => $p['payment_details'] ?? null,
                        'transaction_date' => ! empty($p['transaction_date']) ? Carbon::parse($p['transaction_date'])->format('Y-m-d') : Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    ]);
                }
            } else {
                if ($cash > 0) {
                    $invoice->payments()->create([
                        'firm_id' => $invoice->firm_id,
                        'account_id' => \App\Models\Account::where('name', 'Cash in Hand')->first()?->id,
                        'payment_method' => 'cash',
                        'amount' => $cash,
                        'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    ]);
                }
                if ($bank > 0) {
                    $invoice->payments()->create([
                        'firm_id' => $invoice->firm_id,
                        'account_id' => \App\Models\Account::where('name', 'Bank')->first()?->id,
                        'payment_method' => 'cheque',
                        'amount' => $bank,
                        'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    ]);
                }
                if ($online > 0) {
                    $invoice->payments()->create([
                        'firm_id' => $invoice->firm_id,
                        'account_id' => \App\Models\Account::where('name', 'UPI Clearing')->first()?->id,
                        'payment_method' => 'upi',
                        'amount' => $online,
                        'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    ]);
                }
                if ($card > 0) {
                    $invoice->payments()->create([
                        'firm_id' => $invoice->firm_id,
                        'account_id' => \App\Models\Account::where('name', 'Card Receivable')->first()?->id,
                        'payment_method' => 'card',
                        'amount' => $card,
                        'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    ]);
                }
            }

            // 1.1 Delete existing balance transactions for this invoice (not settlements)
            \App\Models\PaymentTransaction::where('invoice_id', $invoice->id)
                ->whereIn('transaction_type', ['advance', 'udhaar_get'])
                ->whereNull('parent_id') // Only parent balance records
                ->delete();

            // 1.2 Automatically record new balance as Advance or Udhaar Get
            if (abs($amountLeft) >= 0.05) {
                $type = $amountLeft > 0 ? 'udhaar_get' : 'advance';
                $label = $amountLeft > 0 ? 'Udhaar (Debt)' : 'Advance';

                \App\Models\PaymentTransaction::create([
                    'firm_id' => $invoice->firm_id,
                    'admin_id' => Auth::id(),
                    'customer_id' => $invoice->user_id,
                    'invoice_id' => $invoice->id,
                    'amount' => abs($amountLeft),
                    'transaction_type' => $type,
                    'payment_method' => 'cash',
                    'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                    'narration' => "{$label} recorded from balance of Invoice Update #{$invoice->invoice_no}",
                ]);
            }
            // Save Exchange Items
            $invoice->exchangeItems()->delete();
            if ($request->filled('exchange_items') && is_array($request->exchange_items)) {
                foreach ($request->exchange_items as $ex) {
                    if (empty($ex['amount']) || $ex['amount'] == 0) {
                        continue;
                    }
                    $invoice->exchangeItems()->create([
                        'admin_id' => Auth::id(),
                        'firm_id' => $invoice->firm_id,
                        'description' => $ex['description'] ?? null,
                        'metal' => $ex['metal'] ?? null,
                        'purity' => $ex['purity'] ?? null,
                        'gross_weight' => $ex['gross_weight'] ?? 0,
                        'less_weight' => $ex['less_weight'] ?? 0,
                        'net_weight' => $ex['net_weight'] ?? 0,
                        'fine_weight' => $ex['fine_weight'] ?? 0,
                        'wanted_amt' => $ex['wanted_amt'] ?? 0,
                        'rate' => $ex['rate'] ?? 0,
                        'amount' => $ex['amount'] ?? 0,
                    ]);
                }
            }

            // Save Exchange Diamonds
            $invoice->exchangeDiamonds()->delete();
            if ($request->filled('exchange_diamonds') && is_array($request->exchange_diamonds)) {
                foreach ($request->exchange_diamonds as $dia) {
                    if (empty($dia['amount']) || $dia['amount'] == 0) {
                        continue;
                    }
                    $invoice->exchangeDiamonds()->create([
                        'admin_id' => Auth::id(),
                        'firm_id' => $invoice->firm_id,
                        'description' => $dia['description'] ?? null,
                        'clarity' => $dia['clarity'] ?? null,
                        'cut' => $dia['cut'] ?? null,
                        'color' => $dia['color'] ?? null,
                        'pieces' => $dia['pieces'] ?? 0,
                        'weight' => $dia['weight'] ?? 0,
                        'rate' => $dia['rate'] ?? 0,
                        'amount' => $dia['amount'] ?? 0,
                    ]);
                }
            }

            // Save settled transactions (Udhar/Advance)
            if ($request->filled('settled_transactions') && is_array($request->settled_transactions)) {
                foreach ($request->settled_transactions as $settlement) {
                    if (empty($settlement['amount']) || $settlement['amount'] <= 0) {
                        continue;
                    }

                    $originalTx = \App\Models\PaymentTransaction::find($settlement['id']);
                    if (! $originalTx) {
                        continue;
                    }

                    $type = 'refund'; // For advance
                    $label = 'Refund';
                    if ($originalTx->transaction_type == 'udhaar_payment' || $originalTx->transaction_type == 'udhaar_get') {
                        $type = 'udhaar_return';
                        $label = 'Return';
                    }

                    $newTx = \App\Models\PaymentTransaction::create([
                        'firm_id' => $invoice->firm_id,
                        'admin_id' => Auth::id(),
                        'customer_id' => $invoice->user_id,
                        'invoice_id' => $invoice->id,
                        'parent_id' => $originalTx->id,
                        'amount' => $settlement['amount'],
                        'transaction_type' => $type,
                        'payment_method' => 'cash',
                        'transaction_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
                        'narration' => "{$label} settled during Invoice Update #{$invoice->invoice_no}",
                    ]);

                    try {
                        app(\App\Services\AccountingService::class)->postCustomerTransaction($newTx);
                    } catch (\Exception $e) {
                        \Log::error("Accounting Post failed for Settlement Tx #{$newTx->id}: ".$e->getMessage());
                    }
                }
            }

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
                            'remarks' => 'Sold via Invoice #'.$invoice->invoice_no,
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
                \Log::error("Accounting Post failed for Invoice Update #{$invoice->invoice_no}: ".$e->getMessage());
            }

            DB::commit();
            session()->flash('success', 'Invoice finalized successfully.');

            return response()->json([
                'success' => true,
                'message' => 'Invoice updated successfully',
                'redirect_url' => route('invoices'),
                'print_url' => route('sell.invoice.view', $invoice->id),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $invoice = SellInvoice::with(['items.diamonds', 'items.stones', 'items.product', 'items.packets', 'exchangeItems', 'exchangeDiamonds', 'payments'])->findOrFail($id);
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

        // $columns = \App\Models\InvoiceColumn::orderBy('id')->where('user_id', $adminId)->get();

        // $allColumns = \App\Models\InvoiceColumn::where('user_id', $adminId)
        //     ->where('is_visible', true)
        //     ->get()
        //     ->map(function ($col) {
        //         return [
        //             'name' => $col->name,
        //             'key' => $col->key ?? \Illuminate\Support\Str::slug(strtolower($col->name), '_'),
        //             'type' => $col->type,
        //             'is_custom' => $col->is_custom,
        //             'is_visible' => $col->is_visible,
        //             'position' => $col->position,
        //         ];
        //     })
        //     ->sortBy('position')
        //     ->values()
        //     ->all();

        // $visibleColumns = \App\Models\InvoiceColumn::where('user_id', $adminId)
        //     ->orderBy('position')
        //     ->get()->map(function ($col) {
        //         return [
        //             'name' => $col->name,
        //             'key' => $col->key ?? \Illuminate\Support\Str::slug(strtolower($col->name), '_'),
        //             'type' => $col->type,
        //             'is_custom' => $col->is_custom,
        //             'is_visible' => $col->is_visible,
        //             'position' => $col->position,
        //         ];
        //     })
        //     ->sortBy('position')
        //     ->values()
        //     ->all();

        $previewInvoiceNo = $invoice->invoice_no;
        $invoice_id = $id;

        // Calculate already settled amount from Udhar/Advance for this invoice
        $alreadyRefunds = \App\Models\PaymentTransaction::where('invoice_id', $invoice->id)
            ->where('transaction_type', 'refund')
            ->sum('amount');
        $alreadyReturns = \App\Models\PaymentTransaction::where('invoice_id', $invoice->id)
            ->where('transaction_type', 'udhaar_return')
            ->sum('amount');
        $alreadySettled = $alreadyRefunds - $alreadyReturns;

        $accounts = \App\Models\Account::with('group')->orderBy('name')->get();

        $stones = \App\Models\Stone::all();
        $clarities = \App\Models\Clarity::all();
        $colors = \App\Models\Color::all();
        $cuts = \App\Models\Cut::all();
        $mms = \App\Models\Mm::all();
        $chalnis = \App\Models\Chalni::all();
        $shapes = \App\Models\Shape::all();

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
            'alreadySettled',
            'accounts',
            'stones',
            'clarities',
            'colors',
            'cuts',
            'mms',
            'chalnis',
            'shapes'
        ) + ['customer_id' => $invoice->user_id]);
    }

    public function show($id)
    {
        $invoice = SellInvoice::with(['items.diamonds', 'items.stones', 'items.packets',  'items.product', 'customer', 'paymentTransactions', 'exchangeItems', 'exchangeDiamonds'])->findOrFail($id);
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
                return $item->section_key.'.'.$item->field_key;
            });

        // Get custom blocks
        $customBlocks = \App\Models\InvoiceTemplateCustomBlock::where('admin_id', $adminId)
            ->where('is_visible', true)
            ->orderBy('display_order')
            ->get();
        if (request()->has('pdf')) {
            return view('Sales.Invoices.invoice-one-a-dya', compact('invoice'));
        }

        return view('Sales.Invoices.invoice-one-a-dya', compact('invoice', 'business', 'bank', 'customer', 'templateSettings', 'customBlocks'));
    }

    public function sendInvoiceMail($id, MailjetService $mailjet)
    {
        $invoice = SellInvoice::with('customer')->findOrFail($id);

        if (! $invoice->customer || ! $invoice->customer->email) {
            return back()->with('error', 'Customer email not found.');
        }

        // Generate PDF
        $html = view('pdf.invo', [
            'invoice' => $invoice,
            'customer' => $invoice->customer,
        ])->render();

        $pdf = Pdf::loadHTML($html)->setPaper('A4', 'portrait');

        $attachments = [
            [
                'ContentType' => 'application/pdf',
                'Filename' => 'Invoice-'.$invoice->invoice_no.'.pdf',
                'Base64Content' => base64_encode($pdf->output()),
            ],
        ];
        $htmlContent = "
        <h2>Invoice Details</h2>

        <p><strong>Invoice No:</strong> {$invoice->invoice_no}</p>
        <p><strong>Date:</strong> {$invoice->invoice_date}</p>
        <p><strong>Total:</strong> ₹ ".number_format($invoice->final_amount, 2).'</p>
        <p><strong>Paid:</strong> ₹ '.number_format($invoice->total_received ?? 0, 2).'</p>
        <p><strong>Balance:</strong> ₹ '.number_format($invoice->amount_left ?? 0, 2).'</p>

        <p>Thank you for your business.</p>
    ';
        $response = $mailjet->sendEmail(
            $invoice->customer->email,
            $invoice->customer->name ?? 'Customer',
            'Invoice #'.$invoice->invoice_no,
            'Please find your invoice attached.',
            $attachments,
            $htmlContent
        );

        if ($response->successful()) {
            return back()->with('success', 'Invoice sent successfully.');
        }

        return back()->with('error', 'Mail failed: '.$response->body());
    }

    // public function sendInvoiceMail($id)
    // {
    //     $invoice = SellInvoice::with('customer')->findOrFail($id);

    //     if (! $invoice->customer || ! $invoice->customer->email) {
    //         return back()->with('error', 'Customer email not found.');
    //     }

    //     // ✅ Generate PDF
    //     $html = view('pdf.invo', [
    //         'invoice' => $invoice,
    //         'customer' => $invoice->customer,
    //     ])->render();

    //     $pdf = Pdf::loadHTML($html)->setPaper('A4', 'portrait');
    //     $pdfContent = base64_encode($pdf->output());

    //     // ✅ Prepare Mailjet payload
    //     $payload = [
    //         'Messages' => [
    //             [
    //                 'From' => [
    //                     'Email' => 'support@sirsonite.in',
    //                     'Name' => 'Mail Test',
    //                 ],
    //                 'To' => [
    //                     [
    //                         'Email' => 'shreyaunhale@sirsonite.com',
    //                         'Name' => $invoice->customer->name ?? 'Customer',
    //                     ],
    //                 ],
    //                 'Subject' => 'Invoice #'.$invoice->invoice_no,
    //                 'TextPart' => 'Please find your invoice attached.',
    //                 'Attachments' => [
    //                     [
    //                         'ContentType' => 'application/pdf',
    //                         'Filename' => 'Invoice-'.$invoice->invoice_no.'.pdf',
    //                         'Base64Content' => $pdfContent,
    //                     ],
    //                 ],
    //             ],
    //         ],
    //     ];

    //     // ✅ cURL setup
    //     $ch = curl_init();

    //     curl_setopt_array($ch, [
    //         CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_POST => true,
    //         CURLOPT_POSTFIELDS => json_encode($payload),
    //         CURLOPT_HTTPHEADER => [
    //             'Content-Type: application/json',
    //         ],
    //         CURLOPT_USERPWD => env('30c952da49f12c2be8621ebf5ffd191a').':'.env('daaf83789db44ffa560cec092c604ea5'),
    //         CURLOPT_TIMEOUT => 30,
    //     ]);

    //     // ✅ Execute request
    //     $response = curl_exec($ch);
    //     $error = curl_error($ch);
    //     curl_close($ch);

    //     // ❌ cURL error
    //     if ($error) {
    //         return back()->with('error', 'cURL Error: '.$error);
    //     }

    //     // ✅ Decode response
    //     $result = json_decode($response, true);

    //     // ✅ Success check (Mailjet format)
    //     if (isset($result['Messages'][0]['Status']) && $result['Messages'][0]['Status'] == 'success') {
    //         return back()->with('success', 'Invoice sent successfully via Mailjet (cURL).');
    //     }

    //     // ❌ Failure
    //     return back()->with('error', 'Mail sending failed: '.$response);
    // }
}
