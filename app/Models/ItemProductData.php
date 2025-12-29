<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemProductData extends Model
{
    protected $table = 'item_product_data';

    protected $fillable = [
        'product_code',
        'barcode',
        'product_name',
        'category_id',
        'subcategory_id',
        'purity_id',
        'metal_rate',
        'hsn_code',
        'gold_purity',
        'gross_weight',
        'net_weight',
        'diamond_weight',
        'stone_weight',
        'wastage_percent',
        'making_price',
        'gst_percent',
        'gst_amount',
        'sale_price',
        'gold_price',
        'mrp_price',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function purity()
    {
        return $this->belongsTo(PurityModel::class, 'purity_id');
    }

    public function diamonds()
    {
        return $this->hasMany(ItemDiamondDetail::class, 'item_product_data_id');
    }

    public function stones()
    {
        return $this->hasMany(ItemProductStone::class, 'item_product_data_id');
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'item_product_data_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'item_product_data_id');
    }
}

