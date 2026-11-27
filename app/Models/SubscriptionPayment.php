<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPayment extends Model
{
    protected $connection = 'landlord';

    protected $fillable = [
        'admin_subscription_id',
        'cashfree_payment_id',
        'payment_type',
        'amount',
        'currency',
        'status',
        'payment_method',
        'paid_at',
        'webhook_event_id',
        'webhook_payload',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
            'webhook_payload' => 'array',
        ];
    }

    public function subscription()
    {
        return $this->belongsTo(
            AdminSubscription::class,
            'admin_subscription_id'
        );
    }
    public function invoice()
    {
        return $this->hasOne(
            SubscriptionInvoice::class,
            'subscription_payment_id'
        );
    }
}
