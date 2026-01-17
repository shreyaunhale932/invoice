<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceTemplateSetting;
use App\Models\InvoiceTemplateCustomBlock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceTemplateController extends Controller
{
    /**
     * Display the template editor
     */
    public function index()
    {
        $adminId = Auth::id();
        
        // Get all template settings for this admin
        $settings = InvoiceTemplateSetting::where(function($query) use ($adminId) {
            $query->where('admin_id', $adminId)
                  ->orWhereNull('admin_id');
        })
        ->orderBy('section_key')
        ->orderBy('display_order')
        ->get()
        ->groupBy('section_key');

        // If no settings exist, initialize with defaults
        if ($settings->isEmpty()) {
            $this->initializeDefaultSettings($adminId);
            $settings = InvoiceTemplateSetting::where(function($query) use ($adminId) {
                $query->where('admin_id', $adminId)
                      ->orWhereNull('admin_id');
            })
            ->orderBy('section_key')
            ->orderBy('display_order')
            ->get()
            ->groupBy('section_key');
        }

        // Get custom blocks
        $customBlocks = InvoiceTemplateCustomBlock::where('admin_id', $adminId)
            ->orderBy('display_order')
            ->get();

        return view('Sales.Invoices.template-editor', compact('settings', 'customBlocks'));
    }

    /**
     * Update template settings
     */
    public function update(Request $request)
    {
        $adminId = Auth::id();
        
            DB::beginTransaction();
        try {
            // Parse settings JSON if it's a string
            $settingsJson = $request->input('settings');
            if (is_string($settingsJson)) {
                $settings = json_decode($settingsJson, true) ?? [];
            } else {
                $settings = $settingsJson ?? [];
            }
            
            // Handle image uploads first
            $uploadedImages = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    if ($file && $file->isValid()) {
                        $filename = 'invoice_' . $adminId . '_' . time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                        $path = public_path('assets/img/invoice-templates/');
                        
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        
                        $file->move($path, $filename);
                        $uploadedImages[$key] = '/public/assets/img/invoice-templates/' . $filename;
                    }
                }
            }
            
            // Replace image keys with actual paths
            foreach ($settings as &$settingData) {
                if (isset($settingData['image_key']) && isset($uploadedImages[$settingData['image_key']])) {
                    $settingData['value'] = $uploadedImages[$settingData['image_key']];
                }
            }
           
            
            foreach ($settings as $settingData) {
                $setting = InvoiceTemplateSetting::where('admin_id', $adminId)
                    ->where('section_key', $settingData['section_key'])
                    ->where('field_key', $settingData['field_key'])
                    ->first();
                 
                if ($setting) {
                    $updateData = [
                        'label' => $settingData['label'] ?? $setting->label,
                        'is_visible' => isset($settingData['is_visible']) ? (bool)$settingData['is_visible'] : $setting->is_visible,
                        'display_order' => $settingData['display_order'] ?? $setting->display_order,
                    ];
                    
                    // Handle image/file uploads
                    if (isset($settingData['value'])) {
                        $updateData['value'] = $settingData['value'];
                    }
                    
                    $setting->update($updateData);
                } else {
                    // Create new setting for this admin
                    $createData = [
                        'admin_id' => $adminId,
                        'section_key' => $settingData['section_key'],
                        'field_key' => $settingData['field_key'],
                        'label' => $settingData['label'] ?? $settingData['field_key'],
                        'is_visible' => isset($settingData['is_visible']) ? (bool)$settingData['is_visible'] : true,
                        'display_order' => $settingData['display_order'] ?? 0,
                        'field_type' => $settingData['field_type'] ?? 'label',
                    ];
                    
                    if (isset($settingData['value'])) {
                        $createData['value'] = $settingData['value'];
                    }
                    
                    InvoiceTemplateSetting::create($createData);
                }
            }
            // die();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Template settings updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating template: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Initialize default template settings
     */
    private function initializeDefaultSettings($adminId)
    {
        $defaults = [
            // Customer Information Section
            ['section_key' => 'text_elements', 'field_key' => 'company_name', 'label' => 'Dreamguys Technologies Pvt Ltd', 'field_type' => 'text', 'display_order' => 1, 'default_value' => 'Dreamguys Technologies Pvt Ltd'],
            ['section_key' => 'text_elements', 'field_key' => 'company_address', 'label' => 'Address:15 Hodges Mews, High Wycombe HP12 3JL, United Kingdom.', 'field_type' => 'text', 'display_order' => 2, 'default_value' => 'Address:15 Hodges Mews, High Wycombe HP12 3JL, United Kingdom.'],
            // ['section_key' => 'text_elements', 'field_key' => 'terms_label', 'label' => 'Terms & Conditions Label', 'field_type' => 'text', 'display_order' => 2, 'default_value' => 'Terms & Conditions:'],
            ['section_key' => 'customer_info', 'field_key' => 'section_title', 'label' => 'Customer Information', 'field_type' => 'section', 'display_order' => 1],
            ['section_key' => 'customer_info', 'field_key' => 'customer_details_label', 'label' => 'Customer Details', 'field_type' => 'label', 'display_order' => 2],
            ['section_key' => 'customer_info', 'field_key' => 'billing_address_label', 'label' => 'Billing Address', 'field_type' => 'label', 'display_order' => 3],
            ['section_key' => 'customer_info', 'field_key' => 'shipping_address_label', 'label' => 'Shipping Address', 'field_type' => 'label', 'display_order' => 4],
            ['section_key' => 'customer_info', 'field_key' => 'payment_status_label', 'label' => 'Payment Status', 'field_type' => 'label', 'display_order' => 5],

            // Invoice Table Columns
            ['section_key' => 'item_table', 'field_key' => 'column_sr_no', 'label' => '#', 'field_type' => 'column', 'display_order' => 1],
            ['section_key' => 'item_table', 'field_key' => 'column_category', 'label' => 'Category', 'field_type' => 'column', 'display_order' => 2],
            ['section_key' => 'item_table', 'field_key' => 'column_subcategory', 'label' => 'Sub Category', 'field_type' => 'column', 'display_order' => 3],
            ['section_key' => 'item_table', 'field_key' => 'column_item', 'label' => 'Item', 'field_type' => 'column', 'display_order' => 4],
            ['section_key' => 'item_table', 'field_key' => 'column_pre_code', 'label' => 'Pre Code', 'field_type' => 'column', 'display_order' => 5],
            ['section_key' => 'item_table', 'field_key' => 'column_post_code', 'label' => 'Post Code', 'field_type' => 'column', 'display_order' => 6],
            ['section_key' => 'item_table', 'field_key' => 'column_barcode', 'label' => 'Barcode', 'field_type' => 'column', 'display_order' => 7],
            ['section_key' => 'item_table', 'field_key' => 'column_hsn_code', 'label' => 'HSN Code', 'field_type' => 'column', 'display_order' => 8],
            ['section_key' => 'item_table', 'field_key' => 'column_purity', 'label' => 'Purity', 'field_type' => 'column', 'display_order' => 9],
            ['section_key' => 'item_table', 'field_key' => 'column_qty', 'label' => 'Qty', 'field_type' => 'column', 'display_order' => 10],
            ['section_key' => 'item_table', 'field_key' => 'column_metal_rate', 'label' => 'Metal Rate', 'field_type' => 'column', 'display_order' => 11],
            ['section_key' => 'item_table', 'field_key' => 'column_gross_wt', 'label' => 'Gross Wt', 'field_type' => 'column', 'display_order' => 12],
            ['section_key' => 'item_table', 'field_key' => 'column_net_wt', 'label' => 'Net Wt', 'field_type' => 'column', 'display_order' => 13],
            ['section_key' => 'item_table', 'field_key' => 'column_fine_wt', 'label' => 'Fine Wt', 'field_type' => 'column', 'display_order' => 14],
            ['section_key' => 'item_table', 'field_key' => 'column_size', 'label' => 'Size', 'field_type' => 'column', 'display_order' => 15],
            ['section_key' => 'item_table', 'field_key' => 'column_wastage_percent', 'label' => 'Wastage %', 'field_type' => 'column', 'display_order' => 16],
            ['section_key' => 'item_table', 'field_key' => 'column_making', 'label' => 'Making', 'field_type' => 'column', 'display_order' => 17],
            ['section_key' => 'item_table', 'field_key' => 'column_gst_percent', 'label' => 'GST %', 'field_type' => 'column', 'display_order' => 18],
            ['section_key' => 'item_table', 'field_key' => 'column_gst_amount', 'label' => 'GST Amount', 'field_type' => 'column', 'display_order' => 19],
            ['section_key' => 'item_table', 'field_key' => 'column_other_charges', 'label' => 'Other Charges', 'field_type' => 'column', 'display_order' => 20],
            ['section_key' => 'item_table', 'field_key' => 'column_amount', 'label' => 'Amount', 'field_type' => 'column', 'display_order' => 21],

            // Footer Labels
            ['section_key' => 'invoice_footer', 'field_key' => 'taxable_amount_label', 'label' => 'Taxable Amount', 'field_type' => 'label', 'display_order' => 1],
            ['section_key' => 'invoice_footer', 'field_key' => 'cgst_label', 'label' => 'CGST', 'field_type' => 'label', 'display_order' => 2],
            ['section_key' => 'invoice_footer', 'field_key' => 'sgst_label', 'label' => 'SGST', 'field_type' => 'label', 'display_order' => 3],
            ['section_key' => 'invoice_footer', 'field_key' => 'igst_label', 'label' => 'IGST', 'field_type' => 'label', 'display_order' => 4],
            ['section_key' => 'invoice_footer', 'field_key' => 'discount_label', 'label' => 'Discount', 'field_type' => 'label', 'display_order' => 5],
            ['section_key' => 'invoice_footer', 'field_key' => 'round_off_label', 'label' => 'Round Off', 'field_type' => 'label', 'display_order' => 6],
            ['section_key' => 'invoice_footer', 'field_key' => 'total_amount_label', 'label' => 'Total Amount', 'field_type' => 'label', 'display_order' => 7],
            ['section_key' => 'invoice_footer', 'field_key' => 'cash_received_label', 'label' => 'Cash Received', 'field_type' => 'label', 'display_order' => 8],
            ['section_key' => 'invoice_footer', 'field_key' => 'online_received_label', 'label' => 'Online Received', 'field_type' => 'label', 'display_order' => 9],
            ['section_key' => 'invoice_footer', 'field_key' => 'bank_received_label', 'label' => 'Bank Received', 'field_type' => 'label', 'display_order' => 10],
            ['section_key' => 'invoice_footer', 'field_key' => 'card_received_label', 'label' => 'Card Received', 'field_type' => 'label', 'display_order' => 11],
            ['section_key' => 'invoice_footer', 'field_key' => 'total_received_label', 'label' => 'Total Received', 'field_type' => 'label', 'display_order' => 12],
            ['section_key' => 'invoice_footer', 'field_key' => 'balance_due_label', 'label' => 'Balance Due', 'field_type' => 'label', 'display_order' => 13],

            // Visual Elements
            ['section_key' => 'visual_elements', 'field_key' => 'logo_light', 'label' => 'Logo (Light Mode)', 'field_type' => 'image', 'display_order' => 1, 'default_value' => '/public/assets/img/logo2.png'],
            ['section_key' => 'visual_elements', 'field_key' => 'logo_dark', 'label' => 'Logo (Dark Mode)', 'field_type' => 'image', 'display_order' => 2, 'default_value' => '/public/assets/img/logo2-white.png'],
            ['section_key' => 'visual_elements', 'field_key' => 'paid_logo', 'label' => 'Paid Status Logo', 'field_type' => 'image', 'display_order' => 3, 'default_value' => '/public/assets/img/paid.svg'],
            ['section_key' => 'visual_elements', 'field_key' => 'signature_image', 'label' => 'Signature Image', 'field_type' => 'image', 'display_order' => 4, 'default_value' => '/public/assets/img/signature.png'],
            ['section_key' => 'visual_elements', 'field_key' => 'qr_code', 'label' => 'QR Code Image', 'field_type' => 'image', 'display_order' => 5, 'default_value' => '/public/assets/img/qr-code.svg'],
            ['section_key' => 'visual_elements', 'field_key' => 'dummy_image', 'label' => 'QR Code Image', 'field_type' => 'image', 'display_order' => 5, 'default_value' => '/public/assets/img/qr-code.svg'],
            // Text Elements
            ['section_key' => 'text_elements', 'field_key' => 'thanks_message', 'label' => 'Thanks Message', 'field_type' => 'text', 'display_order' => 1, 'default_value' => 'Thanks for your Business'],
            ['section_key' => 'text_elements', 'field_key' => 'terms_label', 'label' => 'Terms & Conditions Label', 'field_type' => 'text', 'display_order' => 2, 'default_value' => 'Terms & Conditions:'],
            ['section_key' => 'text_elements', 'field_key' => 'payment_info_label', 'label' => 'Payment Info Label', 'field_type' => 'text', 'display_order' => 3, 'default_value' => 'Payment Info:'],
            ['section_key' => 'text_elements', 'field_key' => 'scan_details_label', 'label' => 'Scan Details Label', 'field_type' => 'text', 'display_order' => 4, 'default_value' => 'Scan to View Receipt'],
            ['section_key'=>'invoice_header','field_key'=>'title','label'=>'Invoice','field_type'=>'text','display_order'=>1],

            ['section_key'=>'invoice_meta','field_key'=>'invoice_no','label'=>'Invoice No','field_type'=>'label','display_order'=>1],
            ['section_key'=>'invoice_meta','field_key'=>'invoice_date','label'=>'Invoice Date','field_type'=>'label','display_order'=>2],
            ['section_key'=>'invoice_meta','field_key'=>'due_date','label'=>'Due Date','field_type'=>'label','display_order'=>3],
            
            ['section_key'=>'customer_info','field_key'=>'gstin_label','label'=>'GSTIN','field_type'=>'label','display_order'=>6],
            
        ];

        foreach ($defaults as $default) {
            $createData = [
                'admin_id' => $adminId,
                'section_key' => $default['section_key'],
                'field_key' => $default['field_key'],
                'label' => $default['label'],
                'is_visible' => true,
                'display_order' => $default['display_order'],
                'field_type' => $default['field_type'],
            ];
            
            if (isset($default['default_value'])) {
                $createData['default_value'] = $default['default_value'];
            }
            
            InvoiceTemplateSetting::create($createData);
        }
    }

    /**
     * Reset to defaults
     */
    public function reset(Request $request)
    {
        $adminId = Auth::id();
        
        DB::beginTransaction();
        try {
            InvoiceTemplateSetting::where('admin_id', $adminId)->delete();
            $this->initializeDefaultSettings($adminId);
            
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Template reset to defaults successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error resetting template: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store custom block
     */
    public function storeBlock(Request $request)
    {
        $adminId = Auth::id();
        
        DB::beginTransaction();
        try {
            $imagePath = null;
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                if ($image->isValid()) {
                    $filename = 'block_' . $adminId . '_' . time() . '.' . $image->getClientOriginalExtension();
                    $path = public_path('assets/img/invoice-templates/blocks/');
                    
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    
                    $image->move($path, $filename);
                    $imagePath = '/public/assets/img/invoice-templates/blocks/' . $filename;
                }
            }

            $block = InvoiceTemplateCustomBlock::create([
                'admin_id' => $adminId,
                'block_name' => $request->input('block_name'),
                'block_type' => $request->input('block_type', 'custom'),
                'content' => $request->input('content'),
                'image_path' => $imagePath,
                'position' => $request->input('position', 'before_footer'),
                'display_order' => $request->input('display_order', 0),
                'is_visible' => $request->input('is_visible', true),
                'css_class' => $request->input('css_class'),
                'custom_css' => $request->input('custom_css'),
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Custom block created successfully',
                'block' => $block
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error creating block: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update custom block
     */
    public function updateBlock(Request $request, $id)
    {
        $adminId = Auth::id();
        
        DB::beginTransaction();
        try {
            $block = InvoiceTemplateCustomBlock::where('admin_id', $adminId)
                ->findOrFail($id);

            $updateData = [
                'block_name' => $request->input('block_name'),
                'block_type' => $request->input('block_type'),
                'content' => $request->input('content'),
                'position' => $request->input('position'),
                'display_order' => $request->input('display_order'),
                'is_visible' => $request->input('is_visible', true),
                'css_class' => $request->input('css_class'),
                'custom_css' => $request->input('custom_css'),
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                if ($image->isValid()) {
                    $filename = 'block_' . $adminId . '_' . time() . '.' . $image->getClientOriginalExtension();
                    $path = public_path('assets/img/invoice-templates/blocks/');
                    
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    
                    $image->move($path, $filename);
                    $updateData['image_path'] = '/public/assets/img/invoice-templates/blocks/' . $filename;
                }
            }

            $block->update($updateData);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Custom block updated successfully',
                'block' => $block
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating block: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete custom block
     */
    public function deleteBlock($id)
    {
        $adminId = Auth::id();
        
        DB::beginTransaction();
        try {
            $block = InvoiceTemplateCustomBlock::where('admin_id', $adminId)
                ->findOrFail($id);
            
            $block->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Custom block deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error deleting block: ' . $e->getMessage()
            ], 500);
        }
    }
}
