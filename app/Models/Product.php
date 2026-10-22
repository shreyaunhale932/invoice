<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToFirm;

class Product extends Model
{
    //
    use SoftDeletes, BelongsToFirm;

    protected $dates = ['deleted_at'];
    protected $table = 'products';

    protected $fillable = [
        'admin_id',
        'item_product_data_id',
        'wholesale_stock_id',
        'wholesale_stock_batch_id',
        'retail_purchase_id',
        'retail_purchase_item_id',
        'supplier_id',
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
        'availability',
        'tagged_at',
        'tagged_by',
        'making_type',
        'making_final_amount',
        'hallmarking',
        'wastage_amount',
        'is_direct_sell',
    ];

    public function wholesaleStock()
    {
        return $this->belongsTo(WholesaleStock::class, 'wholesale_stock_id');
    }

    public function wholesaleStockBatch()
    {
        return $this->belongsTo(WholesaleStockBatch::class, 'wholesale_stock_batch_id');
    }

    public function retailPurchase()
    {
        return $this->belongsTo(RetailPurchase::class, 'retail_purchase_id');
    }

    public function retailPurchaseItem()
    {
        return $this->belongsTo(RetailPurchaseItem::class, 'retail_purchase_item_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

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
    public function packets()
    {
        return $this->hasMany(ProductPacket::class);
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

    public function sellStoneItems()
    {
        return $this->hasMany(SellStoneItem::class, 'product_id');
    }

    public function sellDiamondItems()
    {
        return $this->hasMany(SellDiamondItem::class, 'product_id');
    }

    public function getPostCodeAttribute($value)
    {
        return str_pad($value, 4, '0', STR_PAD_LEFT);
    }
}
