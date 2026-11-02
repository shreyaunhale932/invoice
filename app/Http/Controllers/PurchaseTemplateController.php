<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseTemplateSetting;
use App\Models\InvoiceTemplateCustomBlock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseTemplateController extends Controller
{
    /**
     * Display the purchase template editor
     */
    public function index()
    {
        $adminId = Auth::guard('admin')->id() ?? Auth::id();

        // Get settings and ensure table & defaults are ready
        PurchaseTemplateSetting::getSettingsForAdmin($adminId);

        $settings = PurchaseTemplateSetting::where(function ($query) use ($adminId) {
            $query->where('admin_id', $adminId)
                ->orWhereNull('admin_id');
        })
            ->orderBy('section_key')
            ->orderBy('display_order')
            ->get()
            ->groupBy('section_key');

        // Custom blocks
        $customBlocks = InvoiceTemplateCustomBlock::where('admin_id', $adminId)
            ->orderBy('display_order')
            ->get();

        return view('Purchases.retail-purchases.template-editor', compact('settings', 'customBlocks'));
    }

    /**
     * Update purchase template settings
     */
    public function update(Request $request)
    {
        $adminId = Auth::guard('admin')->id() ?? Auth::id();

        DB::beginTransaction();
        try {
            $settingsJson = $request->input('settings');
            if (is_string($settingsJson)) {
                $settings = json_decode($settingsJson, true) ?? [];
            } else {
                $settings = $settingsJson ?? [];
            }

            // Handle image uploads
            $uploadedImages = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    if ($file && $file->isValid()) {
                        $filename = 'purchase_' . $adminId . '_' . time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                        $directory = public_path('assets/img/invoice-templates');
                        if (!file_exists($directory)) {
                            mkdir($directory, 0755, true);
                        }
                        $file->move($directory, $filename);
                        $uploadedImages[$key] = '/assets/img/invoice-templates/' . $filename;
                    }
                }
            }

            foreach ($settings as &$settingData) {
                if (isset($settingData['image_key']) && isset($uploadedImages[$settingData['image_key']])) {
                    $settingData['value'] = $uploadedImages[$settingData['image_key']];
                }
            }

            foreach ($settings as $settingData) {
                $setting = PurchaseTemplateSetting::where('admin_id', $adminId)
                    ->where('section_key', $settingData['section_key'])
                    ->where('field_key', $settingData['field_key'])
                    ->first();

                if ($setting) {
                    $updateData = [
                        'label' => $settingData['label'] ?? $setting->label,
                        'is_visible' => isset($settingData['is_visible']) ? (bool)$settingData['is_visible'] : $setting->is_visible,
                        'display_order' => $settingData['display_order'] ?? $setting->display_order,
                    ];

                    if (isset($settingData['value'])) {
                        $updateData['value'] = $settingData['value'];
                    }

                    $setting->update($updateData);
                } else {
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

                    PurchaseTemplateSetting::create($createData);
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Purchase template settings updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating purchase template: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reset purchase template settings to defaults
     */
    public function reset(Request $request)
    {
        $adminId = Auth::guard('admin')->id() ?? Auth::id();

        DB::beginTransaction();
        try {
            PurchaseTemplateSetting::where('admin_id', $adminId)->delete();
            PurchaseTemplateSetting::initializeDefaults($adminId);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Purchase template reset to defaults successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error resetting purchase template: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store custom block
     */
    public function storeBlock(Request $request)
    {
        $adminId = Auth::guard('admin')->id() ?? Auth::id();

        DB::beginTransaction();
        try {
            $imagePath = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $filename = 'block_' . $adminId . '_' . time() . '.' . $file->getClientOriginalExtension();
                $directory = public_path('assets/img/invoice-templates');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                $file->move($directory, $filename);
                $imagePath = '/assets/img/invoice-templates/' . $filename;
            }

            $block = InvoiceTemplateCustomBlock::create([
                'admin_id' => $adminId,
                'block_name' => $request->input('block_name'),
                'block_type' => $request->input('block_type', 'info'),
                'content' => $request->input('content'),
                'image_path' => $imagePath,
                'position' => $request->input('position', 'before_footer'),
                'is_visible' => $request->has('is_visible') ? (bool)$request->input('is_visible') : true,
                'display_order' => $request->input('display_order', 0),
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
        $adminId = Auth::guard('admin')->id() ?? Auth::id();

        DB::beginTransaction();
        try {
            $block = InvoiceTemplateCustomBlock::where('admin_id', $adminId)->findOrFail($id);

            $data = [
                'block_name' => $request->input('block_name', $block->block_name),
                'block_type' => $request->input('block_type', $block->block_type),
                'content' => $request->input('content', $block->content),
                'position' => $request->input('position', $block->position),
                'is_visible' => $request->has('is_visible') ? (bool)$request->input('is_visible') : $block->is_visible,
                'display_order' => $request->input('display_order', $block->display_order),
                'css_class' => $request->input('css_class', $block->css_class),
                'custom_css' => $request->input('custom_css', $block->custom_css),
            ];

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $filename = 'block_' . $adminId . '_' . time() . '.' . $file->getClientOriginalExtension();
                $directory = public_path('assets/img/invoice-templates');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                $file->move($directory, $filename);
                $data['image_path'] = '/assets/img/invoice-templates/' . $filename;
            }

            $block->update($data);

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
        $adminId = Auth::guard('admin')->id() ?? Auth::id();

        try {
            $block = InvoiceTemplateCustomBlock::where('admin_id', $adminId)->findOrFail($id);
            $block->delete();

            return response()->json([
                'success' => true,
                'message' => 'Custom block deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting block: ' . $e->getMessage()
            ], 500);
        }
    }
}
