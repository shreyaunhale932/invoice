<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPricingComparisonSetting extends Model
{
    protected $table = 'cms_pricing_comparison_settings';

    protected $fillable = [
        'eyebrow',
        'title',
        'description',
        'feature_heading',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
