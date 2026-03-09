<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class SellExchangeItem extends Model
{
    use HasFactory, BelongsToFirm;

    protected $table = 'sell_exchange_items';

    protected $fillable = [
        'sell_invoice_id',
        'admin_id',
        'firm_id',
        'description',
        'metal',
        'purity',
        'gross_weight',
        'less_weight',
        'net_weight',
        'fine_weight',
        'wanted_amt',
        'rate',
        'amount',
    ];

    protected $casts = [
        'gross_weight' => 'float',
        'less_weight'  => 'float',
        'net_weight'   => 'float',
        'fine_weight'  => 'float',
        'wanted_amt'   => 'float',
        'rate'         => 'float',
        'amount'       => 'float',
    ];

    public function invoice()
    {
        return $this->belongsTo(SellInvoice::class, 'sell_invoice_id');
    }
}
