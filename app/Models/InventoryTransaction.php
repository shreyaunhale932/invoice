<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class InventoryTransaction extends Model
{
    use BelongsToFirm;
    protected $fillable = [
        'product_id',
        'item_product_data_id',
        'wholesale_stock_id',
        'wholesale_stock_batch_id',
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
        'size',
        'sell_invoice_id',
        'sell_invoice_item_id',
        'retail_purchase_id',
        'retail_purchase_item_id'
    ];

    public function wholesaleStock()
    {
        return $this->belongsTo(WholesaleStock::class, 'wholesale_stock_id');
    }

    public function wholesaleStockBatch()
    {
        return $this->belongsTo(WholesaleStockBatch::class, 'wholesale_stock_batch_id');
    }

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

    public function retailPurchase()
    {
        return $this->belongsTo(RetailPurchase::class, 'retail_purchase_id');
    }

    public function retailPurchaseItem()
    {
        return $this->belongsTo(RetailPurchaseItem::class, 'retail_purchase_item_id');
    }
}
