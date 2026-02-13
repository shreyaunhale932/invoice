<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Firm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'logo',
        'gstin',
        'pan',
        'email',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'postalcode',
        'is_default',
        'status',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    /**
     * Get the products for the firm.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the invoices for the firm.
     */
    public function sellInvoices()
    {
        return $this->hasMany(SellInvoice::class);
    }

    /**
     * Get the expenses for the firm.
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
