<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class SellInvoiceItem extends Model
{
    use HasFactory, BelongsToFirm;

    protected $table = 'sell_invoice_items';

    protected $fillable = [
        'admin_id',
        'sell_invoice_id',
        'product_id',
        'category',
        'subcategory',

        'item_name',
        // 'product_name',
        'pre_code',
        'post_code',
        'barcode',
        'purity',
        'quantity',
        'size',

        // Weights
        'gross_weight',
        'net_weight',
        'final_fn_weight',

        // Amounts
        'metal_rate',
        'gold_amount',
        'diamond_amount',
        'stone_amount',
        'packet_amount',
        'making_charges',
        'making_price',
        'making_type',
        'making_final_amount',
        'wastage_percent',
        'other_charges',
        'total_amount',

        'user_id',
        'admin_id',
        'final_price',
        'wastage_amount',
        // 'gst_percent',
        // 'gst_amount',
    ];

    protected $casts = [
        'gross_weight'    => 'float',
        'net_weight'      => 'float',
        'final_fn_weight'     => 'float',

        'metal_rate'      => 'float',
        'gold_amount'     => 'float',
        'diamond_amount'  => 'float',
        'stone_amount'    => 'float',
        'packet_amount'    => 'float',
        'making_charges'  => 'float',
        'other_charges'   => 'float',
        'total_amount'    => 'float',
        'wastage_amount'  => 'float',
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

    public function packets()
    {
        return $this->hasMany(SellPacketItem::class, 'sell_invoice_item_id');
    }

    public function getPostCodeAttribute($value)
    {
        return str_pad($value, 4, '0', STR_PAD_LEFT);
    }
}
