<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToFirm;

class WholesaleStock extends Model
{
    use HasFactory, SoftDeletes, BelongsToFirm;

    protected $table = 'wholesale_stocks';

    protected $fillable = [
        'admin_id',
        'firm_id',
        'item_product_data_id',
        'category_id',
        'subcategory_id',
        'purity_id',
        'item_name',
        'pre_code',
        'total_quantity',
        'available_quantity',
        'total_gross_weight',
        'available_gross_weight',
        'total_net_weight',
        'available_net_weight',
        'total_fine_weight',
        'available_fine_weight',
    ];

    protected $casts = [
        'total_quantity'         => 'float',
        'available_quantity'     => 'float',
        'total_gross_weight'     => 'float',
        'available_gross_weight' => 'float',
        'total_net_weight'       => 'float',
        'available_net_weight'   => 'float',
        'total_fine_weight'      => 'float',
        'available_fine_weight'  => 'float',
    ];

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

    public function batches()
    {
        return $this->hasMany(WholesaleStockBatch::class, 'wholesale_stock_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'wholesale_stock_id');
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'wholesale_stock_id');
    }
}
