<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class SellInvoicePayment extends Model
{
    use BelongsToFirm;

    protected $table = 'sell_invoice_payments';

    protected $fillable = [
        'firm_id',
        'sell_invoice_id',
        'account_id',
        'payment_method',
        'amount',
        'reference_no',
        'payment_details',
        'transaction_date',
    ];

    protected $casts = [
        'amount' => 'float',
        'sell_invoice_id' => 'integer',
        'account_id' => 'integer',
        'firm_id' => 'integer',
    ];

    public function invoice()
    {
        return $this->belongsTo(SellInvoice::class, 'sell_invoice_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
