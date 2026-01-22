@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
        <div class="content container-fluid">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Balance Sheet</h2>
        <form action="{{ route('accounting.balance-sheet') }}" method="GET" class="d-flex gap-2 align-items-end">
            <div>
                <label class="form-label small mb-1">From Date</label>
                <input type="date" name="from_date" class="form-control form-control-sm" value="{{ $fromDate }}">
            </div>
            <div>
                <label class="form-label small mb-1">To Date</label>
                <input type="date" name="to_date" class="form-control form-control-sm" value="{{ $toDate }}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            <a href="{{ route('accounting.balance-sheet') }}" class="btn btn-secondary btn-sm">Reset</a>
        </form>
    </div>
    
    <div class="row">
        <!-- Assets -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">Assets (Uses of Funds)</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        @foreach($assets as $asset)
                        <tr>
                            <td>
                                <a href="{{ route('accounting.ledger', ['id' => $asset['id'], 'from_date' => $fromDate, 'to_date' => $toDate]) }}" class="text-decoration-none text-dark">
                                    {{ $asset['name'] }}
                                </a>
                            </td>
                            <td class="text-end text-success">{{ number_format($asset['amount'], 2) }}</td>
                        </tr>
                        @endforeach
                        <tr class="fw-bold border-top">
                            <td>Total Assets</td>
                            <td class="text-end text-success">{{ number_format($totalAssets, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Liabilities & Equity -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-dark text-white">Liabilities & Equity (Sources of Funds)</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        @foreach($liabilities as $liability)
                        <tr>
                            <td>
                                <a href="{{ route('accounting.ledger', ['id' => $liability['id'], 'from_date' => $fromDate, 'to_date' => $toDate]) }}" class="text-decoration-none text-dark">
                                    {{ $liability['name'] }}
                                </a>
                            </td>
                            <td class="text-end text-danger">{{ number_format($liability['amount'], 2) }}</td>
                        </tr>
                        @endforeach
                        @foreach($equity as $e)
                        <tr>
                            <td>
                                <a href="{{ route('accounting.ledger', ['id' => $e['id'], 'from_date' => $fromDate, 'to_date' => $toDate]) }}" class="text-decoration-none text-dark">
                                    {{ $e['name'] }}
                                </a>
                            </td>
                            <td class="text-end text-danger">{{ number_format($e['amount'], 2) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>Net Profit (Retained Earnings)</td>
                            <td class="text-end text-success">{{ number_format($netProfit, 2) }}</td>
                        </tr>
                        <tr class="fw-bold border-top">
                            <td>Total Liabilities & Equity</td>
                            <td class="text-end">{{ number_format($totalLiabilities, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(abs($totalAssets - $totalLiabilities) < 0.01)
        <div class="alert alert-success mt-4 shadow-sm text-center">
            <h4><i class="fas fa-balance-scale me-2"></i> Balance Sheet is Balanced!</h4>
        </div>
    @else
        <div class="alert alert-danger mt-4 shadow-sm text-center">
            <h4><i class="fas fa-exclamation-circle me-2"></i> Balance Sheet is OUT by {{ number_format(abs($totalAssets - $totalLiabilities), 2) }}</h4>
        </div>
    @endif
</div>
</div>
</div>
@endsection
