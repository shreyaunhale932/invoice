<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionInvoice extends Model
{
    protected $connection = 'landlord';

    protected $fillable = [
        'admin_subscription_id',
        'subscription_payment_id',
        'invoice_number',
        'customer_name',
        'customer_email',
        'customer_gstin',
        'billing_address',
        'place_of_supply',
        'taxable_amount',
        'cgst_amount',
        'sgst_amount',
        'igst_amount',
        'gst_rate',
        'total_amount',
        'currency',
        'status',
        'issued_at',
        'email_sent_at',
        'pdf_path',
    ];

    protected function casts(): array
    {
        return [
            'taxable_amount' => 'decimal:2',
            'cgst_amount' => 'decimal:2',
            'sgst_amount' => 'decimal:2',
            'igst_amount' => 'decimal:2',
            'gst_rate' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'issued_at' => 'datetime',
            'email_sent_at' => 'datetime',
        ];
    }

    public function subscription()
    {
        return $this->belongsTo(
            AdminSubscription::class,
            'admin_subscription_id'
        );
    }

    public function payment()
    {
        return $this->belongsTo(
            SubscriptionPayment::class,
            'subscription_payment_id'
        );
    }
}

