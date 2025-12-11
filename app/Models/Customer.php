<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'name', 'email', 'phone',
        'address1', 'address2', 'country', 'state', 'city', 'pincode',
        'bank_name', 'branch', 'account_holder_name', 'account_number', 'ifsc'
    ];
}


