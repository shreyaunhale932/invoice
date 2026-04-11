@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Trial Balance</h2>
                    <form action="{{ route('accounting.trial-balance') }}" method="GET" class="d-flex gap-2 align-items-end">
                        <div>
                            <label class="form-label small mb-1">From Date</label>
                            <input type="date" name="from_date" class="form-control form-control-sm"
                                value="{{ $fromDate }}">
                        </div>
                        <div>
                            <label class="form-label small mb-1">To Date</label>
                            <input type="date" name="to_date" class="form-control form-control-sm"
                                value="{{ $toDate }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                        <a href="{{ route('accounting.trial-balance') }}" class="btn btn-secondary btn-sm">Reset</a>
                    </form>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>Account Name</th>
                                    <th>Group</th>
                                    <th class="text-end">Credit</th>
                                    <th class="text-end">Debit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($report as $row)
                                    <tr>
                                        <td>
                                            <a href="{{ route('accounting.ledger', ['id' => $row['id'], 'from_date' => $fromDate, 'to_date' => $toDate]) }}"
                                                class="text-decoration-none">
                                                {{ $row['name'] }}
                                            </a>
                                        </td>
                                        <td>{{ $row['group'] }}</td>
                                        <td class="text-end text-success">{{ number_format($row['debit'], 2) }}</td>
                                        <td class="text-end text-danger">{{ number_format($row['credit'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="fw-bold bg-light">
                                <tr>
                                    <td colspan="2" class="text-end">Total</td>
                                    <td class="text-end text-success">{{ number_format($totalDebit, 2) }}</td>
                                    <td class="text-end text-danger">{{ number_format($totalCredit, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        @php
                            $difference = round(abs($totalDebit - $totalCredit), 2);
                        @endphp

                        @if ($difference <= 1)
                            <div class="alert alert-success mt-3">
                                <i class="fas fa-check-circle me-2"></i> Trial Balance is Matched!
                            </div>
                        @else
                            <div class="alert alert-danger mt-3">
                                <i class="fas fa-exclamation-triangle me-2"></i> Trial Balance is OUT by
                                {{ number_format($difference, 2) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
