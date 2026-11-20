<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToFirm;

class Karigar extends Model
{
    use HasFactory, SoftDeletes, BelongsToFirm;

    protected $fillable = [
        'admin_id',
        'firm_id',
        'code',
        'name',
        'shop_name',
        'phone',
        'email',
        'speciality',
        'address',
        'city',
        'state',
        'pincode',
        'pan_card',
        'adhar_card',
        'bank_name',
        'branch',
        'account_number',
        'ifsc_code',
        'opening_metal_balance',
        'opening_amount_balance',
        'current_metal_balance',
        'status',
        'notes',
    ];

    protected $casts = [
        'opening_metal_balance'  => 'decimal:3',
        'opening_amount_balance' => 'decimal:2',
        'current_metal_balance'  => 'decimal:3',
    ];

    public function assignments()
    {
        return $this->hasMany(KarigarAssignment::class, 'karigar_id');
    }

    public function receipts()
    {
        return $this->hasMany(KarigarReceipt::class, 'karigar_id');
    }

    public function orders()
    {
        return $this->hasMany(CustomerOrder::class, 'karigar_id');
    }

    public function activeAssignments()
    {
        return $this->hasMany(KarigarAssignment::class, 'karigar_id')
            ->whereIn('status', ['assigned', 'in_progress']);
    }
}
