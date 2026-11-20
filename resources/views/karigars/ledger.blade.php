<?php $page = 'karigars'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Karigar Metal & Charges Ledger</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('karigars.index') }}">Karigars</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('karigars.show', $karigar->id) }}">{{ $karigar->name }}</a></li>
                        <li class="breadcrumb-item active">Ledger</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <button onclick="window.print()" class="btn btn-outline-primary me-2">
                        <i class="fa fa-print me-1"></i> Print Ledger
                    </button>
                    <a href="{{ route('karigars.show', $karigar->id) }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <!-- Header Info -->
                <div class="row align-items-center mb-4 pb-3 border-bottom">
                    <div class="col-sm-7">
                        <h4 class="mb-1 text-primary fw-bold">{{ $karigar->name }}</h4>
                        <div class="text-muted small">
                            <strong>Code:</strong> {{ $karigar->code ?: 'KG-' . $karigar->id }} |
                            <strong>Workshop:</strong> {{ $karigar->shop_name ?: 'N/A' }} |
                            <strong>Phone:</strong> {{ $karigar->phone ?: 'N/A' }}
                        </div>
                    </div>
                    <div class="col-sm-5 text-sm-end mt-3 mt-sm-0">
                        <div class="badge bg-light text-danger border p-2 fs-6">
                            Current Metal in Hand: <strong>{{ number_format($karigar->current_metal_balance, 3) }} g</strong>
                        </div>
                    </div>
                </div>

                <!-- Ledger Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 110px;">Date</th>
                                <th style="width: 140px;">Ref / Voucher</th>
                                <th style="width: 130px;">Order No</th>
                                <th>Transaction Particulars</th>
                                <th class="text-end" style="width: 130px;">Metal Issued (Out)</th>
                                <th class="text-end" style="width: 140px;">Metal Accounted (In)</th>
                                <th class="text-end" style="width: 130px;">Running Balance</th>
                                <th class="text-end" style="width: 140px;">Making Charges</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Opening Balance Row -->
                            <tr class="table-light fw-bold">
                                <td>-</td>
                                <td>OPENING</td>
                                <td>-</td>
                                <td>Opening Metal Balance in Hand</td>
                                <td class="text-end">{{ number_format($karigar->opening_metal_balance, 3) }} g</td>
                                <td class="text-end">-</td>
                                <td class="text-end text-danger">{{ number_format($karigar->opening_metal_balance, 3) }} g</td>
                                <td class="text-end">₹{{ number_format($karigar->opening_amount_balance, 2) }}</td>
                            </tr>

                            @php
                                $runningBalance = (float)$karigar->opening_metal_balance;
                                $totalIssued = (float)$karigar->opening_metal_balance;
                                $totalIn = 0;
                                $totalCharges = (float)$karigar->opening_amount_balance;
                            @endphp

                            @forelse($transactions as $txn)
                                @php
                                    $runningBalance += ($txn['metal_out'] - $txn['metal_in']);
                                    $totalIssued += $txn['metal_out'];
                                    $totalIn += $txn['metal_in'];
                                    $totalCharges += $txn['making_charges'];
                                @endphp
                                <tr>
                                    <td>{{ $txn['date'] ? \Carbon\Carbon::parse($txn['date'])->format('d M Y') : '-' }}</td>
                                    <td class="fw-bold text-primary">{{ $txn['ref_no'] }}</td>
                                    <td>{{ $txn['order_no'] }}</td>
                                    <td>
                                        @if($txn['type'] === 'issue')
                                            <span class="badge bg-warning text-dark me-1">Issue</span>
                                        @else
                                            <span class="badge bg-success text-white me-1">Receipt</span>
                                        @endif
                                        {{ $txn['description'] }}
                                    </td>
                                    <td class="text-end {{ $txn['metal_out'] > 0 ? 'text-danger fw-bold' : 'text-muted' }}">
                                        {{ $txn['metal_out'] > 0 ? number_format($txn['metal_out'], 3) . ' g' : '-' }}
                                    </td>
                                    <td class="text-end {{ $txn['metal_in'] > 0 ? 'text-success fw-bold' : 'text-muted' }}">
                                        {{ $txn['metal_in'] > 0 ? number_format($txn['metal_in'], 3) . ' g' : '-' }}
                                    </td>
                                    <td class="text-end fw-bold {{ $runningBalance > 0 ? 'text-danger' : 'text-success' }}">
                                        {{ number_format($runningBalance, 3) }} g
                                    </td>
                                    <td class="text-end">
                                        {{ $txn['making_charges'] > 0 ? '₹' . number_format($txn['making_charges'], 2) : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        No transactions recorded yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <th colspan="4" class="text-end">Total Summary:</th>
                                <th class="text-end text-danger">{{ number_format($totalIssued, 3) }} g</th>
                                <th class="text-end text-success">{{ number_format($totalIn, 3) }} g</th>
                                <th class="text-end text-danger fs-6">{{ number_format($runningBalance, 3) }} g</th>
                                <th class="text-end text-dark">₹{{ number_format($totalCharges, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row mt-5 pt-4 d-print-block">
                    <div class="col-6">
                        <div class="border-top pt-2 text-center text-muted small" style="width: 200px;">
                            Authorised Signatory
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="border-top pt-2 text-center text-muted small ms-auto" style="width: 200px;">
                            Karigar Signature
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
