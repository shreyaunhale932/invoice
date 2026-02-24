@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
        <div class="content container-fluid">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Ledger: {{ $account->name }}</h2>
            <p class="text-muted mb-0">Group: {{ $account->group->name }} ({{ $account->group->type }})</p>
        </div>
        <form action="{{ route('accounting.ledger', $account->id) }}" method="GET" class="d-flex gap-2 align-items-end">
            <div>
                <label class="form-label small mb-1">From Date</label>
                <input type="date" name="from_date" class="form-control form-control-sm" value="{{ $fromDate }}">
            </div>
            <div>
                <label class="form-label small mb-1">To Date</label>
                <input type="date" name="to_date" class="form-control form-control-sm" value="{{ $toDate }}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            <a href="{{ route('accounting.ledger', $account->id) }}" class="btn btn-secondary btn-sm">Reset</a>
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 120px;">Date</th>
                        <th>Narration / Reference</th>
                        <th class="text-end" style="width: 150px;">Debit</th>
                        <th class="text-end" style="width: 150px;">Credit</th>
                        <th class="text-end" style="width: 150px;">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="fw-bold bg-light">
                        <td colspan="2">Opening Balance</td>
                        <td class="text-end">-</td>
                        <td class="text-end">-</td>
                        <td class="text-end">{{ number_format($openingBalance, 2) }}</td>
                    </tr>

                    @php
                        $runningBalance = $openingBalance;
                        $totalDebit = 0;
                        $totalCredit = 0;
                        $isAssetOrExpense = in_array($account->group->type, ['Asset', 'Expense']);
                    @endphp

                    @foreach($lines as $line)
                    @php
                        $totalDebit += $line->debit;
                        $totalCredit += $line->credit;
                        if ($isAssetOrExpense) {
                            $runningBalance += ($line->debit - $line->credit);
                        } else {
                            $runningBalance += ($line->credit - $line->debit);
                        }
                    @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($line->journalEntry->entry_date)->format('d-m-Y') }}</td>
                        <td>
                            <div>{{ $line->journalEntry->narration }}</div>
                            @if($line->memo)
                                <small class="text-muted">{{ $line->memo }}</small>
                            @endif
                        </td>
                        <td class="text-end text-success">{{ $line->debit > 0 ? number_format($line->debit, 2) : '-' }}</td>
                        <td class="text-end text-danger">{{ $line->credit > 0 ? number_format($line->credit, 2) : '-' }}</td>
                        <td class="text-end fw-bold">{{ number_format($runningBalance, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="fw-bold bg-light">
                    <tr>
                        <td colspan="2" class="text-end">Total Period Activity</td>
                        <td class="text-end text-success">{{ number_format($totalDebit, 2) }}</td>
                        <td class="text-end text-danger">{{ number_format($totalCredit, 2) }}</td>
                        <td></td>
                    </tr>
                    <tr class="table-primary">
                        <td colspan="4" class="text-end">Closing Balance</td>
                        <td class="text-end">{{ number_format($runningBalance, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
</div>
@endsection
