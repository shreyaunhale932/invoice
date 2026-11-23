<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsSolution extends Model
{
    protected $fillable = [
        'title',
        'description',
        'home_description',
        'tagline',
        'url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
