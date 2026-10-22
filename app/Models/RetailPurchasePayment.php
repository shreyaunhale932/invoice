<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class RetailPurchasePayment extends Model
{
    use HasFactory, BelongsToFirm;

    protected $table = 'retail_purchase_payments';

    protected $fillable = [
        'firm_id',
        'retail_purchase_id',
        'account_id',
        'payment_method',
        'amount',
        'metal_weight',
        'metal_purity',
        'metal_fine_wt',
        'metal_rate',
        'reference_no',
        'payment_details',
        'transaction_date',
    ];

    protected $casts = [
        'amount'             => 'float',
        'metal_weight'       => 'float',
        'metal_purity'       => 'float',
        'metal_fine_wt'      => 'float',
        'metal_rate'         => 'float',
        'retail_purchase_id' => 'integer',
        'account_id'         => 'integer',
        'firm_id'            => 'integer',
        'transaction_date'   => 'date',
    ];

    public function purchase()
    {
        return $this->belongsTo(RetailPurchase::class, 'retail_purchase_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
