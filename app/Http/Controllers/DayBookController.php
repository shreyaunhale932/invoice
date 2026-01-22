<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryTransaction;
use App\Models\SellInvoice;
use App\Models\JournalEntry;
use App\Models\Expense;
use App\Services\AccountingService;
use Carbon\Carbon;

class DayBookController extends Controller
{
    protected $accountingService;

    public function __construct(AccountingService $accountingService)
    {
        $this->accountingService = $accountingService;
    }

    public function index(Request $request)
    {
        $date = $request->get('date', Carbon::today()->toDateString());

        // 1. Stock Activity
        $stockActivity = InventoryTransaction::with(['product', 'itemProductData'])
            ->whereDate('created_at', $date)
            ->get();

        // 2. Sales Activity
        $salesActivity = SellInvoice::with(['customer', 'items'])
            ->whereDate('invoice_date', $date)
            ->get();

        // 3. Expense Activity
        $expenseActivity = Expense::with(['expenseAccount', 'paymentAccount'])
            ->whereDate('expense_date', $date)
            ->get();

        // 4. Accounts Activity (Journal Entries)
        $accountsActivity = JournalEntry::with(['lines.account'])
            ->whereDate('entry_date', $date)
            ->get();

        // 4. Profit & Loss for the day
        $plData = $this->accountingService->getProfitAndLoss($date, $date);

        return view('reports.day-book', compact(
            'date',
            'stockActivity',
            'salesActivity',
            'expenseActivity',
            'accountsActivity',
            'plData'
        ));
    }
}
