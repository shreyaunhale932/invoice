<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountGroup;
use App\Models\Account;
use App\Models\Firm;

class AccountingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure at least one firm exists
        if (Firm::count() === 0) {
            Firm::create([
                'name' => 'Default Firm',
                'gstin' => '22AAAAA0000A1Z5', // Dummy GSTIN
                // Add other required fields if necessary, or rely on defaults/nullable
            ]);
        }

        $firms = Firm::all();

        foreach ($firms as $firm) {
            $this->seedAccountsForFirm($firm);
        }
    }

    private function seedAccountsForFirm(Firm $firm)
    {
        $firmId = $firm->id;

        // Check if accounts already exist for this firm to prevent duplication
        // (Optional, but good practice for seeders)
        if (AccountGroup::where('firm_id', $firmId)->exists()) {
            return;
        }

        // 1. Create Main Groups with firm_id
        $assets = AccountGroup::create(['name' => 'Assets', 'type' => 'Asset', 'firm_id' => $firmId]);
        $liabilities = AccountGroup::create(['name' => 'Liabilities', 'type' => 'Liability', 'firm_id' => $firmId]);
        $income = AccountGroup::create(['name' => 'Income', 'type' => 'Income', 'firm_id' => $firmId]);
        $expense = AccountGroup::create(['name' => 'Expenses', 'type' => 'Expense', 'firm_id' => $firmId]);

        // 2. Assets Accounts
        Account::create(['name' => 'Stock', 'account_group_id' => $assets->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Cash in Hand', 'account_group_id' => $assets->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Bank', 'account_group_id' => $assets->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'UPI Clearing', 'account_group_id' => $assets->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Card Receivable', 'account_group_id' => $assets->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Sundry Debtors', 'account_group_id' => $assets->id, 'firm_id' => $firmId]);

        // 3. Liabilities Accounts
        Account::create(['name' => 'Capital', 'account_group_id' => $liabilities->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'GST Output CGST', 'account_group_id' => $liabilities->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'GST Output SGST', 'account_group_id' => $liabilities->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'GST Output IGST', 'account_group_id' => $liabilities->id, 'firm_id' => $firmId]);

        // 4. Income Accounts
        Account::create(['name' => 'Jewellery Sales', 'account_group_id' => $income->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Gold Sales', 'account_group_id' => $income->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Silver Sales', 'account_group_id' => $income->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Diamond Sales', 'account_group_id' => $income->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Stone Sales', 'account_group_id' => $income->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Packet Sales', 'account_group_id' => $income->id, 'firm_id' => $firmId]);

        // 5. Expense Accounts
        Account::create(['name' => 'Office Rent', 'account_group_id' => $expense->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Electricity Bill', 'account_group_id' => $expense->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Salary', 'account_group_id' => $expense->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Miscellaneous', 'account_group_id' => $expense->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Bank / Card Charges', 'account_group_id' => $expense->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Discount Allowed', 'account_group_id' => $expense->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Dia/St/Pkt Discount Allowed', 'account_group_id' => $expense->id, 'firm_id' => $firmId]);
        Account::create(['name' => 'Making Discount Allowed', 'account_group_id' => $expense->id, 'firm_id' => $firmId]);
    }
}
