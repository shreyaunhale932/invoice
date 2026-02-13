<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BelongsToFirm;

class Client extends Model
{
    use HasFactory, BelongsToFirm;

    protected $fillable = ['name', 'email', 'phone', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
