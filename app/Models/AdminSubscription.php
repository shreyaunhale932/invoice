<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSubscription extends Model
{
    protected $connection = 'landlord';
    protected $fillable = [
        'admin_id',
        'plan_name',
        'billing_cycle',
        'amount',
        'currency',
        'cashfree_plan_id',
        'cashfree_subscription_id',
        'cf_subscription_id',
        'subscription_session_id',
        'cashfree_status',
        'authorization_status',
        'next_schedule_date',
        'status',
        'started_at',
        'ends_at',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'started_at' => 'datetime',
            'ends_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'next_schedule_date' => 'datetime',
        ];
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function payments()
    {
        return $this->hasMany(SubscriptionPayment::class);
    }
    public function invoices()
    {
        return $this->hasMany(
            SubscriptionInvoice::class,
            'admin_subscription_id'
        );
    }
}
