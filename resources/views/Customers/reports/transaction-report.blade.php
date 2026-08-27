@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            @component('components.page-header')
                @slot('title')
                    Customer Transaction Report
                @endslot
            @endcomponent

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('customer.reports.transactions') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Filter by Customer</label>
                                            <select name="customer_id" class="form-control select2">
                                                <option value="">-- All Customers --</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ $customerId == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>From Date</label>
                                            <input type="date" name="from_date" class="form-control" value="{{ $fromDate }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>To Date</label>
                                            <input type="date" name="to_date" class="form-control" value="{{ $toDate }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary w-100 mb-3">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-success-light">
                        <div class="card-body text-center">
                            <h6 class="mb-3">Total Advance Receipt</h6>
                            <h5 class="text-success">₹{{ number_format($totalAdvance, 2) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-primary-light">
                        <div class="card-body text-center">
                            <h6 class="mb-3">Total Udhaar Get</h6>
                            <h5 class="text-primary">₹{{ number_format($totalUdhaarPaid, 2) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger-light">
                        <div class="card-body text-center">
                            <h6 class="mb-3">Total Advance Refund</h6>
                            <h5 class="text-danger">₹{{ number_format($totalRefund, 2) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning-light">
                        <div class="card-body text-center">
                            <h6 class="mb-3">Total Udhaar Return</h6>
                            <h5 class="text-warning">₹{{ number_format($totalUdhaarReturn, 2) }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table p-2">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Customer</th>
                                            <th>Type</th>
                                            <th>Method</th>
                                            <th>Ref No</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}</td>
                                                <td>{{ $transaction->customer->name }}</td>
                                                <td>
                                                    @php
                                                        $label = 'Transaction';
                                                        $badge = 'bg-info';
                                                        if($transaction->transaction_type == 'advance') {
                                                            $label = 'Advance Receipt';
                                                            $badge = 'bg-success';
                                                        } elseif($transaction->transaction_type == 'udhaar_payment') {
                                                            $label = 'Udhaar Get';
                                                            $badge = 'bg-primary';
                                                        } elseif($transaction->transaction_type == 'refund') {
                                                            $label = 'Advance Refund';
                                                            $badge = 'bg-danger';
                                                        } elseif($transaction->transaction_type == 'udhaar_return') {
                                                            $label = 'Udhaar Return';
                                                            $badge = 'bg-warning';
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $badge }}">
                                                        {{ $label }}
                                                    </span>
                                                </td>
                                                <td>{{ ucfirst($transaction->payment_method) }}</td>
                                                <td>{{ $transaction->reference_no ?? '-' }}</td>
                                                <td>₹{{ number_format($transaction->amount, 2) }}</td>
                                            </tr>
                                        @endforeach
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
