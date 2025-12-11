<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class bankdetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'bankname', 'accno', 'holdername', 'branch','ifsc'
       
    ];

    
}
