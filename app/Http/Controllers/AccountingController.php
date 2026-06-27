<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AccountingService;
use App\Models\SellInvoice;
use App\Models\JournalEntry;
use App\Models\JournalEntryLine;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    protected $accountingService;

    public function __construct(AccountingService $accountingService)
    {
        $this->accountingService = $accountingService;
    }

    /**
     * Resync all journal entries.
     * Deletes all and recreates from products and invoices.
     */
    public function syncAll()
    {
        try {
            $this->accountingService->syncAll();
            return response()->json([
                'success' => true,
                'message' => 'Accounting data resynced successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error("Accounting Sync Failed: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Manually post an invoice to accounting.
     */
    public function postInvoice($id)
    {
        try {
            $invoice = SellInvoice::with('items')->findOrFail($id);
            
            // Delete existing entry for this invoice
            JournalEntry::where('reference_type', SellInvoice::class)
                ->where('reference_id', $invoice->id)
                ->delete();

            $this->accountingService->postSellInvoice($invoice);

            return response()->json([
                'success' => true,
                'message' => "Invoice #{$invoice->invoice_no} posted successfully."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Post failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Trial Balance Report
     */
    public function trialBalance(Request $request)
    {
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $data = $this->accountingService->getTrialBalance($fromDate, $toDate);
        $report = $data['report'];
        $totalDebit = $data['totalDebit'];
        $totalCredit = $data['totalCredit'];

        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('accounting.trial-balance', compact('report', 'totalDebit', 'totalCredit', 'fromDate', 'toDate'));
    }

    /**
     * Profit and Loss Statement
     */
    public function profitAndLoss(Request $request)
    {
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $data = $this->accountingService->getProfitAndLoss($fromDate, $toDate);
        
        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('accounting.profit-loss', array_merge($data, ['fromDate' => $fromDate, 'toDate' => $toDate]));
    }

    /**
     * Balance Sheet Report
     */
    public function balanceSheet(Request $request)
    {
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $data = $this->accountingService->getBalanceSheet($fromDate, $toDate);

        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('accounting.balance-sheet', array_merge($data, ['fromDate' => $fromDate, 'toDate' => $toDate]));
    }

    /**
     * Individual Account Ledger
     */
    public function ledger(Request $request, $id)
    {
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $data = $this->accountingService->getAccountLedger($id, $fromDate, $toDate);

        return view('accounting.ledger', array_merge($data, ['fromDate' => $fromDate, 'toDate' => $toDate]));
    }

    /**
     * Chart of Accounts (Entry point for Ledgers)
     */
    public function chartOfAccounts()
    {
        $accounts = Account::with('group')->orderBy('name')->get();
        return view('accounting.chart-of-accounts', compact('accounts'));
    }

    /**
     * Store a new custom account
     */
    public function storeAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'account_type' => 'required|in:Asset,Liability,Expense,Income',
            'sub_type' => 'required|in:bank,card,upi,normal',
            'opening_balance' => 'required|numeric|min:0',
            'opening_balance_type' => 'required|in:dr,cr',
        ]);

        $group = \App\Models\AccountGroup::where('type', $request->account_type)->first();
        if (!$group) {
            return response()->json([
                'success' => false,
                'message' => 'Account group not found for this type.'
            ], 400);
        }

        $exists = Account::where('name', $request->name)->exists();
        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'An account with this name already exists.'
            ], 422);
        }

        $account = Account::create([
            'name' => $request->name,
            'account_group_id' => $group->id,
            'sub_type' => $request->sub_type,
            'opening_balance' => $request->opening_balance,
            'opening_balance_type' => $request->opening_balance_type,
            'is_system' => false,
            'admin_id' => auth()->id() ?? 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Account created successfully.',
            'account' => $account
        ]);
    }

    /**
     * Update an account
     */
    public function updateAccount(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'sub_type' => 'required|in:bank,card,upi,normal',
            'opening_balance' => 'required|numeric|min:0',
            'opening_balance_type' => 'required|in:dr,cr',
        ];

        if (!$account->is_system) {
            $rules['account_type'] = 'required|in:Asset,Liability,Expense,Income';
        }

        $request->validate($rules);

        $exists = Account::where('name', $request->name)->where('id', '!=', $id)->exists();
        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'An account with this name already exists.'
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'sub_type' => $request->sub_type,
            'opening_balance' => $request->opening_balance,
            'opening_balance_type' => $request->opening_balance_type,
        ];

        if (!$account->is_system) {
            $group = \App\Models\AccountGroup::where('type', $request->account_type)->first();
            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Account group not found for this type.'
                ], 400);
            }
            $data['account_group_id'] = $group->id;
        }

        $account->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Account updated successfully.',
            'account' => $account
        ]);
    }

    /**
     * Delete a custom account
     */
    public function deleteAccount($id)
    {
        $account = Account::findOrFail($id);

        if ($account->is_system) {
            return response()->json([
                'success' => false,
                'message' => 'System accounts cannot be deleted.'
            ], 400);
        }

        if ($account->entryLines()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Account cannot be deleted because it contains transaction entries.'
            ], 400);
        }

        $account->delete();

        return response()->json([
            'success' => true,
            'message' => 'Account deleted successfully.'
        ]);
    }
}
