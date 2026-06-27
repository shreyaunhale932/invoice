<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class Account extends Model
{
    use BelongsToFirm;
    protected $fillable = ['name', 'code', 'account_group_id', 'opening_balance', 'admin_id', 'sub_type', 'opening_balance_type', 'is_system'];

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
        $isDebitNormal = in_array($type, ['Asset', 'Expense']);

        $openingDr = $this->opening_balance_type === 'dr' ? $this->opening_balance : 0;
        $openingCr = $this->opening_balance_type === 'cr' ? $this->opening_balance : 0;

        if ($isDebitNormal) {
            return ($openingDr - $openingCr) + $debits - $credits;
        } else {
            return ($openingCr - $openingDr) + $credits - $debits;
        }
    }
}
