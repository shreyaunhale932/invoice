<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateElement extends Model
{
    //
    protected $fillable = [
        'template_id',
        'type',
        'value',
        'pos_x',
        'pos_y',
        'width',
        'height',
        'styles',
        'settings',
        'z_index',
    ];

    protected $casts = [
        'styles' => 'array',
        'settings' => 'array',
    ];

    public function template()
    {
        return $this->belongsTo(PrintTemplate::class, 'template_id');
    }
}
