@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Day Book</h5>
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <form action="{{ route('day-book.index') }}" method="GET" class="d-flex align-items-center">
                                    <input type="date" name="date" class="form-control me-2" value="{{ $date }}" onchange="this.form.submit()">
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- P&L Summary Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-light border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <h6 class="text-muted mb-1">Total Income</h6>
                                    <h4 class="text-success">{{ number_format($plData['totalIncome'], 2) }}</h4>
                                </div>
                                <div class="col-md-3">
                                    <h6 class="text-muted mb-1">Total Expenses</h6>
                                    <h4 class="text-danger">{{ number_format($plData['totalExpense'], 2) }}</h4>
                                </div>
                                <div class="col-md-3 border-start">
                                    <h5 class="mb-1">Net {{ $plData['netProfit'] >= 0 ? 'Profit' : 'Loss' }}</h5>
                                    <h3 class="{{ $plData['netProfit'] >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ number_format($plData['netProfit'], 2) }}
                                    </h3>
                                </div>
                                <div class="col-md-3 text-end">
                                    <span class="badge bg-info-light">Date: {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Stock Activity -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title">Stock Activity (Add/Delete/Inventory)</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>SKU/Code</th>
                                            <th>Type</th>
                                            <th>Weight</th>
                                            <th>Remarks</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($stockActivity as $activity)
                                            <tr>
                                                <td>{{ $activity->product->product_name ?? 'N/A' }}</td>
                                                <td>{{ $activity->product->product_code ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge {{ $activity->type == 'IN' ? 'bg-success-light' : 'bg-danger-light' }}">
                                                        {{ $activity->type }}
                                                    </span>
                                                </td>
                                                <td>{{ $activity->gross_weight }} {{ $activity->unit }}</td>
                                                <td>{{ $activity->remarks }}</td>
                                                <td>{{ $activity->created_at->format('h:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No stock activity today</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales Activity -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title">Sales Activity</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Invoice #</th>
                                            <th>Customer</th>
                                            <th>Amount (Taxable)</th>
                                            <th>GST</th>
                                            <th>Final Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($salesActivity as $sale)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('sell.invoice.view', $sale->id) }}" class="text-primary fw-bold" target="_blank">
                                                        {{ $sale->invoice_no }}
                                                    </a>
                                                </td>
                                                <td>{{ $sale->customer->name ?? 'Walk-in' }}</td>
                                                <td>{{ number_format($sale->taxable_amount, 2) }}</td>
                                                <td>{{ number_format($sale->cgst_amount + $sale->sgst_amount + $sale->igst_amount, 2) }}</td>
                                                <td class="fw-bold">{{ number_format($sale->final_amount, 2) }}</td>
                                                <td>
                                                    <span class="badge {{ $sale->status == 'paid' ? 'bg-success-light' : 'bg-warning-light' }}">
                                                        {{ ucfirst($sale->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No sales today</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expense Activity -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title">Expense Activity</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Expense ID</th>
                                            <th>Category</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Notes</th>
                                            <th>Status</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($expenseActivity as $expense)
                                            <tr>
                                                <td class="fw-bold text-primary">EXP-{{ str_pad($expense->id, 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $expense->expenseAccount->name }}</td>
                                                <td>{{ $expense->paymentAccount->name }}</td>
                                                <td class="fw-bold">{{ number_format($expense->amount, 2) }}</td>
                                                <td>{{ Str::limit($expense->description, 30) }}</td>
                                                <td><span class="badge bg-success-light">Paid</span></td>
                                                <td>{{ $expense->created_at->format('h:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No expenses today</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accounts Activity -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title">Accounts & Expense Activity (Journal Entries)</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Narration</th>
                                            <th>Accounts Affected</th>
                                            <th>Total Impact</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($accountsActivity as $entry)
                                            <tr>
                                                <td>{{ $entry->narration }}</td>
                                                <td>
                                                    <small>
                                                        @foreach($entry->lines as $line)
                                                            {{ $line->account->name }}:
                                                            <span class="{{ $line->debit > 0 ? 'text-success' : 'text-danger' }}">
                                                                {{ number_format($line->debit > 0 ? $line->debit : $line->credit, 2) }}
                                                            </span><br>
                                                        @endforeach
                                                    </small>
                                                </td>
                                                <td class="fw-bold">
                                                    {{ number_format($entry->lines->sum('debit'), 2) }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($entry->created_at)->format('h:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No accounting entries today</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
