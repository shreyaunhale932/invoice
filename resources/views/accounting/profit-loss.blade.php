@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
        <div class="content container-fluid">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Profit & Loss Statement</h2>
        <form action="{{ route('accounting.profit-loss') }}" method="GET" class="d-flex gap-2 align-items-end">
            <div>
                <label class="form-label small mb-1">From Date</label>
                <input type="date" name="from_date" class="form-control form-control-sm" value="{{ $fromDate }}">
            </div>
            <div>
                <label class="form-label small mb-1">To Date</label>
                <input type="date" name="to_date" class="form-control form-control-sm" value="{{ $toDate }}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            <a href="{{ route('accounting.profit-loss') }}" class="btn btn-secondary btn-sm">Reset</a>
        </form>
    </div>

    <div class="row">
        <!-- Income -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">Income</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        @foreach($incomes as $income)
                        <tr>
                            <td>
                                <a href="{{ route('accounting.ledger', ['id' => $income['id'], 'from_date' => $fromDate, 'to_date' => $toDate]) }}" class="text-decoration-none text-dark">
                                    {{ $income['name'] }}
                                </a>
                            </td>
                            <td class="text-end text-success">{{ number_format($income['amount'], 2) }}</td>
                        </tr>
                        @endforeach
                        <tr class="fw-bold border-top">
                            <td>Total Income</td>
                            <td class="text-end text-success">{{ number_format($totalIncome, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Expenses -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-danger text-white">Expenses</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        @foreach($expenses as $expense)
                        <tr>
                            <td>
                                <a href="{{ route('accounting.ledger', ['id' => $expense['id'], 'from_date' => $fromDate, 'to_date' => $toDate]) }}" class="text-decoration-none text-dark">
                                    {{ $expense['name'] }}
                                </a>
                            </td>
                            <td class="text-end text-danger">{{ number_format($expense['amount'], 2) }}</td>
                        </tr>
                        @endforeach
                        <tr class="fw-bold border-top">
                            <td>Total Expenses</td>
                            <td class="text-end text-danger">{{ number_format($totalExpense, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 shadow-sm">
        <div class="card-body bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Net Profit / (Loss)</h4>
                <h3 class="mb-0 {{ $netProfit >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ number_format($netProfit, 2) }}
                </h3>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
