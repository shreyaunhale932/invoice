<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class KarigarReceipt extends Model
{
    use HasFactory, BelongsToFirm;

    protected $fillable = [
        'admin_id',
        'firm_id',
        'customer_order_id',
        'karigar_assignment_id',
        'karigar_id',
        'receipt_no',
        'received_date',
        'finished_gross_weight',
        'finished_net_weight',
        'stones_weight',
        'stones_pieces',
        'scrap_metal_returned',
        'scrap_purity',
        'actual_wastage',
        'wastage_difference',
        'final_making_charges',
        'other_charges',
        'total_making_charges',
        'payment_status',
        'payment_date',
        'payment_mode',
        'huid',
        'qc_status',
        'remarks',
    ];

    protected $casts = [
        'received_date'         => 'date',
        'payment_date'          => 'date',
        'finished_gross_weight' => 'decimal:3',
        'finished_net_weight'   => 'decimal:3',
        'stones_weight'         => 'decimal:3',
        'stones_pieces'         => 'integer',
        'scrap_metal_returned'  => 'decimal:3',
        'actual_wastage'        => 'decimal:3',
        'wastage_difference'    => 'decimal:3',
        'final_making_charges'  => 'decimal:2',
        'other_charges'         => 'decimal:2',
        'total_making_charges'  => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(CustomerOrder::class, 'customer_order_id');
    }

    public function assignment()
    {
        return $this->belongsTo(KarigarAssignment::class, 'karigar_assignment_id');
    }

    public function karigar()
    {
        return $this->belongsTo(Karigar::class, 'karigar_id');
    }
}
