<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrintTemplate;
use App\Models\Product; // Assuming this model exists for jewelry items
use App\Models\PrintLog;

class PrintController extends Controller
{
    public function preview($template_id, $product_id)
    {
        $template = PrintTemplate::with(['elements'])->findOrFail($template_id);
        
        $product = Product::with([
            'purity',
            'category',
            'subcategory',
            'diamonds',
            'stones',
            'packets.packetMaster',
            'packets.stone',
            'packets.clarity',
            'packets.color',
            'packets.cut',
            'packets.shape',
            'packets.chalni',
            'packets.mm'
        ])->find($product_id);
        
        if (!$product) {
            // Mock data for previewing without a real product
            $product = (object) [
                'id' => 12345,
                'product_name' => 'Sample Gold Ring',
                'name' => 'Sample Gold Ring',
                'pre_code' => 'SKU',
                'post_code' => '9999',
                'sku' => 'SKU-9999',
                'gross_weight' => '12.500',
                'net_weight' => '11.000',
                'final_fn_weight' => '10.800',
                'purity' => (object)['purity_value' => '22', 'purity_type' => 'K'],
                'gold_color' => 'Yellow Gold',
                'size' => '12',
                'quantity' => '1',
                'sale_price' => '45000',
                'selling_price' => '45000',
                'making_price' => '1500',
                'making_type' => 'Gram',
                'making_final_amount' => '1500',
                'wastage_percent' => '2.5',
                'wastage_amount' => '300',
                'gst_percent' => '3',
                'gst_amount' => '1350',
                'gold_price' => '40000',
                'mrp_price' => '48000',
                'final_price' => '45000',
                'hsn_code' => '7113',
                'category' => (object)['category_name' => 'Ring'],
                'subcategory' => (object)['subcategory_name' => 'Gold Ring'],
                'hallmarking' => 'Yes',
                'diamond_weight' => '0.50',
                'stone_weight' => '0.20',
                'barcode' => '123456789012',
                'packets' => collect([
                    (object)[
                        'packet_no' => 'PK-001',
                        'pcs' => 2,
                        'weight' => 0.50,
                        'wt_in_gram' => 0.10,
                        'amount' => 5000,
                        'certificate_no' => 'GIA-12345',
                        'stone' => (object)['name' => 'Diamond'],
                        'clarity' => (object)['name' => 'VS1'],
                        'color' => (object)['name' => 'G'],
                        'cut' => (object)['name' => 'Excellent'],
                        'shape' => (object)['name' => 'Round'],
                    ]
                ])
            ];
        }

        return view('labels.print.preview', compact('template', 'product'));
    }

    public function bulkPrintView()
    {
        $templates = PrintTemplate::all();
        $products = Product::with([
            'purity',
            'category',
            'subcategory',
            'diamonds',
            'stones',
            'packets.packetMaster',
            'packets.stone',
            'packets.clarity',
            'packets.color',
            'packets.cut',
            'packets.shape',
            'packets.chalni',
            'packets.mm'
        ])->limit(50)->get();
        return view('labels.print.bulk', compact('templates', 'products'));
    }

    public function processBulk(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:print_templates,id',
            'product_ids' => 'required|array',
        ]);

        $template = PrintTemplate::with(['elements'])->findOrFail($request->template_id);
        
        $products = Product::with([
            'purity',
            'category',
            'subcategory',
            'diamonds',
            'stones',
            'packets.packetMaster',
            'packets.stone',
            'packets.clarity',
            'packets.color',
            'packets.cut',
            'packets.shape',
            'packets.chalni',
            'packets.mm'
        ])->whereIn('id', $request->product_ids)->get();

        return view('labels.print.bulk_preview', compact('template', 'products'));
    }
}
