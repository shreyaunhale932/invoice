<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StoneDetail extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
     protected $table = 'product_stones';

    protected $fillable = [
        'admin_id',
        'product_id',
        'stone_name',
        'stone_weight',
        'stone_price',
        'discount_price',
        'stone_final_price',
    ];

    // Stone belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
