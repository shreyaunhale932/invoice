<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTemplateCustomBlock extends Model
{
    use HasFactory;

    protected $table = 'invoice_template_custom_blocks';

    protected $fillable = [
        'admin_id',
        'block_name',
        'block_type',
        'content',
        'image_path',
        'position',
        'display_order',
        'is_visible',
        'css_class',
        'custom_css',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'display_order' => 'integer',
    ];
}
