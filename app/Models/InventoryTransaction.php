<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'gross_weight',
        'unit',
        'remarks',
        'admin_id',
        'quantity',
        'final_fn_weight',
        'net_weight'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
