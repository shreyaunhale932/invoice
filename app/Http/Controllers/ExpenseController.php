<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Expense;
use App\Models\Account;
use App\Services\AccountingService;

class ExpenseController extends Controller
{
    protected $accountingService;

    public function __construct(AccountingService $accountingService)
    {
        $this->accountingService = $accountingService;
    }

    public function index()
    {
        $expenses = Expense::with(['expenseAccount', 'paymentAccount'])->latest()->get();

        $expenseAccounts = Account::whereHas('group', function ($q) {
            $q->where('type', 'Expense');
        })->get();

        $paymentAccounts = Account::whereHas('group', function ($q) {
            $q->where('type', 'Asset');
        })->whereIn('name', ['Cash in Hand', 'Card Receivable', 'UPI Clearing', 'Bank'])->get();

        return view('expenses.index', compact('expenses', 'expenseAccounts', 'paymentAccounts'));
    }

    public function create()
    {
        $expenseAccounts = Account::whereHas('group', function ($q) {
            $q->where('type', 'Expense');
        })->get();

        $paymentAccounts = Account::whereHas('group', function ($q) {
            $q->where('type', 'Asset');
        })->whereIn('name', ['Cash in Hand', 'Card Receivable', 'UPI Clearing', 'Bank'])->get();

        return view('expenses.create', compact('expenseAccounts', 'paymentAccounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'expense_account_id' => 'required|exists:accounts,id',
            'payment_account_id' => 'required|exists:accounts,id',
            'description' => 'nullable|string'
        ]);

        $data = $request->all();
        $data['admin_id'] = auth()->id() ?? 1;

        $expense = Expense::create($data);

        // Record Journal Entry
        $this->accountingService->postExpense($expense);

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully.');
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'expense_account_id' => 'required|exists:accounts,id',
            'payment_account_id' => 'required|exists:accounts,id',
            'description' => 'nullable|string'
        ]);

        // Delete Old Journal Entry
        $this->accountingService->deleteExpenseEntry($expense);

        $expense->update($request->all());

        // Record New Journal Entry
        $this->accountingService->postExpense($expense);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        // Delete Journal Entry
        $this->accountingService->deleteExpenseEntry($expense);

        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
