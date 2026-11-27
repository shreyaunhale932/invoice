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
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
