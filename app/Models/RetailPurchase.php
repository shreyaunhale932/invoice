<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToFirm;

class RetailPurchase extends Model
{
    use HasFactory, BelongsToFirm, SoftDeletes;

    protected $table = 'retail_purchases';

    protected $fillable = [
        'admin_id',
        'firm_id',
        'supplier_id',
        'purchase_no',
        'reference_no',
        'purchase_date',
        'due_date',
        'status',
        'subtotal',
        'discount_percent',
        'discount_amount',
        'taxable_amount',
        'cgst_percent',
        'cgst_amount',
        'sgst_percent',
        'sgst_amount',
        'igst_percent',
        'igst_amount',
        'other_charges',
        'round_off',
        'grand_total',
        'paid_amount',
        'payment_status',
        'payment_method',
        'gold_payment_grams',
        'gold_payment_purity',
        'gold_payment_fine_wt',
        'gold_payment_rate',
        'gold_payment_amount',
        'remaining_metal_wt',
        'remaining_metal_amount',
        'notes',
    ];

    protected $casts = [
        'purchase_date'          => 'date',
        'due_date'               => 'date',
        'subtotal'               => 'float',
        'discount_percent'       => 'float',
        'discount_amount'        => 'float',
        'taxable_amount'         => 'float',
        'cgst_percent'           => 'float',
        'cgst_amount'            => 'float',
        'sgst_percent'           => 'float',
        'sgst_amount'            => 'float',
        'igst_percent'           => 'float',
        'igst_amount'            => 'float',
        'other_charges'          => 'float',
        'round_off'              => 'float',
        'grand_total'            => 'float',
        'paid_amount'            => 'float',
        'gold_payment_grams'     => 'float',
        'gold_payment_purity'    => 'float',
        'gold_payment_fine_wt'   => 'float',
        'gold_payment_rate'      => 'float',
        'gold_payment_amount'    => 'float',
        'remaining_metal_wt'     => 'float',
        'remaining_metal_amount' => 'float',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function items()
    {
        return $this->hasMany(RetailPurchaseItem::class, 'retail_purchase_id');
    }

    public function packetItems()
    {
        return $this->hasMany(RetailPurchasePacketItem::class, 'retail_purchase_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function payments()
    {
        return $this->hasMany(RetailPurchasePayment::class, 'retail_purchase_id');
    }
}
