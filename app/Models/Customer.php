<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\BelongsToFirm;

class Customer extends Model
{
    use HasFactory, BelongsToFirm;

    protected $fillable = [
        'admin_id', 'name', 'email', 'phone',
        'address', 'country', 'state', 'city', 'pincode',
        'bank_name', 'branch', 'account_holder_name', 'account_number', 'ifsc',
        'gst_no', 'adhaar_no', 'pan_no', 'tan', 'dob', 'anniversary_date'
    ];
}


