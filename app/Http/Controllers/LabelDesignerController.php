<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrintTemplate;
use App\Models\TemplateElement;

class LabelDesignerController extends Controller
{
    public function index()
    {
        $templates = PrintTemplate::all();
        return view('labels.templates.index', compact('templates'));
    }

    public function create()
    {
        // Define standard product columns/fields available for drag-and-drop
        $dynamicFields = [
            'product_name' => 'Product Name',
            // 'pre_code' => 'Pre Code',
            // 'post_code' => 'Post Code',
            'product_code' => 'Product Code (Pre-Post)',
            'barcode' => 'Barcode (Text)',
            'gross_weight' => 'Gross Weight',
            'net_weight' => 'Net Weight',
            'final_fn_weight' => 'Final Weight',
            'purity' => 'Purity',
            'gold_color' => 'Gold Color',
            'size' => 'Size',
            // 'quantity' => 'Quantity',
            // 'sale_price' => 'Sale Price',
            // 'making_price' => 'Making Price',
            // 'making_type' => 'Making Type',
            // 'making_final_amount' => 'Making Final Amount',
            // 'wastage_percent' => 'Wastage %',
            // 'wastage_amount' => 'Wastage Amount',
            // 'gst_percent' => 'GST %',
            // 'gst_amount' => 'GST Amount',
            // 'gold_price' => 'Gold Price',
            // 'mrp_price' => 'MRP Price',
            // 'final_price' => 'Final Price',
            'hsn_code' => 'HSN Code',
            // 'category' => 'Category',
            // 'subcategory' => 'Subcategory',
            'hallmarking' => 'Hallmarking',
            // 'diamond_weight' => 'Total Diamond Weight',
            // 'stone_weight' => 'Total Stone Weight',

            // Packet details``
            // 'packet_no' => 'Packet No(s)',
            // 'packet_pcs' => 'Total Packet Pcs',
            // 'packet_weight' => 'Total Packet Weight',
            // 'packet_wt_in_gram' => 'Total Packet Wt (Gram)',
            // 'packet_amount' => 'Total Packet Amount',
            'packet_certificate_no' => 'Packet Certificate No(s)',
            'packet_stones' => 'Packet Stone Names',
            'packet_clarities' => 'Packet Clarities',
            'packet_colors' => 'Packet Colors',
            'packet_cuts' => 'Packet Cuts',
            'packet_shapes' => 'Packet Shapes',
            'packet_details' => 'Packet Details (DIA/ST)',
        ];
        return view('labels.designer.index', compact('dynamicFields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'elements' => 'required|array',
        ]);

        if ($request->is_default) {
            PrintTemplate::query()->update(['is_default' => false]);
        }

        $template = PrintTemplate::create([
            'name' => $request->name,
            'category' => $request->category,
            'canvas_width' => $request->canvas_width,
            'canvas_height' => $request->canvas_height,
            'is_default' => $request->boolean('is_default'),
            'settings' => $request->settings ?? [],
        ]);

        foreach ($request->elements as $element) {
            $template->elements()->create($element);
        }

        return response()->json(['success' => true, 'template_id' => $template->id, 'message' => 'Template saved successfully']);
    }

    public function edit($id)
    {
        $template = PrintTemplate::with('elements')->findOrFail($id);

        $dynamicFields = [
            'product_name' => 'Product Name',
            // 'pre_code' => 'Pre Code',
            // 'post_code' => 'Post Code',
            'product_code' => 'Product Code (Pre-Post)',
            'barcode' => 'Barcode (Text)',
            'gross_weight' => 'Gross Weight',
            'net_weight' => 'Net Weight',
            'final_fn_weight' => 'Final Weight',
            'purity' => 'Purity',
            'gold_color' => 'Gold Color',
            'size' => 'Size',
            // 'quantity' => 'Quantity',
            // 'sale_price' => 'Sale Price',
            // 'making_price' => 'Making Price',
            // 'making_type' => 'Making Type',
            // 'making_final_amount' => 'Making Final Amount',
            // 'wastage_percent' => 'Wastage %',
            // 'wastage_amount' => 'Wastage Amount',
            // 'gst_percent' => 'GST %',
            // 'gst_amount' => 'GST Amount',
            // 'gold_price' => 'Gold Price',
            // 'mrp_price' => 'MRP Price',
            // 'final_price' => 'Final Price',
            'hsn_code' => 'HSN Code',
            // 'category' => 'Category',
            // 'subcategory' => 'Subcategory',
            'hallmarking' => 'Hallmarking',
            // 'diamond_weight' => 'Total Diamond Weight',
            // 'stone_weight' => 'Total Stone Weight',

            // Packet details
            // 'packet_no' => 'Packet No(s)',
            // 'packet_pcs' => 'Total Packet Pcs',
            // 'packet_weight' => 'Total Packet Weight',
            // 'packet_wt_in_gram' => 'Total Packet Wt (Gram)',
            // 'packet_amount' => 'Total Packet Amount',
            'packet_certificate_no' => 'Packet Certificate No(s)',
            'packet_stones' => 'Packet Stone Names',
            'packet_clarities' => 'Packet Clarities',
            'packet_colors' => 'Packet Colors',
            'packet_cuts' => 'Packet Cuts',
            'packet_shapes' => 'Packet Shapes',
            'packet_details' => 'Packet Details (DIA/ST)',
        ];

        return view('labels.designer.index', compact('template', 'dynamicFields'));
    }

    public function update(Request $request, $id)
    {
        $template = PrintTemplate::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'elements' => 'required|array',
        ]);

        if ($request->is_default) {
            PrintTemplate::where('id', '!=', $template->id)->update(['is_default' => false]);
        }

        $template->update([
            'name' => $request->name,
            'category' => $request->category,
            'canvas_width' => $request->canvas_width,
            'canvas_height' => $request->canvas_height,
            'is_default' => $request->boolean('is_default'),
            'settings' => $request->settings ?? [],
        ]);

        // Delete old elements and insert new ones
        $template->elements()->delete();
        foreach ($request->elements as $element) {
            $template->elements()->create($element);
        }

        return response()->json(['success' => true, 'message' => 'Template updated successfully']);
    }

    public function destroy($id)
    {
        $template = PrintTemplate::findOrFail($id);
        $template->delete();
        return redirect()->route('labels.templates.index')->with('success', 'Template deleted successfully.');
    }
}
