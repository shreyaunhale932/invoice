<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomFieldDefinition extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'model_type',    // 'invoice' or 'invoice_item'
        'field_key',
        'field_label',
        'field_type'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function values()
    {
        return $this->hasMany(CustomFieldValue::class);
    }
}
