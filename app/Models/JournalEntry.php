<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class JournalEntry extends Model
{
    use BelongsToFirm;
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
