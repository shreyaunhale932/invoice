<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class SellInvoice extends Model
{
    use HasFactory, BelongsToFirm;

    protected $table = 'sell_invoices';

    protected $fillable = [
        'user_id',
        'admin_id',

        // GST
        'cgst_percent',
        'cgst_amount',
        'sgst_percent',
        'sgst_amount',
        'igst_percent',
        'igst_amount',

        // Metal totals
        'gold_total_amount',
        'silver_total_amount',
        'stone_total_amount',

        // Charges
        'making_charge',
        'other_charge',
        'other_tax_amount',
        'taxable_amount',
        'remaininng_amount',

        // Totals
        'total_amount_non_tax',
        'final_amount',

        // Discount
        'discount_percent',
        'discount_amount',

        // Payments
        'cash_received',
        'online_received',
        'bank_received',
        'total_received',
        'card_received',
        'amount_left',

        'total_making_charge',
        'making_discount_percent',
        'making_discount_amount',
        'total_diamond_stone_packet',
        'diamond_discount_percent',
        'diamond_discount_amount',
        'diamond_total_amount',
        'total_wastage_charge',
        'wastage_discount_percent',
        'wastage_discount_amount',

        // Invoice numbers
        'invoice_no',
        'invoice_date',
        'invoice_due_date',
        'per_invoice_no',
        'post_invoice_no',
        'total_exchange_amount',
        'status',
        'round_off',
    ];

    protected $casts = [
        'cgst_percent'         => 'float',
        'cgst_amount'          => 'float',
        'sgst_percent'         => 'float',
        'sgst_amount'          => 'float',

        'gold_total_amount'    => 'float',
        'silver_total_amount'  => 'float',
        'stone_total_amount'   => 'float',

        'making_charge'        => 'float',
        'other_charge'         => 'float',
        'other_tax_amount'     => 'float',

        'total_amount_non_tax' => 'float',
        'final_amount'         => 'float',

        'discount_percent'     => 'float',
        'discount_amount'      => 'float',
        'taxable_amount' => 'float',
        'remaining_amount' => 'float',

        'total_making_charge'    => 'float',
        'making_discount_percent' => 'float',
        'making_discount_amount'  => 'float',
        'total_diamond_stone_packet' => 'float',
        'diamond_discount_percent' => 'float',
        'diamond_discount_amount'  => 'float',
        'diamond_total_amount'     => 'float',

        'total_exchange_amount'    => 'float',

        'cash_received'        => 'float',
        'online_received'      => 'float',
        'bank_received'        => 'float',
        'total_received'       => 'float',
        'amount_left'          => 'float',

        'total_wastage_charge'     => 'float',
        'wastage_discount_percent' => 'float',
        'wastage_discount_amount'  => 'float',
        'round_off'                => 'float',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function stoneItems()
    {
        return $this->hasMany(SellStoneItem::class, 'sell_invoice_id');
    }
    public function diamondItems()
    {
        return $this->hasMany(SellDiamondItem::class, 'sell_invoice_id');
    }
      public function packetItems()
    {
        return $this->hasMany(SellPacketItem::class, 'sell_invoice_id');
    }

    public function exchangeItems()
    {
        return $this->hasMany(SellExchangeItem::class, 'sell_invoice_id');
    }

    public function exchangeDiamonds()
    {
        return $this->hasMany(SellExchangeDiamond::class, 'sell_invoice_id');
    }

    public function items()
    {
        return $this->hasMany(SellInvoiceItem::class, 'sell_invoice_id');
    }

    public function payments()
    {
        return $this->hasMany(SellInvoicePayment::class, 'sell_invoice_id');
    }
    // App\Models\SellInvoice.php
    protected static function booted()
    {
        static::creating(function ($invoice) {

            $last = self::orderBy('id', 'desc')->first();
            $number = $last ? intval(substr($last->invoice_no, 4)) + 1 : 1;

            $invoice->invoice_no = 'INV-' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class, 'invoice_id');
    }

    public function getRefundedAmountAttribute()
    {
        return $this->paymentTransactions()->where('transaction_type', 'refund')->sum('amount');
    }

    public function getCanBeRefundedAttribute()
    {
        // For invoices, we can refund up to the amount received
        return ($this->total_received - $this->refunded_amount) > 0;
    }
}
