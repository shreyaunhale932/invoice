<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToFirm;

class PacketMaster extends Model
{
    use HasFactory, SoftDeletes, BelongsToFirm;

    protected $guarded = ['id'];

    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }

    public function stone()
    {
        return $this->belongsTo(Stone::class);
    }

    public function clarity()
    {
        return $this->belongsTo(Clarity::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function cut()
    {
        return $this->belongsTo(Cut::class);
    }

    public function shape()
    {
        return $this->belongsTo(Shape::class);
    }

    public function mm()
    {
        return $this->belongsTo(Mm::class);
    }

    public function chalni()
    {
        return $this->belongsTo(Chalni::class);
    }
}
