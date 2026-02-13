<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class InvoiceTemplateSetting extends Model
{
    use HasFactory, BelongsToFirm;

    protected $table = 'invoice_template_settings';

    protected $fillable = [
        'admin_id',
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
     * Get settings for a specific admin, or global if admin_id is null
     */
    public static function getSetting($sectionKey, $fieldKey = null, $adminId = null)
    {
        $query = static::where('section_key', $sectionKey)
            ->where('is_visible', true);

        if ($fieldKey) {
            $query->where('field_key', $fieldKey);
        }

        if ($adminId) {
            $query->where(function($q) use ($adminId) {
                $q->where('admin_id', $adminId)
                  ->orWhereNull('admin_id');
            })->orderByRaw('CASE WHEN admin_id IS NOT NULL THEN 0 ELSE 1 END');
        } else {
            $query->whereNull('admin_id');
        }

        return $fieldKey ? $query->first() : $query->get();
    }

    /**
     * Get label for a field
     */
    public static function getLabel($sectionKey, $fieldKey, $adminId = null, $default = null)
    {
        $setting = static::getSetting($sectionKey, $fieldKey, $adminId);
        return $setting ? $setting->label : ($default ?? $fieldKey);
    }

    /**
     * Check if a section is visible
     */
    public static function isSectionVisible($sectionKey, $adminId = null)
    {
        $setting = static::getSetting($sectionKey, null, $adminId)->first();
        return $setting ? $setting->is_visible : true;
    }
}
