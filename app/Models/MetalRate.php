<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetalRate extends Model
{
    //
    protected $table = "metal_rates";

    protected $fillable = ['admin_id','metal_type','price_per_gram','gram','karat','purity_type'];
     public function products()
    {
        return $this->hasMany(Product::class, 'metal_rate');
    }
}
