<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class RetailPurchasePacketItem extends Model
{
    use HasFactory, BelongsToFirm;

    protected $table = 'retail_purchase_packet_items';

    protected $fillable = [
        'admin_id',
        'firm_id',
        'retail_purchase_id',
        'retail_purchase_item_id',
        'packet_no',
        'packet_type',
        'pcs',
        'stone',
        'clarity',
        'color',
        'cut',
        'shape',
        'mm',
        'chalni',
        'solitaire',
        'rate',
        'amount',
        'weight',
        'wt_in_gram',
        'uom',
        'certificate_no',
    ];

    protected $casts = [
        'pcs'        => 'integer',
        'solitaire'  => 'boolean',
        'rate'       => 'float',
        'amount'     => 'float',
        'weight'     => 'float',
        'wt_in_gram' => 'float',
    ];

    public function purchase()
    {
        return $this->belongsTo(RetailPurchase::class, 'retail_purchase_id');
    }

    public function purchaseItem()
    {
        return $this->belongsTo(RetailPurchaseItem::class, 'retail_purchase_item_id');
    }
}
