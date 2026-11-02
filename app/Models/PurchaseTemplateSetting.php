<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class PurchaseTemplateSetting extends Model
{
    use HasFactory, BelongsToFirm;

    protected $table = 'purchase_template_settings';

    protected $fillable = [
        'admin_id',
        'firm_id',
        'section_key',
        'field_key',
        'label',
        'is_visible',
        'display_order',
        'field_type',
        'default_value',
        'value',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Ensure the table exists
     */
    public static function ensureTableExists()
    {
        if (!Schema::hasTable('purchase_template_settings')) {
            Schema::create('purchase_template_settings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('admin_id')->nullable();
                $table->unsignedBigInteger('firm_id')->nullable();
                $table->string('section_key');
                $table->string('field_key');
                $table->string('label')->nullable();
                $table->boolean('is_visible')->default(true);
                $table->integer('display_order')->default(0);
                $table->string('field_type')->nullable();
                $table->text('default_value')->nullable();
                $table->text('value')->nullable();
                $table->timestamps();

                $table->index(['admin_id', 'section_key']);
            });
        }
    }

    /**
     * Default settings definition specifically for Purchase Invoices
     */
    public static function getDefaults()
    {
        return [
            // 1. Purchase Header
            ['section_key' => 'purchase_header', 'field_key' => 'title', 'label' => 'PURCHASE INVOICE', 'field_type' => 'text', 'display_order' => 1, 'default_value' => 'PURCHASE INVOICE', 'is_visible' => true],
            ['section_key' => 'purchase_header', 'field_key' => 'company_name', 'label' => 'Company Name', 'field_type' => 'text', 'display_order' => 2, 'default_value' => 'Dreamguys Technologies Pvt Ltd', 'is_visible' => true],
            ['section_key' => 'purchase_header', 'field_key' => 'company_address', 'label' => 'Company Address', 'field_type' => 'textarea', 'display_order' => 3, 'default_value' => "Address:15 Hodges Mews, High Wycombe HP12 3JL, United Kingdom.", 'is_visible' => true],

            // 2. Purchase Meta Details
            ['section_key' => 'purchase_meta', 'field_key' => 'purchase_no', 'label' => 'Purchase No', 'field_type' => 'label', 'display_order' => 1, 'is_visible' => true],
            ['section_key' => 'purchase_meta', 'field_key' => 'purchase_date', 'label' => 'Purchase Date', 'field_type' => 'label', 'display_order' => 2, 'is_visible' => true],
            ['section_key' => 'purchase_meta', 'field_key' => 'supplier_ref', 'label' => 'Supplier Ref', 'field_type' => 'label', 'display_order' => 3, 'is_visible' => true],
            ['section_key' => 'purchase_meta', 'field_key' => 'due_date', 'label' => 'Due Date', 'field_type' => 'label', 'display_order' => 4, 'is_visible' => true],

            // 3. Supplier Information
            ['section_key' => 'supplier_info', 'field_key' => 'section_title', 'label' => 'Supplier Information', 'field_type' => 'section', 'display_order' => 1, 'is_visible' => true],
            ['section_key' => 'supplier_info', 'field_key' => 'supplier_details_label', 'label' => 'Supplier Details :', 'field_type' => 'label', 'display_order' => 2, 'is_visible' => true],
            ['section_key' => 'supplier_info', 'field_key' => 'payment_status_label', 'label' => 'Payment Status :', 'field_type' => 'label', 'display_order' => 3, 'is_visible' => true],
            ['section_key' => 'supplier_info', 'field_key' => 'address_label', 'label' => 'Address :', 'field_type' => 'label', 'display_order' => 4, 'is_visible' => true],
            ['section_key' => 'supplier_info', 'field_key' => 'payment_method_label', 'label' => 'Payment Method :', 'field_type' => 'label', 'display_order' => 5, 'is_visible' => true],

            // 4. Wholesale Purchase Items Table Columns
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_sr_no', 'label' => 'SL No.', 'field_type' => 'column', 'display_order' => 1, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_item_desc', 'label' => 'Item Desc', 'field_type' => 'column', 'display_order' => 2, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_pcs', 'label' => 'Pcs', 'field_type' => 'column', 'display_order' => 3, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_hsn', 'label' => 'HSN', 'field_type' => 'column', 'display_order' => 4, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_purity', 'label' => 'Purity', 'field_type' => 'column', 'display_order' => 5, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_gross_wt', 'label' => 'Gr. wt. (Gm.)', 'field_type' => 'column', 'display_order' => 6, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_net_wt', 'label' => 'Net. wt. (Gm.)', 'field_type' => 'column', 'display_order' => 7, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_wastage_percent', 'label' => 'Wastage %', 'field_type' => 'column', 'display_order' => 8, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_gold_rate', 'label' => 'Gold Rate (Gm)', 'field_type' => 'column', 'display_order' => 9, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_stone_weight', 'label' => 'Stone/Oth. wt. (Gm)', 'field_type' => 'column', 'display_order' => 10, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_diamond_stone', 'label' => 'Diamond/Stone', 'field_type' => 'column', 'display_order' => 11, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_diamond_pcs', 'label' => 'Pcs (Diamond)', 'field_type' => 'column', 'display_order' => 12, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_diamond_ct', 'label' => 'Ct (Diamond)', 'field_type' => 'column', 'display_order' => 13, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_diamond_rate', 'label' => 'Rate (Diamond)', 'field_type' => 'column', 'display_order' => 14, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_making', 'label' => 'Making', 'field_type' => 'column', 'display_order' => 15, 'is_visible' => true],
            ['section_key' => 'purchase_item_table', 'field_key' => 'column_amount', 'label' => 'Amount', 'field_type' => 'column', 'display_order' => 16, 'is_visible' => true],

            // 5. Gold / Metal Payment Summary
            ['section_key' => 'metal_payment', 'field_key' => 'section_title', 'label' => 'Gold / Metal Payment Summary:', 'field_type' => 'section', 'display_order' => 1, 'is_visible' => true],
            ['section_key' => 'metal_payment', 'field_key' => 'metal_given_label', 'label' => 'Metal Given:', 'field_type' => 'label', 'display_order' => 2, 'is_visible' => true],
            ['section_key' => 'metal_payment', 'field_key' => 'fine_wt_given_label', 'label' => 'Fine Wt Given:', 'field_type' => 'label', 'display_order' => 3, 'is_visible' => true],
            ['section_key' => 'metal_payment', 'field_key' => 'metal_rate_label', 'label' => 'Metal Rate Applied:', 'field_type' => 'label', 'display_order' => 4, 'is_visible' => true],
            ['section_key' => 'metal_payment', 'field_key' => 'gold_value_settled_label', 'label' => 'Gold Value Settled:', 'field_type' => 'label', 'display_order' => 5, 'is_visible' => true],
            ['section_key' => 'metal_payment', 'field_key' => 'remaining_metal_wt_label', 'label' => 'Remaining Metal Wt:', 'field_type' => 'label', 'display_order' => 6, 'is_visible' => true],

            // 6. Footer & Totals Summary
            ['section_key' => 'purchase_footer', 'field_key' => 'subtotal_label', 'label' => 'Subtotal', 'field_type' => 'label', 'display_order' => 1, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'discount_label', 'label' => 'Discount', 'field_type' => 'label', 'display_order' => 2, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'taxable_amount_label', 'label' => 'Taxable Amount', 'field_type' => 'label', 'display_order' => 3, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'cgst_label', 'label' => 'CGST', 'field_type' => 'label', 'display_order' => 4, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'sgst_label', 'label' => 'SGST', 'field_type' => 'label', 'display_order' => 5, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'igst_label', 'label' => 'IGST', 'field_type' => 'label', 'display_order' => 6, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'other_charges_label', 'label' => 'Other Charges', 'field_type' => 'label', 'display_order' => 7, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'round_off_label', 'label' => 'Round Off', 'field_type' => 'label', 'display_order' => 8, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'grand_total_label', 'label' => 'Grand Total', 'field_type' => 'label', 'display_order' => 9, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'gold_payment_settled_label', 'label' => 'Gold Payment Settled', 'field_type' => 'label', 'display_order' => 10, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'amount_paid_label', 'label' => 'Amount Paid', 'field_type' => 'label', 'display_order' => 11, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'balance_due_label', 'label' => 'Balance Due', 'field_type' => 'label', 'display_order' => 12, 'is_visible' => true],
            ['section_key' => 'purchase_footer', 'field_key' => 'total_in_words_label', 'label' => 'Total amount (in words):', 'field_type' => 'label', 'display_order' => 13, 'is_visible' => true],

            // 7. Terms, Notes & Messages
            ['section_key' => 'terms_and_notes', 'field_key' => 'purchase_notes_label', 'label' => 'Purchase Notes:', 'field_type' => 'text', 'display_order' => 1, 'default_value' => 'Purchase Notes:', 'is_visible' => true],
            ['section_key' => 'terms_and_notes', 'field_key' => 'terms_label', 'label' => 'Terms & Conditions:', 'field_type' => 'text', 'display_order' => 2, 'default_value' => 'Terms & Conditions:', 'is_visible' => true],
            ['section_key' => 'terms_and_notes', 'field_key' => 'terms_value', 'label' => 'Terms & Conditions Content', 'field_type' => 'textarea', 'display_order' => 3, 'default_value' => "1. All items received subject to inspection and quality check.\n2. Payment as per agreed terms and credit period.\n3. Disputes subject to local jurisdiction only.", 'is_visible' => true],
            ['section_key' => 'terms_and_notes', 'field_key' => 'thanks_message', 'label' => 'Thanks Message', 'field_type' => 'text', 'display_order' => 4, 'default_value' => 'Thank you for your business!', 'is_visible' => true],
            ['section_key' => 'terms_and_notes', 'field_key' => 'disclaimer_text', 'label' => 'Disclaimer Note', 'field_type' => 'text', 'display_order' => 5, 'default_value' => 'This is an electronically generated document. Powered by Sirsonite.com', 'is_visible' => true],

            // 8. Visual Elements & Signatures
            ['section_key' => 'visual_elements', 'field_key' => 'logo_light', 'label' => 'Logo (Light Mode)', 'field_type' => 'image', 'display_order' => 1, 'default_value' => '/assets/img/logo2.png', 'is_visible' => true],
            ['section_key' => 'visual_elements', 'field_key' => 'logo_dark', 'label' => 'Logo (Dark Mode)', 'field_type' => 'image', 'display_order' => 2, 'default_value' => '/assets/img/logo2-white.png', 'is_visible' => true],
            ['section_key' => 'visual_elements', 'field_key' => 'signature_image', 'label' => 'Authorized Signature Image', 'field_type' => 'image', 'display_order' => 3, 'default_value' => '/assets/img/signature.png', 'is_visible' => true],
            ['section_key' => 'visual_elements', 'field_key' => 'signature_label', 'label' => 'Authorized Signature Label', 'field_type' => 'label', 'display_order' => 4, 'default_value' => 'Authorized Signature', 'is_visible' => true],
            ['section_key' => 'visual_elements', 'field_key' => 'supplier_signature_label', 'label' => 'Supplier / Vendor Signature Label', 'field_type' => 'label', 'display_order' => 5, 'default_value' => 'Supplier / Vendor Signature', 'is_visible' => true],
        ];
    }

    /**
     * Get settings for an admin, initializing or merging missing if needed
     */
    public static function getSettingsForAdmin($adminId)
    {
        self::ensureTableExists();

        $settings = static::where(function ($query) use ($adminId) {
            $query->where('admin_id', $adminId)
                ->orWhereNull('admin_id');
        })
            ->orderByRaw('CASE WHEN admin_id IS NOT NULL THEN 0 ELSE 1 END')
            ->orderBy('section_key')
            ->orderBy('display_order')
            ->get();

        if ($settings->isEmpty()) {
            static::initializeDefaults($adminId);
            $settings = static::where('admin_id', $adminId)->get();
        } else {
            static::mergeMissingDefaults($adminId);
            $settings = static::where('admin_id', $adminId)->get();
        }

        return $settings->keyBy(function ($item) {
            return $item->section_key . '.' . $item->field_key;
        });
    }

    /**
     * Initialize defaults for admin
     */
    public static function initializeDefaults($adminId)
    {
        self::ensureTableExists();
        $defaults = self::getDefaults();

        foreach ($defaults as $default) {
            $data = [
                'admin_id' => $adminId,
                'section_key' => $default['section_key'],
                'field_key' => $default['field_key'],
                'label' => $default['label'],
                'is_visible' => $default['is_visible'] ?? true,
                'display_order' => $default['display_order'] ?? 0,
                'field_type' => $default['field_type'] ?? 'label',
            ];

            if (isset($default['default_value'])) {
                $data['default_value'] = $default['default_value'];
                $data['value'] = $default['default_value'];
            }

            static::create($data);
        }
    }

    /**
     * Merge any missing defaults for admin
     */
    public static function mergeMissingDefaults($adminId)
    {
        self::ensureTableExists();
        $defaults = self::getDefaults();

        foreach ($defaults as $default) {
            $exists = static::where('admin_id', $adminId)
                ->where('section_key', $default['section_key'])
                ->where('field_key', $default['field_key'])
                ->exists();

            if (!$exists) {
                $data = [
                    'admin_id' => $adminId,
                    'section_key' => $default['section_key'],
                    'field_key' => $default['field_key'],
                    'label' => $default['label'],
                    'is_visible' => $default['is_visible'] ?? true,
                    'display_order' => $default['display_order'] ?? 0,
                    'field_type' => $default['field_type'] ?? 'label',
                ];

                if (isset($default['default_value'])) {
                    $data['default_value'] = $default['default_value'];
                    $data['value'] = $default['default_value'];
                }

                static::create($data);
            }
        }
    }
}
