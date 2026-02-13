<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class JournalEntryLine extends Model
{
    use BelongsToFirm;
    protected $fillable = ['journal_entry_id', 'account_id', 'debit', 'credit', 'memo'];

    public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
