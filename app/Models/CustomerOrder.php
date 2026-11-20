<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToFirm;

class CustomerOrder extends Model
{
    use HasFactory, SoftDeletes, BelongsToFirm;

    protected $fillable = [
        'admin_id',
        'firm_id',
        'customer_id',
        'order_no',
        'order_date',
        'due_date',
        'karigar_id',
        'status',
        'priority',
        'item_name',
        'category_id',
        'subcategory_id',
        'metal_type',
        'purity',
        'expected_gross_weight',
        'expected_net_weight',
        'size',
        'design_code',
        'image',
        'specifications',
        'estimated_rate',
        'estimated_making_charges',
        'estimated_other_charges',
        'estimated_total_amount',
        'advance_amount',
        'advance_metal_weight',
        'advance_payment_mode',
        'notes',
    ];

    protected $casts = [
        'order_date'             => 'date',
        'due_date'               => 'date',
        'expected_gross_weight'  => 'decimal:3',
        'expected_net_weight'    => 'decimal:3',
        'estimated_rate'         => 'decimal:2',
        'estimated_making_charges' => 'decimal:2',
        'estimated_other_charges'=> 'decimal:2',
        'estimated_total_amount' => 'decimal:2',
        'advance_amount'         => 'decimal:2',
        'advance_metal_weight'   => 'decimal:3',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function karigar()
    {
        return $this->belongsTo(Karigar::class, 'karigar_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'subcategory_id');
    }

    public function assignments()
    {
        return $this->hasMany(KarigarAssignment::class, 'customer_order_id')->latest();
    }

    public function latestAssignment()
    {
        return $this->hasOne(KarigarAssignment::class, 'customer_order_id')->latestOfMany();
    }

    public function receipts()
    {
        return $this->hasMany(KarigarReceipt::class, 'customer_order_id')->latest();
    }

    public function latestReceipt()
    {
        return $this->hasOne(KarigarReceipt::class, 'customer_order_id')->latestOfMany();
    }

    public function getBalanceAmountAttribute()
    {
        return max(0, (float)$this->estimated_total_amount - (float)$this->advance_amount);
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'pending'     => '<span class="badge bg-warning text-dark"><i class="fa fa-clock me-1"></i> Pending</span>',
            'assigned'    => '<span class="badge bg-info text-white"><i class="fa fa-user-tag me-1"></i> Assigned</span>',
            'in_progress' => '<span class="badge bg-primary text-white"><i class="fa fa-spinner fa-spin me-1"></i> In Progress</span>',
            'received'    => '<span class="badge bg-success text-white"><i class="fa fa-check-circle me-1"></i> Received</span>',
            'delivered'   => '<span class="badge bg-dark text-white"><i class="fa fa-gift me-1"></i> Delivered</span>',
            'cancelled'   => '<span class="badge bg-danger text-white"><i class="fa fa-times-circle me-1"></i> Cancelled</span>',
            default       => '<span class="badge bg-secondary">' . ucfirst($this->status) . '</span>',
        };
    }

    public function getPriorityBadgeAttribute()
    {
        return match ($this->priority) {
            'urgent' => '<span class="badge bg-danger">Urgent</span>',
            'high'   => '<span class="badge bg-warning text-dark">High</span>',
            'normal' => '<span class="badge bg-light text-dark border">Normal</span>',
            'low'    => '<span class="badge bg-light text-muted border">Low</span>',
            default  => '<span class="badge bg-secondary">' . ucfirst($this->priority) . '</span>',
        };
    }
}
