<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'customer_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'total_amount',
        'status',
        'notes',
        'terms',
        'uuid'
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }




    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }


    protected static function booted()
    {
        static::creating(function ($invoice) {
            $invoice->uuid = Str::uuid();
        });
    }

    public function bank()
    {
        return $this->hasOne(bankdetails::class, 'user_id', 'admin_id');
    }


    public function business()
    {
        return $this->belongsTo(BusinessDetail::class, 'user_id'); // Adjust column name if different
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'admin_id'); // Adjust column name if different
    }
    public function customFieldValues()
    {
        return $this->morphMany(CustomFieldValue::class, 'model');
    }
}
