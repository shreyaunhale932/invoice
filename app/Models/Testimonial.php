<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'content',
        'rating',
        'name',
        'short_detail',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];
}
