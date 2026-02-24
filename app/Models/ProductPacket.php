<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductPacket extends Model
{
    use HasFactory;
      use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function packetMaster()
    {
        return $this->belongsTo(PacketMaster::class);
    }

    // Relationships for attributes (optional, useful for displaying names)
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

    public function chalni()
    {
        return $this->belongsTo(Chalni::class);
    }

    public function mm()
    {
        return $this->belongsTo(Mm::class);
    }
}
