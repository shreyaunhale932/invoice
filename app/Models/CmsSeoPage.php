<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsSeoPage extends Model
{
    protected $fillable = [
        'page_key',
        'page_name',
        'title',
        'description',
        'keywords',
        'canonical_url',
    ];
}
