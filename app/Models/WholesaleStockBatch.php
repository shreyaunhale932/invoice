<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class WholesaleStockBatch extends Model
{
    use HasFactory, BelongsToFirm;

    protected $table = 'wholesale_stock_batches';

    protected $fillable = [
        'admin_id',
        'firm_id',
        'wholesale_stock_id',
        'retail_purchase_id',
        'retail_purchase_item_id',
        'supplier_id',
        'purchase_date',
        'purchase_rate',
        'making_price',
        'making_type',
        'wastage_percent',
        'sale_price',
        'initial_quantity',
        'remaining_quantity',
        'initial_gross_weight',
        'remaining_gross_weight',
        'initial_net_weight',
        'remaining_net_weight',
        'initial_fine_weight',
        'remaining_fine_weight',
    ];

    protected $casts = [
        'purchase_date'          => 'date',
        'purchase_rate'          => 'float',
        'making_price'           => 'float',
        'initial_quantity'       => 'float',
        'remaining_quantity'     => 'float',
        'initial_gross_weight'   => 'float',
        'remaining_gross_weight' => 'float',
        'initial_net_weight'     => 'float',
        'remaining_net_weight'   => 'float',
        'initial_fine_weight'    => 'float',
        'remaining_fine_weight'  => 'float',
    ];

    public function wholesaleStock()
    {
        return $this->belongsTo(WholesaleStock::class, 'wholesale_stock_id');
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

    public function products()
    {
        return $this->hasMany(Product::class, 'wholesale_stock_batch_id');
    }
}
