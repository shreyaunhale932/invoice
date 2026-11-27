<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPricingPlan extends Model
{
    use HasFactory;

    protected $table = 'cms_pricing_plans';

    protected $fillable = [
        'name',
        'plan_label',
        'is_featured',
        'popular_badge_text',
        'description',
        'monthly_price',
        'monthly_discount',
        'monthly_cut_price',
        'monthly_savings',
        'monthly_billing_text',
        'yearly_price',
        'yearly_discount',
        'yearly_cut_price',
        'yearly_savings',
        'yearly_billing_text',
        'currency_symbol',
        'button_text',
        'button_link',
        'trial_note',
        'features',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'features' => 'array',
        'monthly_price' => 'decimal:2',
        'monthly_discount' => 'decimal:2',
        'monthly_cut_price' => 'decimal:2',
        'monthly_savings' => 'decimal:2',
        'yearly_price' => 'decimal:2',
        'yearly_discount' => 'decimal:2',
        'yearly_cut_price' => 'decimal:2',
        'yearly_savings' => 'decimal:2',
        'sort_order' => 'integer',
    ];
}
