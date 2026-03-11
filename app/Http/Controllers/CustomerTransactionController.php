<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\PaymentTransaction;
use App\Services\AccountingService;
use App\Models\JournalEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerTransactionController extends Controller
{
    protected $accountingService;

    public function __construct(AccountingService $accountingService)
    {
        $this->accountingService = $accountingService;
    }

    public function index(Request $request)
    {
        $firmId = session('selected_firm_id') ?? 1;
        $query = PaymentTransaction::with('customer')->where('firm_id', $firmId);

        if ($request->has('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->has('type')) {
            $query->where('transaction_type', $request->type);
        }

        $transactions = $query->latest()->paginate(15);
        return view('Customers.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::where('admin_id', Auth::guard('admin')->id())->get();
        return view('Customers.transactions.add', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0.01',
            'transaction_type' => 'required|in:advance,udhaar_payment,refund,udhaar_return',
            'payment_method' => 'required|in:cash,bank,online',
            'transaction_date' => 'required|date',
            'reference_no' => 'nullable|string|max:255',
            'narration' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {
            // Validation for Refunds/Returns
            if (in_array($request->transaction_type, ['refund', 'udhaar_return'])) {
                if ($request->parent_id) {
                    $original = PaymentTransaction::findOrFail($request->parent_id);
                    $remaining = $original->amount - $original->refunded_amount;
                    if ($request->amount > $remaining) {
                        return back()->withErrors(['amount' => "Refund amount cannot exceed remaining balance (₹" . number_format($remaining, 2) . ")"])->withInput();
                    }
                } elseif ($request->invoice_id) {
                    $invoice = \App\Models\SellInvoice::findOrFail($request->invoice_id);
                    $remaining = $invoice->total_received - $invoice->refunded_amount;
                    if ($request->amount > $remaining) {
                        return back()->withErrors(['amount' => "Refund amount cannot exceed remaining paid balance (₹" . number_format($remaining, 2) . ")"])->withInput();
                    }
                }
            }

            $transaction = PaymentTransaction::create([
               'firm_id' => session('selected_firm_id') ?? 1,
                'admin_id' => Auth::guard('admin')->id(),
                'customer_id' => $request->customer_id,
                'invoice_id' => $request->invoice_id,
                'parent_id' => $request->parent_id,
                'amount' => $request->amount,
                'transaction_type' => $request->transaction_type,
                'payment_method' => $request->payment_method,
                'transaction_date' => $request->transaction_date,
                'reference_no' => $request->reference_no,
                'narration' => $request->narration,
            ]);

            // Post to Accounting
            $this->accountingService->postCustomerTransaction($transaction);

            return redirect()->route('customer.transactions.index')->with('success', 'Transaction recorded and ledger updated.');
        });
    }

    public function refund($id)
    {
        $original = PaymentTransaction::findOrFail($id);
        if (!$original->canBeRefunded()) {
            return redirect()->route('customer.transactions.index')->with('error', 'This transaction has already been fully refunded.');
        }
        $customers = Customer::where('admin_id', Auth::guard('admin')->id())->get();

        $type = 'refund'; // Default for Advance
        $label = 'Refund';
        if ($original->transaction_type == 'udhaar_payment') {
            $type = 'udhaar_return';
            $label = 'Return';
        }

        return view('Customers.transactions.add', [
            'customers' => $customers,
            'original' => $original,
            'customer_id' => $original->customer_id,
            'transaction_type' => $type,
            'parent_id' => $original->id,
            'amount' => $original->amount - $original->refunded_amount,
            'narration' => "{$label} of transaction #{$original->id}"
        ]);
    }

    public function refundInvoice($id)
    {
        $invoice = \App\Models\SellInvoice::findOrFail($id);
        if (!$invoice->can_be_refunded) {
            return redirect()->route('invoices.index')->with('error', 'This invoice has already been fully refunded.');
        }
        $customers = Customer::where('admin_id', Auth::guard('admin')->id())->get();
        return view('Customers.transactions.add', [
            'customers' => $customers,
            'original' => null,
            'customer_id' => $invoice->customer_id,
            'transaction_type' => 'refund',
            'invoice_id' => $invoice->id,
            'amount' => $invoice->total_received - $invoice->refunded_amount, // Pre-fill with remaining paid balance
            'narration' => "Refund/Return for Invoice #{$invoice->invoice_no}"
        ]);
    }

    public function edit($id)
    {
        $transaction = PaymentTransaction::findOrFail($id);
        $customers = Customer::where('admin_id', Auth::guard('admin')->id())->get();
        return view('Customers.transactions.edit', compact('transaction', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $transaction = PaymentTransaction::findOrFail($id);

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0.01',
            'transaction_type' => 'required|in:advance,udhaar_payment,refund,udhaar_return',
            'payment_method' => 'required|in:cash,bank,online',
            'transaction_date' => 'required|date',
            'reference_no' => 'nullable|string|max:255',
            'narration' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request, $transaction) {
            $transaction->update([
                'customer_id' => $request->customer_id,
                'amount' => $request->amount,
                'transaction_type' => $request->transaction_type,
                'payment_method' => $request->payment_method,
                'transaction_date' => $request->transaction_date,
                'reference_no' => $request->reference_no,
                'narration' => $request->narration,
            ]);

            // Sync Accounting: Delete old entry and post new one
            JournalEntry::where('reference_type', PaymentTransaction::class)
                ->where('reference_id', $transaction->id)
                ->delete();

            $this->accountingService->postCustomerTransaction($transaction);

            return redirect()->route('customer.transactions.index')->with('success', 'Transaction updated and ledger synced.');
        });
    }

    public function destroy($id)
    {
        $transaction = PaymentTransaction::findOrFail($id);

        return DB::transaction(function () use ($transaction) {
            // Delete Accounting Entry first
            JournalEntry::where('reference_type', PaymentTransaction::class)
                ->where('reference_id', $transaction->id)
                ->delete();

            $transaction->delete();

            return redirect()->route('customer.transactions.index')->with('success', 'Transaction deleted and ledger adjusted.');
        });
    }

    /**
     * Customer Transaction Report
     */
    public function report(Request $request)
    {
        $firmId = session('selected_firm_id') ?? 1;
        $customerId = $request->get('customer_id');
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $customers = Customer::where('admin_id', Auth::guard('admin')->id())->get();

        $query = PaymentTransaction::with('customer')->where('firm_id', $firmId);

        if ($customerId) {
            $query->where('customer_id', $customerId);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('transaction_date', [$fromDate, $toDate]);
        }

        $transactions = $query->orderBy('transaction_date', 'asc')->get();

        // Summary Calculations
        $totalAdvance = 0;
        $totalUdhaarPaid = 0;
        $totalRefund = 0;
        $totalUdhaarReturn = 0;

        foreach ($transactions as $t) {
            if ($t->transaction_type == 'advance') $totalAdvance += $t->amount;
            elseif ($t->transaction_type == 'udhaar_payment') $totalUdhaarPaid += $t->amount;
            elseif ($t->transaction_type == 'refund') $totalRefund += $t->amount;
            elseif ($t->transaction_type == 'udhaar_return') $totalUdhaarReturn += $t->amount;
        }

        return view('customers.reports.transaction-report', compact(
            'transactions', 'customers', 'customerId', 'fromDate', 'toDate',
            'totalAdvance', 'totalUdhaarPaid', 'totalRefund', 'totalUdhaarReturn'
        ));
    }
}
