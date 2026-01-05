<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $fillable = [
        'product_id',
        'item_product_data_id',
        'item_diamond_id',
        'item_stone_id',
        'type',
        'gross_weight',
        'unit',
        'remarks',
        'admin_id',
        'quantity',
        'final_fn_weight',
        'net_weight',
        'size'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function itemProductData()
    {
        return $this->belongsTo(ItemProductData::class, 'item_product_data_id');
    }

    public function itemDiamond()
    {
        return $this->belongsTo(ItemDiamondDetail::class, 'item_diamond_id', 'diamond_id');
    }

    public function itemStone()
    {
        return $this->belongsTo(ItemProductStone::class, 'item_stone_id', 'stone_id');
    }
}
