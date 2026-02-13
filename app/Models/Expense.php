<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class Expense extends Model
{
    use BelongsToFirm;
    protected $fillable = [
        'expense_date',
        'amount',
        'expense_account_id',
        'payment_account_id',
        'description',
        'admin_id'
    ];

    public function expenseAccount()
    {
        return $this->belongsTo(Account::class, 'expense_account_id');
    }

    public function paymentAccount()
    {
        return $this->belongsTo(Account::class, 'payment_account_id');
    }
}
