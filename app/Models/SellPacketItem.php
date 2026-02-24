<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellPacketItem extends Model
{
    use SoftDeletes;

    protected $table = 'sell_packet_items';

    protected $fillable = [
        'sell_invoice_id',
        'sell_invoice_item_id',
        'packet_no',
        'pcs',
        'stone',
        'clarity',
        'color',
        'cut',
        'shape',
        'chalni',
        'mm',
        'solitaire',
        'rate',
        'amount',
        'weight',
        'wt_in_gram',
        'uom',
        'certificate_no',
    ];

    protected $casts = [
        'pcs'          => 'integer',
        'solitaire'    => 'boolean',
        'rate'         => 'decimal:2',
        'amount'       => 'decimal:2',
        'weight'       => 'decimal:3',
        'wt_in_gram'   => 'decimal:3',
    ];

    protected $dates = [
        'deleted_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function sellInvoice()
    {
        return $this->belongsTo(SellInvoice::class, 'sell_invoice_id');
    }

    /**
     * Diamond belongs to Product
     */
   public function invoiceItem()
{
    return $this->belongsTo(SellInvoiceItem::class, 'sell_invoice_item_id');
}
}
