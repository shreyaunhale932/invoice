<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToFirm;

class Chalni extends Model
{
    use HasFactory, SoftDeletes, BelongsToFirm;

    protected $table = 'chalnis';
    protected $guarded = ['id'];
}
