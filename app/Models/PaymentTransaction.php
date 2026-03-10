<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use \App\Traits\BelongsToFirm;

    protected $fillable = [
        'firm_id', 'customer_id', 'invoice_id', 'parent_id', 'amount',
        'transaction_type', 'payment_method', 'transaction_date',
        'reference_no', 'narration', 'status', 'user_id', 'admin_id'
    ];

    public function parent()
    {
        return $this->belongsTo(PaymentTransaction::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(PaymentTransaction::class, 'parent_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function invoice()
    {
        return $this->belongsTo(SellInvoice::class, 'invoice_id');
    }

    public function getRefundedAmountAttribute()
    {
        return $this->children()->whereIn('transaction_type', ['refund', 'udhaar_return'])->sum('amount');
    }

    public function canBeRefunded()
    {
        if (in_array($this->transaction_type, ['refund', 'udhaar_return'])) return false;
        return ($this->amount - $this->refunded_amount) > 0;
    }
}
