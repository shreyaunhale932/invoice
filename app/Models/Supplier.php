<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BelongsToFirm;

class Supplier extends Model
{
    use HasFactory, BelongsToFirm;

    protected $fillable = [
        'admin_id',
        'firm_id',
        'name',
        'shop_name',
        'gst_no',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'pincode',
        'bank_name',
        'branch',
        'account_number',
        'ifsc_code',
        'adhar_card',
        'pan_card',
    ];

    public function retailPurchases()
    {
        return $this->hasMany(RetailPurchase::class, 'supplier_id');
    }
}
