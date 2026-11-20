<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class KarigarAssignment extends Model
{
    use HasFactory, BelongsToFirm;

    protected $fillable = [
        'admin_id',
        'firm_id',
        'customer_order_id',
        'karigar_id',
        'assignment_no',
        'assigned_date',
        'expected_delivery_date',
        'metal_issued_type',
        'metal_issued_weight',
        'metal_issued_purity',
        'stones_issued_weight',
        'stones_issued_pieces',
        'stones_issued_description',
        'making_charge_type',
        'making_charge_rate',
        'allowed_wastage_percent',
        'allowed_wastage_weight',
        'status',
        'instructions',
    ];

    protected $casts = [
        'assigned_date'           => 'date',
        'expected_delivery_date'  => 'date',
        'metal_issued_weight'     => 'decimal:3',
        'stones_issued_weight'    => 'decimal:3',
        'stones_issued_pieces'    => 'integer',
        'making_charge_rate'      => 'decimal:2',
        'allowed_wastage_percent' => 'decimal:2',
        'allowed_wastage_weight'  => 'decimal:3',
    ];

    public function order()
    {
        return $this->belongsTo(CustomerOrder::class, 'customer_order_id');
    }

    public function karigar()
    {
        return $this->belongsTo(Karigar::class, 'karigar_id');
    }

    public function receipt()
    {
        return $this->hasOne(KarigarReceipt::class, 'karigar_assignment_id');
    }

    public function receipts()
    {
        return $this->hasMany(KarigarReceipt::class, 'karigar_assignment_id');
    }
}
