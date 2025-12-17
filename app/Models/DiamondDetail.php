<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DiamondDetail extends Model
{
    //
use SoftDeletes;

    protected $dates = ['deleted_at'];
     protected $table = 'diamond_details';

    protected $fillable = [
        'admin_id',
        'product_id',
        'clarity',
        'cut',
        'color',
        'pieces',
        'price_per_carat',
        'diamond_weight',
        'total_price',
        'diamond_final_price',
    ];

    // Diamond belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
