<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['name', 'code', 'account_group_id', 'opening_balance', 'admin_id'];

    public function group()
    {
        return $this->belongsTo(AccountGroup::class, 'account_group_id');
    }

    public function entryLines()
    {
        return $this->hasMany(JournalEntryLine::class);
    }

    public function getBalanceAttribute()
    {
        $debits = $this->entryLines()->sum('debit');
        $credits = $this->entryLines()->sum('credit');
        
        // For Assets and Expenses: Balance = Dr - Cr
        // For Liabilities, Equity, and Income: Balance = Cr - Dr
        $type = $this->group->type;
        if (in_array($type, ['Asset', 'Expense'])) {
            return $this->opening_balance + $debits - $credits;
        } else {
            return $this->opening_balance + $credits - $debits;
        }
    }
}
