<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountGroup;
use App\Models\Account;

class AccountingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Main Groups
        $assets = AccountGroup::create(['name' => 'Assets', 'type' => 'Asset']);
        $liabilities = AccountGroup::create(['name' => 'Liabilities', 'type' => 'Liability']);
        $income = AccountGroup::create(['name' => 'Income', 'type' => 'Income']);
        $expense = AccountGroup::create(['name' => 'Expenses', 'type' => 'Expense']);

        // 2. Assets Accounts
        Account::create(['name' => 'Stock', 'account_group_id' => $assets->id]);
        Account::create(['name' => 'Cash in Hand', 'account_group_id' => $assets->id]);
        Account::create(['name' => 'Bank', 'account_group_id' => $assets->id]);
        Account::create(['name' => 'UPI Clearing', 'account_group_id' => $assets->id]);
        Account::create(['name' => 'Card Receivable', 'account_group_id' => $assets->id]);
        Account::create(['name' => 'Sundry Debtors', 'account_group_id' => $assets->id]);

        // 3. Liabilities Accounts
        Account::create(['name' => 'Capital', 'account_group_id' => $liabilities->id]);
        Account::create(['name' => 'GST Output CGST', 'account_group_id' => $liabilities->id]);
        Account::create(['name' => 'GST Output SGST', 'account_group_id' => $liabilities->id]);

        // 4. Income Accounts
        Account::create(['name' => 'Jewellery Sales', 'account_group_id' => $income->id]);
        Account::create(['name' => 'Gold Sales', 'account_group_id' => $income->id]);
        Account::create(['name' => 'Silver Sales', 'account_group_id' => $income->id]);
        Account::create(['name' => 'Diamond Sales', 'account_group_id' => $income->id]);
        Account::create(['name' => 'Stone Sales', 'account_group_id' => $income->id]);

        // 5. Expense Accounts
        Account::create(['name' => 'Bank / Card Charges', 'account_group_id' => $expense->id]);
        Account::create(['name' => 'Discount Allowed', 'account_group_id' => $expense->id]);
    }
}
