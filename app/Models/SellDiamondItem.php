<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellDiamondItem extends Model
{
    protected $table = 'sell_diamond_items';

    protected $fillable = [
        'sell_invoice_id',
        'product_id',
        'clarity',
        'cut',
        'color',
        'pieces',
        'diamond_weight',
        'price_per_carat',
        'diamond_final_price',
        'remark',
    ];

    /**
     * Diamond belongs to Sell Invoice
     */
    public function sellInvoice()
    {
        return $this->belongsTo(SellInvoice::class, 'sell_invoice_id');
    }

    /**
     * Diamond belongs to Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
