<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellStoneItem extends Model
{
    protected $table = 'sell_stone_items';

    protected $fillable = [
        'sell_invoice_id',
        'product_id',
        'stone_name',
        'stone_weight',
        'stone_price',
        'stone_final_price',
        'pieces',
        'remark',
    ];

    /**
     * Stone belongs to Sell Invoice
     */
    public function sellInvoice()
    {
        return $this->belongsTo(SellInvoice::class, 'sell_invoice_id');
    }

    /**
     * Stone belongs to Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
