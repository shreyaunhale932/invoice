<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $fillable = ['entry_date', 'narration', 'reference_type', 'reference_id', 'admin_id'];

    public function lines()
    {
        return $this->hasMany(JournalEntryLine::class);
    }

    public function reference()
    {
        return $this->morphTo();
    }
}
