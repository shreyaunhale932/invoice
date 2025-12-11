<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceColumn extends Model
{
    protected $fillable = [
        'user_id','key','name', 'type', 'is_visible', 'is_custom', 'position',
    ];
}
