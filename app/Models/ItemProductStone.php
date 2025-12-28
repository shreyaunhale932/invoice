<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemProductStone extends Model
{
    protected $table = 'item_product_stones';
    protected $primaryKey = 'stone_id';

    protected $fillable = [
        'item_product_data_id',
        'stone_name',
        'stone_weight',
        'stone_price',
        'discount_price',
        'stone_final_price',
        'admin_id',
    ];

    // Stone belongs to item product data
    public function itemProductData()
    {
        return $this->belongsTo(ItemProductData::class, 'item_product_data_id');
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'item_stone_id');
    }
}

