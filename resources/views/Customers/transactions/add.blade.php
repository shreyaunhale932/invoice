@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            @component('components.page-header')
                @slot('title')
                    New Customer Transaction
                @endslot
            @endcomponent

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('customer.transactions.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $parent_id ?? '' }}">
                                <input type="hidden" name="invoice_id" value="{{ $invoice_id ?? ($original->invoice_id ?? '') }}">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Customer <span class="text-danger">*</span></label>
                                            @if(isset($parent_id) || isset($invoice_id))
                                                <select class="form-control select2" disabled>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}" {{ (old('customer_id', $customer_id ?? '') == $customer->id) ? 'selected' : '' }}>
                                                            {{ $customer->name }} ({{ $customer->phone }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="customer_id" value="{{ $customer_id ?? '' }}">
                                            @else
                                                <select name="customer_id" class="form-control select2" required>
                                                    <option value="">-- Choose Customer --</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                            {{ $customer->name }} ({{ $customer->phone }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @error('customer_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Transaction Date <span class="text-danger">*</span></label>
                                            <input type="date" name="transaction_date" class="form-control" value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                                            @error('transaction_date') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Transaction Type <span class="text-danger">*</span></label>
                                            @if(isset($parent_id) || isset($invoice_id))
                                                <select class="form-control" disabled>
                                                    @if(isset($transaction_type) && $transaction_type == 'udhaar_return')
                                                        <option value="udhaar_return" selected>Udhaar Return (Money Out)</option>
                                                    @else
                                                        <option value="refund" selected>Advance Refund to Customer (Money Out)</option>
                                                    @endif
                                                </select>
                                                <input type="hidden" name="transaction_type" value="{{ $transaction_type ?? 'refund' }}">
                                            @else
                                                <select name="transaction_type" class="form-control" required>
                                                    <option value="advance" {{ (old('transaction_type', $transaction_type ?? '') == 'advance') ? 'selected' : '' }}>Advance Receipt (Money In)</option>
                                                    <option value="udhaar_payment" {{ (old('transaction_type', $transaction_type ?? '') == 'udhaar_payment') ? 'selected' : '' }}>Udhaar Get / Collection (Money In)</option>
                                                    <option value="refund" {{ (old('transaction_type', $transaction_type ?? '') == 'refund') ? 'selected' : '' }}>Advance Refund to Customer (Money Out)</option>
                                                    <option value="udhaar_return" {{ (old('transaction_type', $transaction_type ?? '') == 'udhaar_return') ? 'selected' : '' }}>Udhaar Return (Money Out)</option>
                                                </select>
                                            @endif
                                            @error('transaction_type') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Payment Method <span class="text-danger">*</span></label>
                                            <select name="payment_method" class="form-control" required>
                                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="bank" {{ old('payment_method') == 'bank' ? 'selected' : '' }}>Bank / Cheque</option>
                                                <option value="online" {{ old('payment_method') == 'online' ? 'selected' : '' }}>Online / UPI</option>
                                            </select>
                                            @error('payment_method') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Amount <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" value="{{ old('amount', $amount ?? '') }}" required>
                                            @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Reference No (Cheque / UPI ID)</label>
                                            <input type="text" name="reference_no" class="form-control" placeholder="Ref No" value="{{ old('reference_no') }}">
                                            @error('reference_no') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Narration</label>
                                            <textarea name="narration" class="form-control" rows="3" placeholder="Description/Notes">{{ old('narration', $narration ?? '') }}</textarea>
                                            @error('narration') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Save Transaction</button>
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
