<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'image',
        'heading',
        'date',
        'admin',
        'content1',
        'content2',
        'conclusion',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_canonical_url',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
