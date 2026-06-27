<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintTemplate extends Model
{
    //
    protected $fillable = [
        'name',
        'category',
        'canvas_width',
        'canvas_height',
        'is_default',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_default' => 'boolean',
    ];

    public function elements()
    {
        return $this->hasMany(TemplateElement::class, 'template_id');
    }
}
