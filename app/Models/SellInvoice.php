<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellInvoice extends Model
{
    use HasFactory;

    protected $table = 'sell_invoices';

    protected $fillable = [
        'user_id',
        'admin_id',

        // GST
        'cgst_percent',
        'cgst_amount',
        'sgst_percent',
        'sgst_amount',

        // Metal totals
        'gold_total_amount',
        'silver_total_amount',
        'stone_total_amount',

        // Charges
        'making_charge',
        'other_charge',
        'other_tax_amount',

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
        'amount_left',

        // Invoice numbers
        'invoice_no',
        'invoice_date',
        'invoice_due_date',
        'per_invoice_no',
        'post_invoice_no',
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

        'cash_received'        => 'float',
        'online_received'      => 'float',
        'bank_received'        => 'float',
        'total_received'       => 'float',
        'amount_left'          => 'float',
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
    // App\Models\SellInvoice.php
    protected static function booted()
    {
        static::creating(function ($invoice) {

            $last = self::orderBy('id', 'desc')->first();
            $number = $last ? intval(substr($last->invoice_no, 4)) + 1 : 1;

            $invoice->invoice_no = 'INV-' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }
}
