<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToFirm;

class Mm extends Model
{
    use HasFactory, SoftDeletes, BelongsToFirm;

    protected $table = 'mms';
    protected $guarded = ['id'];
}
