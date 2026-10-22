<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class RetailPurchaseItem extends Model
{
    use HasFactory, BelongsToFirm;

    protected $table = 'retail_purchase_items';

    protected $fillable = [
        'admin_id',
        'firm_id',
        'retail_purchase_id',
        'product_id',
        'item_product_data_id',
        'category_id',
        'subcategory_id',
        'purity_id',
        'item_name',
        'pre_code',
        'post_code',
        'barcode',
        'quantity',
        'unit',
        'size',
        'gross_weight',
        'stone_weight',
        'diamond_weight',
        'net_weight',
        'wastage_percent',
        'final_fn_weight',
        'purchase_rate',
        'metal_amount',
        'making_price',
        'making_type',
        'making_final_amount',
        'stone_amount',
        'diamond_amount',
        'packet_amount',
        'packet_weight',
        'discount_amount',
        'gst_percent',
        'gst_amount',
        'total_amount',
    ];

    protected $casts = [
        'quantity'            => 'float',
        'gross_weight'        => 'float',
        'stone_weight'        => 'float',
        'diamond_weight'      => 'float',
        'packet_weight'       => 'float',
        'net_weight'          => 'float',
        'wastage_percent'     => 'float',
        'final_fn_weight'     => 'float',
        'purchase_rate'       => 'float',
        'metal_amount'        => 'float',
        'making_price'        => 'float',
        'making_final_amount' => 'float',
        'stone_amount'        => 'float',
        'diamond_amount'      => 'float',
        'packet_amount'       => 'float',
        'discount_amount'     => 'float',
        'gst_percent'         => 'float',
        'gst_amount'          => 'float',
        'total_amount'        => 'float',
    ];

    public function purchase()
    {
        return $this->belongsTo(RetailPurchase::class, 'retail_purchase_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function itemProductData()
    {
        return $this->belongsTo(ItemProductData::class, 'item_product_data_id');
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

    public function packetItems()
    {
        return $this->hasMany(RetailPurchasePacketItem::class, 'retail_purchase_item_id');
    }
}
