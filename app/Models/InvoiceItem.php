<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Invoice;

// class InvoiceItem extends Model
// {
//     use HasFactory;

//     protected $fillable = ['invoice_id', 'product_name', 'quantity', 'rate', 'amount'];

//     public function invoice()
//     {
//         return $this->belongsTo(Invoice::class);
//     }
// }
class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'admin_id',
        'product_name',
        'quantity',
        'rate',
        'total',
        'hsn_code_id',
        'type',
        'discount',
        'tax',
        'cgst',
        'sgst',
        'igst',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function hsnCode()
    {
        return $this->belongsTo(HSNCode::class);
    }
    public function customFieldValues()
    {
        return $this->morphMany(CustomFieldValue::class, 'model');
    }
}
