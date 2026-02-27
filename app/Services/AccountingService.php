<?php

namespace App\Services;

use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\JournalEntryLine;
use App\Models\SellInvoice;
use App\Models\Expense;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AccountingService
{
    /**
     * Post a balanced journal entry.
     */
    public function postJournalEntry($date, $narration, $lines, $referenceType = null, $referenceId = null)
    {
        return DB::transaction(function () use ($date, $narration, $lines, $referenceType, $referenceId) {
            $totalDebit = collect($lines)->sum('debit');
            $totalCredit = collect($lines)->sum('credit');

            if (abs($totalDebit - $totalCredit) > 0.01) {
                throw new \Exception("Journal entry is not balanced. Total Debit: $totalDebit, Total Credit: $totalCredit");
            }

            $entry = JournalEntry::create([
                'entry_date' => $date,
                'narration' => $narration,
                'reference_type' => $referenceType,
                'reference_id' => $referenceId,
                'admin_id' => auth()->id() ?? 1, // Defaulting to 1 for system actions
            ]);

            foreach ($lines as $line) {
                JournalEntryLine::create([
                    'journal_entry_id' => $entry->id,
                    'account_id' => $line['account_id'],
                    'debit' => $line['debit'] ?? 0,
                    'credit' => $line['credit'] ?? 0,
                    'memo' => $line['memo'] ?? null,
                ]);
            }

            return $entry;
        });
    }

    protected function getAccountId($name)
    {
        return Account::where('name', $name)->firstOrFail()->id;
    }

    /**
     * Rule: Add Stock → Dr Stock, Cr Capital
     */
    public function postStockIn($product, $amount, $date = null)
    {
        $lines = [
            [
                'account_id' => $this->getAccountId('Stock'),
                'debit' => $amount,
                'credit' => 0,
                'memo' => "Stock addition for {$product->product_name}"
            ],
            [
                'account_id' => $this->getAccountId('Capital'),
                'debit' => 0,
                'credit' => $amount,
                'memo' => "Capital inversion for stock: {$product->product_name}"
            ]
        ];

        return $this->postJournalEntry(
            $date ?? now(),
            "Add Stock: {$product->product_name}",
            $lines,
            get_class($product),
            $product->id
        );
    }

    /**
     * Rule: Sale (single invoice, multiple payments)
     * Dr Cash / Bank / UPI / Card (split)
     * Dr Sundry Debtors (for unpaid balance)
     * Cr Gold Sales / Diamond Sales / Stone Sales / Silver Sales (granular)
     * Cr GST Output CGST & SGST
     */
    public function postSellInvoice($invoice)
    {
        $lines = [];

        // --- DEBITS (Payments & Receivables) ---

        // 1. Cash Received
        if ($invoice->cash_received > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Cash in Hand'),
                'debit' => $invoice->cash_received,
                'credit' => 0,
                'memo' => "Cash payment for Invoice #{$invoice->invoice_no}"
            ];
        }

        // 2. Bank Received
        if ($invoice->bank_received > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Bank'),
                'debit' => $invoice->bank_received,
                'credit' => 0,
                'memo' => "Bank payment for Invoice #{$invoice->invoice_no}"
            ];
        }

        // 3. Online/UPI Received
        if ($invoice->online_received > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('UPI Clearing'),
                'debit' => $invoice->online_received,
                'credit' => 0,
                'memo' => "UPI payment for Invoice #{$invoice->invoice_no}"
            ];
        }

        // 4. Card Received
        if (isset($invoice->card_received) && $invoice->card_received > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Card Receivable'),
                'debit' => $invoice->card_received,
                'credit' => 0,
                'memo' => "Card payment for Invoice #{$invoice->invoice_no}"
            ];
        }

        // 5. Amount Left (Sundry Debtors)
        // If there's a balance left, it must go to Sundry Debtors to balance the entry.
        if ($invoice->amount_left > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Sundry Debtors'),
                'debit' => $invoice->amount_left,
                'credit' => 0,
                'memo' => "Credit balance for Invoice #{$invoice->invoice_no}"
            ];
        }
        // 5.1 Discount Allowed (Debit)
        if ($invoice->discount_amount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Discount Allowed'),
                'debit' => $invoice->discount_amount,
                'credit' => 0,
                'memo' => "Discount on Invoice #{$invoice->invoice_no}"
            ];
        }

        if ($invoice->diamond_discount_amount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Dia/St/Pkt Discount Allowed'),
                'debit' => $invoice->diamond_discount_amount,
                'credit' => 0,
                'memo' => "Dia/St/Pkt Discount on Invoice #{$invoice->invoice_no}"
            ];
        }
           if ($invoice->making_discount_amount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Making Discount Allowed'),
                'debit' => $invoice->making_discount_amount,
                'credit' => 0,
                'memo' => "Making Discount on Invoice #{$invoice->invoice_no}"
            ];
        }

        // --- CREDITS (Income & Taxes) ---

        // 6. Granular Sales Income
        // We calculate income per category from items.
        // Note: final_price includes tax usually, but here Jewellery Sales was net.
        // Let's split the net amount (taxable_amount) proportionally or accurately.

        $totalGoldAmount = 0;
        $totalDiamondAmount = 0;
        $totalStoneAmount = 0;
        $totalPacketAmount = 0;
        $totalSilverAmount = 0;

        foreach ($invoice->items as $item) {
            $category = strtolower($item->category ?? '');

            if (str_contains($category, 'gold')) {
                if ($item->diamond_amount > 0) {
                    $totalDiamondAmount += $item->diamond_amount;
                }
                if ($item->stone_amount > 0) {
                    $totalStoneAmount += $item->stone_amount;
                }
                if ($item->packet_amount > 0) {
                    $totalPacketAmount += $item->packet_amount;
                }
                $totalGoldAmount += $item->final_price - ($item->gst_amount ?? 0) - ($item->diamond_amount ?? 0) - ($item->stone_amount ?? 0) - ($item->packet_amount ?? 0);
            } elseif (str_contains($category, 'silver')) {
                if ($item->diamond_amount > 0) {
                    $totalDiamondAmount += $item->diamond_amount;
                }
                if ($item->stone_amount > 0) {
                    $totalStoneAmount += $item->stone_amount;
                }
                if ($item->packet_amount > 0) {
                    $totalPacketAmount += $item->packet_amount;
                }
                $totalSilverAmount += $item->final_price - ($item->gst_amount ?? 0) - ($item->diamond_amount ?? 0) - ($item->stone_amount ?? 0) - ($item->packet_amount ?? 0);
            } elseif (str_contains($category, 'stone')) {
                $totalStoneAmount += $item->final_price - ($item->gst_amount ?? 0);
            } else {
                // Default to Gold/Jewellery for others
                if ($item->diamond_amount > 0) {
                    $totalDiamondAmount += $item->diamond_amount;
                }
                if ($item->stone_amount > 0) {
                    $totalStoneAmount += $item->stone_amount;
                }
                if ($item->packet_amount > 0) {
                    $totalPacketAmount += $item->packet_amount;
                }
                $totalGoldAmount += $item->final_price - ($item->gst_amount ?? 0) - ($item->diamond_amount ?? 0) - ($item->stone_amount ?? 0) - ($item->packet_amount ?? 0);
            }
        }

        // Post Gold Sales
        if ($totalGoldAmount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Gold Sales'),
                'debit' => 0,
                'credit' => $totalGoldAmount,
                'memo' => "Gold sales income for Invoice #{$invoice->invoice_no}"
            ];
        }

        // Post Diamond Sales
        if ($totalDiamondAmount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Diamond Sales'),
                'debit' => 0,
                'credit' => $totalDiamondAmount,
                'memo' => "Diamond sales income for Invoice #{$invoice->invoice_no}"
            ];
        }

        // Post Stone Sales
        if ($totalStoneAmount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Stone Sales'),
                'debit' => 0,
                'credit' => $totalStoneAmount,
                'memo' => "Stone sales income for Invoice #{$invoice->invoice_no}"
            ];
        }
        if ($totalPacketAmount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Packet Sales'),
                'debit' => 0,
                'credit' => $totalPacketAmount,
                'memo' => "Packet sales income for Invoice #{$invoice->invoice_no}"
            ];
        }

        // Post Silver Sales
        if ($totalSilverAmount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Silver Sales'),
                'debit' => 0,
                'credit' => $totalSilverAmount,
                'memo' => "Silver sales income for Invoice #{$invoice->invoice_no}"
            ];
        }

        // Fallback or miscellaneous if nothing matched (rare but safe)
        if ($totalGoldAmount == 0 && $totalDiamondAmount == 0 && $totalStoneAmount == 0 && $totalSilverAmount == 0 && $totalPacketAmount == 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('Jewellery Sales'),
                'debit' => 0,
                'credit' => $invoice->taxable_amount,
                'memo' => "General sales income for Invoice #{$invoice->invoice_no}"
            ];
        }
        // 7. GST Output
        if ($invoice->cgst_amount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('GST Output CGST'),
                'debit' => 0,
                'credit' => $invoice->cgst_amount,
                'memo' => "CGST on Invoice #{$invoice->invoice_no}"
            ];
        }
        if ($invoice->sgst_amount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('GST Output SGST'),
                'debit' => 0,
                'credit' => $invoice->sgst_amount,
                'memo' => "SGST on Invoice #{$invoice->invoice_no}"
            ];
        }
           if ($invoice->igst_amount > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('GST Output IGST'),
                'debit' => 0,
                'credit' => $invoice->igst_amount,
                'memo' => "IGST on Invoice #{$invoice->invoice_no}"
            ];
        }

        return $this->postJournalEntry(
            $invoice->created_at ?? now(),
            "Invoice Sale #{$invoice->invoice_no}",
            $lines,
            get_class($invoice),
            $invoice->id
        );
    }

    /**
     * Rule: Card settlement → Dr Bank + Charges, Cr Card Receivable
     */
    public function postCardSettlement($amount, $charges, $date = null)
    {
        $lines = [
            [
                'account_id' => $this->getAccountId('Bank'),
                'debit' => $amount - $charges,
                'credit' => 0,
                'memo' => "Card settlement received"
            ],
            [
                'account_id' => $this->getAccountId('Bank / Card Charges'),
                'debit' => $charges,
                'credit' => 0,
                'memo' => "Card processing charges"
            ],
            [
                'account_id' => $this->getAccountId('Card Receivable'),
                'debit' => 0,
                'credit' => $amount,
                'memo' => "Card settlement cleared"
            ]
        ];

        return $this->postJournalEntry(
            $date ?? now(),
            "Card Settlement",
            $lines
        );
    }

    /**
     * Rule: UPI settlement → Dr Bank, Cr UPI Clearing
     */
    public function postUPISettlement($amount, $date = null)
    {
        $lines = [
            [
                'account_id' => $this->getAccountId('Bank'),
                'debit' => $amount,
                'credit' => 0,
                'memo' => "UPI settlement received"
            ],
            [
                'account_id' => $this->getAccountId('UPI Clearing'),
                'debit' => 0,
                'credit' => $amount,
                'memo' => "UPI settlement cleared"
            ]
        ];

        return $this->postJournalEntry(
            $date ?? now(),
            "UPI Settlement",
            $lines
        );
    }

    /**
     * Rule: GST payment → Dr GST Output, Cr Bank
     */
    public function postGSTPayment($cgst, $sgst, $date = null)
    {
        $lines = [];
        if ($cgst > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('GST Output CGST'),
                'debit' => $cgst,
                'credit' => 0,
                'memo' => "GST CGST Payment"
            ];
        }
        if ($sgst > 0) {
            $lines[] = [
                'account_id' => $this->getAccountId('GST Output SGST'),
                'debit' => $sgst,
                'credit' => 0,
                'memo' => "GST SGST Payment"
            ];
        }
        $lines[] = [
            'account_id' => $this->getAccountId('Bank'),
            'debit' => 0,
            'credit' => $cgst + $sgst,
            'memo' => "GST Tax Payment"
        ];

        return $this->postJournalEntry(
            $date ?? now(),
            "GST Payment",
            $lines
        );
    }

    /**
     * Recreate all journal entries from scratch.
     * WARNING: Deletes all existing journal entries and lines.
     */
    public function postExpense($expense)
    {
        $lines = [
            [
                'account_id' => $expense->expense_account_id,
                'debit' => $expense->amount,
                'credit' => 0,
                'memo' => "Expense: {$expense->description}"
            ],
            [
                'account_id' => $expense->payment_account_id,
                'debit' => 0,
                'credit' => $expense->amount,
                'memo' => "Payment for expense: {$expense->description}"
            ]
        ];

        return $this->postJournalEntry(
            $expense->expense_date,
            "Expense: " . ($expense->description ?? $expense->expenseAccount->name),
            $lines,
            get_class($expense),
            $expense->id
        );
    }

    public function deleteExpenseEntry($expense)
    {
        JournalEntry::where('reference_type', get_class($expense))
            ->where('reference_id', $expense->id)
            ->delete();
    }

    public function getTrialBalance($fromDate = null, $toDate = null)
    {
        $report = Account::with(['group'])->get()->map(function ($account) use ($fromDate, $toDate) {
            $query = JournalEntryLine::where('account_id', $account->id);

            if ($fromDate && $toDate) {
                $query->whereHas('journalEntry', function ($q) use ($fromDate, $toDate) {
                    $q->whereBetween('entry_date', [$fromDate, $toDate]);
                });
            }

            $debit = $query->sum('debit');
            $credit = $query->sum('credit');

            return [
                'id' => $account->id,
                'name' => $account->name,
                'group' => $account->group->name,
                'debit' => $debit,
                'credit' => $credit
            ];
        });

        $totalDebit = $report->sum('debit');
        $totalCredit = $report->sum('credit');

        return [
            'report' => $report,
            'totalDebit' => $totalDebit,
            'totalCredit' => $totalCredit
        ];
    }

    public function getProfitAndLoss($fromDate = null, $toDate = null)
    {
        $incomes = Account::whereHas('group', function ($q) {
            $q->where('type', 'Income');
        })->get()->map(function ($account) use ($fromDate, $toDate) {
            $query = JournalEntryLine::where('account_id', $account->id);
            if ($fromDate && $toDate) {
                $query->whereHas('journalEntry', function ($q) use ($fromDate, $toDate) {
                    $q->whereBetween('entry_date', [$fromDate, $toDate]);
                });
            }
            return [
                'id' => $account->id,
                'name' => $account->name,
                'amount' => $query->sum('credit') - $query->sum('debit')
            ];
        });

        $expenses = Account::whereHas('group', function ($q) {
            $q->where('type', 'Expense');
        })->get()->map(function ($account) use ($fromDate, $toDate) {
            $query = JournalEntryLine::where('account_id', $account->id);
            if ($fromDate && $toDate) {
                $query->whereHas('journalEntry', function ($q) use ($fromDate, $toDate) {
                    $q->whereBetween('entry_date', [$fromDate, $toDate]);
                });
            }
            return [
                'id' => $account->id,
                'name' => $account->name,
                'amount' => $query->sum('debit') - $query->sum('credit')
            ];
        });

        $totalIncome = $incomes->sum('amount');
        $totalExpense = $expenses->sum('amount');
        $netProfit = $totalIncome - $totalExpense;

        return [
            'incomes' => $incomes,
            'expenses' => $expenses,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'netProfit' => $netProfit
        ];
    }

    public function getBalanceSheet($fromDate = null, $toDate = null)
    {
        $assets = Account::whereHas('group', function ($q) {
            $q->where('type', 'Asset');
        })->get()->map(function ($account) use ($fromDate, $toDate) {
            $query = JournalEntryLine::where('account_id', $account->id);
            if ($fromDate && $toDate) {
                $query->whereHas('journalEntry', function ($q) use ($fromDate, $toDate) {
                    $q->whereBetween('entry_date', [$fromDate, $toDate]);
                });
            }
            return [
                'id' => $account->id,
                'name' => $account->name,
                'amount' => $query->sum('debit') - $query->sum('credit')
            ];
        });

        $liabilities = Account::whereHas('group', function ($q) {
            $q->where('type', 'Liability');
        })->get()->map(function ($account) use ($fromDate, $toDate) {
            $query = JournalEntryLine::where('account_id', $account->id);
            if ($fromDate && $toDate) {
                $query->whereHas('journalEntry', function ($q) use ($fromDate, $toDate) {
                    $q->whereBetween('entry_date', [$fromDate, $toDate]);
                });
            }
            return [
                'id' => $account->id,
                'name' => $account->name,
                'amount' => $query->sum('credit') - $query->sum('debit')
            ];
        });

        $equity = Account::whereHas('group', function ($q) {
            $q->where('type', 'Equity');
        })->get()->map(function ($account) use ($fromDate, $toDate) {
            $query = JournalEntryLine::where('account_id', $account->id);
            if ($fromDate && $toDate) {
                $query->whereHas('journalEntry', function ($q) use ($fromDate, $toDate) {
                    $q->whereBetween('entry_date', [$fromDate, $toDate]);
                });
            }
            return [
                'id' => $account->id,
                'name' => $account->name,
                'amount' => $query->sum('credit') - $query->sum('debit')
            ];
        });

        // Calculate Net Profit for Balance Sheet (Retained Earnings)
        $incomeTotalQuery = JournalEntryLine::whereHas('account.group', function ($q) {
            $q->where('type', 'Income');
        });

        $expenseTotalQuery = JournalEntryLine::whereHas('account.group', function ($q) {
            $q->where('type', 'Expense');
        });

        if ($fromDate && $toDate) {
            $incomeTotalQuery->whereHas('journalEntry', function ($q) use ($fromDate, $toDate) {
                $q->whereBetween('entry_date', [$fromDate, $toDate]);
            });
            $expenseTotalQuery->whereHas('journalEntry', function ($q) use ($fromDate, $toDate) {
                $q->whereBetween('entry_date', [$fromDate, $toDate]);
            });
        }

        $incomeTotal = $incomeTotalQuery->selectRaw('SUM(credit - debit) as total_income')->first()->total_income ?? 0;
        $expenseTotal = $expenseTotalQuery->selectRaw('SUM(debit - credit) as total_expenses')->first()->total_expenses ?? 0;

        $netProfit = $incomeTotal - $expenseTotal;

        $totalAssets = $assets->sum('amount');
        $totalLiabilities = $liabilities->sum('amount') + $equity->sum('amount') + $netProfit;

        return [
            'assets' => $assets,
            'liabilities' => $liabilities,
            'equity' => $equity,
            'netProfit' => $netProfit,
            'totalAssets' => $totalAssets,
            'totalLiabilities' => $totalLiabilities
        ];
    }

    public function getAccountLedger($accountId, $fromDate = null, $toDate = null)
    {
        $account = Account::with('group')->findOrFail($accountId);

        $query = JournalEntryLine::with(['journalEntry'])
            ->where('account_id', $accountId);

        if ($fromDate && $toDate) {
            $query->whereHas('journalEntry', function ($q) use ($fromDate, $toDate) {
                $q->whereBetween('entry_date', [$fromDate, $toDate]);
            });
        }

        $lines = $query->orderBy(JournalEntry::select('entry_date')->whereColumn('journal_entries.id', 'journal_entry_lines.journal_entry_id'))
            ->get();

        // Calculate opening balance if dates are provided
        $openingBalance = 0;
        if ($fromDate) {
            $preQuery = JournalEntryLine::where('account_id', $accountId)
                ->whereHas('journalEntry', function ($q) use ($fromDate) {
                    $q->where('entry_date', '<', $fromDate);
                });

            if (in_array($account->group->type, ['Asset', 'Expense'])) {
                $openingBalance = $preQuery->sum('debit') - $preQuery->sum('credit');
            } else {
                $openingBalance = $preQuery->sum('credit') - $preQuery->sum('debit');
            }
        }

        return [
            'account' => $account,
            'lines' => $lines,
            'openingBalance' => $openingBalance
        ];
    }

    /**
     * Recreate all journal entries from scratch.
     * WARNING: Deletes all existing journal entries that have a reference!
     */
    public function syncAll()
    {
        return DB::transaction(function () {
            // 1. Delete all journal entries that were created via sync/models
            JournalEntry::whereNotNull('reference_type')->delete();

            // 2. Sync Invoices
            SellInvoice::with('items')->chunk(50, function ($invoices) {
                foreach ($invoices as $invoice) {
                    $this->postSellInvoice($invoice);
                }
            });

            // 3. Sync Expenses
            Expense::with(['expenseAccount', 'paymentAccount'])->chunk(50, function ($expenses) {
                foreach ($expenses as $expense) {
                    $this->postExpense($expense);
                }
            });

            // 4. Sync Products (Stock In)
            Product::chunk(50, function ($products) {
                foreach ($products as $product) {
                    if ($product->final_price > 0) {
                        $this->postStockIn($product, $product->final_price, $product->created_at);
                    }
                }
            });

            return true;
        });
    }
}
