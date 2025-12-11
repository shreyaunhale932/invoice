<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class BusinessDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'business_name', 'logo', 'gstin', 'pan',
        'address', 'country', 'state', 'city', 'postalcode',
        'contact_number', 'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}