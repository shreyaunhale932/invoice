<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemDiamondDetail extends Model
{
    protected $table = 'item_diamond_details';
    protected $primaryKey = 'diamond_id';

    protected $fillable = [
        'item_product_data_id',
        'clarity',
        'cut',
        'color',
        'pieces',
        'price_per_carat',
        'total_price',
        'diamond_weight',
        'diamond_final_price',
    ];

    // Diamond belongs to item product data
    public function itemProductData()
    {
        return $this->belongsTo(ItemProductData::class, 'item_product_data_id');
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'item_diamond_id');
    }
}

