<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    //
  use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'products';

    protected $fillable = [
        'admin_id',
        'item_product_data_id',
        'product_name',
        'product_code',
        'pre_code',
        'post_code',
        'barcode',
        'category_id',
        'gold_color',
        'subcategory_id',
        'purity_id',
        'metal_rate',
        'hsn_code',
        'gross_weight',
        'gross_weight_unit',
        'net_weight',
        'net_weight_unit',
        'wastage_percent',
        'making_price',
        'gst_percent',
        'gst_amount',
        'gold_price',
        'mrp_price',
        'sale_price',
        'final_fn_weight',
        'quantity',
        'size',
        'final_price',
    ];

    // One product has many diamonds
    public function diamonds()
    {
        return $this->hasMany(DiamondDetail::class, 'product_id');
    }

    // One product has many stones
    public function stones()
    {
        return $this->hasMany(StoneDetail::class, 'product_id');
    }
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

  protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            if ($product->isForceDeleting()) {
                $product->diamonds()->forceDelete();
                $product->stones()->forceDelete();
            } else {
                $product->diamonds()->delete();
                $product->stones()->delete();
            }
        });
    }
    public function inventoryTransactions()
{
    return $this->hasMany(InventoryTransaction::class);
}

    public function itemProductData()
    {
        return $this->belongsTo(ItemProductData::class, 'item_product_data_id');
    }

public function metalRate()
{
    return $this->belongsTo(MetalRate::class, 'metal_rate');
}

}
