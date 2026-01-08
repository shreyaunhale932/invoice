<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SellInvoiceItem;
use App\Models\SellDiamondItem;
use App\Models\SellStoneItem;
use App\Models\SellInvoice;
use Illuminate\Support\Facades\DB;

class SellInvoiceController extends Controller
{
    public function addItem(Request $request)
    {
        DB::beginTransaction();

        try {


            if (!session()->has('sell_invoice_id')) {
                $invoice = SellInvoice::create([
                    'admin_id' => Auth::id(),
                    'invoice_no'   => $request->invoice_no,
                    'user_id'  => $request->customer_id,
                    'invoice_date' => $request->invoice_date,
                    'invoice_due_date'     => $request->due_date,
                    'status' => 'draft',
                    'final_amount' => 0, // will update later
                ]);

                session(['sell_invoice_id' => $invoice->id]);
            }

            $invoiceId = session('sell_invoice_id');


            $gold = SellInvoiceItem::create([
                'admin_id' => Auth::id(),
                'sell_invoice_id' => $invoiceId,
                'product_name' => $request->product_name,
                'pre_code' => $request->pre_code,
                'post_code' => $request->post_code,
                'barcode' => $request->barcode,
                'net_weight' => $request->net_weight,
                'metal_rate' => $request->metal_rate,
                'making_price' => $request->making_price,
                'gst_amount' => $request->gst_amount,
                'total_amount' => $request->total_amount,
                'final_price' => $request->final_price,
            ]);


            foreach ($request->diamonds ?? [] as $d) {
                SellDiamondItem::create([
                    'admin_id' => Auth::id(),
                    'sell_invoice_id' => $invoiceId,
                    'sell_invoice_item_id' => $gold->id,
                    'clarity' => $d['clarity'],
                    'cut' => $d['cut'],
                    'color' => $d['color'],
                    'pieces' => $d['pieces'],
                    'diamond_weight' => $d['diamond_weight'],
                    'price_per_carat' => $d['price_per_carat'],
                    'diamond_final_price' => $d['diamond_final_price'],
                ]);
            }


            foreach ($request->stones ?? [] as $s) {
                SellStoneItem::create([
                    'admin_id' => Auth::id(),
                    'sell_invoice_id' => $invoiceId,
                    'sell_invoice_item_id' => $gold->id,
                    'stone_name' => $s['stone_name'],
                    'stone_weight' => $s['stone_weight'],
                    'stone_price' => $s['stone_price'],
                    'stone_final_price' => $s['stone_final_price'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'invoice_id' => $invoiceId,
                'item_id' => $gold->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
