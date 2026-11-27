<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPricingSetting extends Model
{
    use HasFactory;

    protected $table = 'cms_pricing_settings';

    protected $fillable = [
        'main_heading',
        'main_heading_highlight',
        'subheading',
        'yearly_discount_badge',
        'bottom_benefits',
        'trial_eyebrow',
        'trial_title',
        'trial_description',
        'trial_features',
        'trial_button_text',
        'trial_button_link',
    ];

    protected $casts = [
        'bottom_benefits' => 'array',
        'trial_features' => 'array',
    ];
}
