@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            @component('components.page-header')
                @slot('title')
                    Edit Customer Transaction
                @endslot
            @endcomponent

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('customer.transactions.update', $transaction->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Customer <span class="text-danger">*</span></label>
                                            <select name="customer_id" class="form-control select2" required>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ $transaction->customer_id == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->name }} ({{ $customer->phone }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Transaction Date <span class="text-danger">*</span></label>
                                            <input type="date" name="transaction_date" class="form-control" value="{{ $transaction->transaction_date }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Transaction Type <span class="text-danger">*</span></label>
                                            <select name="transaction_type" class="form-control" required>
                                                <option value="advance" {{ $transaction->transaction_type == 'advance' ? 'selected' : '' }}>Advance Receipt (Money In)</option>
                                                <option value="udhaar_payment" {{ $transaction->transaction_type == 'udhaar_payment' ? 'selected' : '' }}>Udhaar Get / Collection (Money In)</option>
                                                {{-- <option value="refund" {{ $transaction->transaction_type == 'refund' ? 'selected' : '' }}>Advance Refund to Customer (Money Out)</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Payment Method <span class="text-danger">*</span></label>
                                            <select name="payment_method" class="form-control" required>
                                                <option value="cash" {{ $transaction->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="bank" {{ $transaction->payment_method == 'bank' ? 'selected' : '' }}>Bank / Cheque</option>
                                                <option value="online" {{ $transaction->payment_method == 'online' ? 'selected' : '' }}>Online / UPI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Amount <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $transaction->amount }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Reference No</label>
                                            <input type="text" name="reference_no" class="form-control" value="{{ $transaction->reference_no }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Narration</label>
                                            <textarea name="narration" class="form-control" rows="3">{{ $transaction->narration }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update Transaction</button>
                                    <a href="{{ route('customer.transactions.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
