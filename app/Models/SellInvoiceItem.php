<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellInvoiceItem extends Model
{
    use HasFactory;

    protected $table = 'sell_invoice_items';

    protected $fillable = [
        'admin_id',
        'sell_invoice_id',
        'product_id',

        'item_name',
        // 'product_name',
        'pre_code',
        'post_code',
        'barcode',
        'purity',

        // Weights
        'gross_weight',
        'net_weight',
        'fine_weight',

        // Amounts
        'metal_rate',
        'gold_amount',
        'diamond_amount',
        'stone_amount',
        'making_charges',
        'other_charges',
        'total_amount',

        'user_id',
        'admin_id',
        'final_price',
    ];

    protected $casts = [
        'gross_weight'    => 'float',
        'net_weight'      => 'float',
        'fine_weight'     => 'float',

        'metal_rate'      => 'float',
        'gold_amount'     => 'float',
        'diamond_amount'  => 'float',
        'stone_amount'    => 'float',
        'making_charges'  => 'float',
        'other_charges'   => 'float',
        'total_amount'    => 'float',
    ];

    /**
     * Relationships
     */
    public function sellInvoice()
    {
        return $this->belongsTo(SellInvoice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function diamonds()
    {
        return $this->hasMany(SellDiamondItem::class, 'sell_invoice_item_id');
    }

    public function stones()
    {
        return $this->hasMany(SellStoneItem::class, 'sell_invoice_item_id');
    }
}
