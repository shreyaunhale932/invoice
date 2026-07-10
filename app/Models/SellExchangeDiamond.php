<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class SellExchangeDiamond extends Model
{
    use HasFactory, BelongsToFirm;

    protected $table = 'sell_exchange_diamonds';

    protected $fillable = [
        'sell_invoice_id',
        'admin_id',
        'firm_id',
        'description',
        'clarity',
        'cut',
        'color',
        'pieces',
        'weight',
        'rate',
        'amount',
    ];

    protected $casts = [
        'pieces' => 'integer',
        'weight' => 'float',
        'rate'   => 'float',
        'amount' => 'float',
    ];

    public function invoice()
    {
        return $this->belongsTo(SellInvoice::class, 'sell_invoice_id');
    }
}
