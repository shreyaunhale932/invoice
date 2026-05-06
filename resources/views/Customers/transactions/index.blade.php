@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            @component('components.page-header')
                @slot('title')
                    Customer Transactions
                @endslot
            @endcomponent

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Transaction List</h5>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('customer.transactions.add') }}" class="btn btn-primary">
                                        <i class="fa fa-plus-circle me-1"></i> Add Transaction
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Customer</th>
                                            <th>Type</th>
                                            <th>Method</th>
                                            <th>Amount</th>
                                            <th>Ref No</th>
                                            <th class="no-sort">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}</td>
                                                <td>
                                                    @if($transaction->customer)
                                                        <a href="#">
                                                            {{ $transaction->customer->name }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $badgeClass = 'bg-info-light text-info';
                                                        $label = 'Transaction';
                                                        if($transaction->transaction_type == 'advance') {
                                                            $badgeClass = 'bg-success-light text-success';
                                                            $label = 'Advance Receipt';
                                                        } elseif($transaction->transaction_type == 'udhaar_payment') {
                                                            $badgeClass = 'bg-primary-light text-primary';
                                                            $label = 'Udhaar Get';
                                                        } elseif($transaction->transaction_type == 'refund') {
                                                            $badgeClass = 'bg-danger-light text-danger';
                                                            $label = 'Advance Refund';
                                                        } elseif($transaction->transaction_type == 'udhaar_return') {
                                                            $badgeClass = 'bg-warning-light text-warning';
                                                            $label = 'Udhaar Return';
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">
                                                        {{ $label }}
                                                    </span>
                                                </td>
                                                <td>{{ ucfirst($transaction->payment_method) }}</td>
                                                <td>₹{{ number_format($transaction->amount, 2) }}</td>
                                                <td>{{ $transaction->reference_no ?? '-' }}</td>
                                                <td class="text-end">
                                                    @if($transaction->canBeRefunded())
                                                        @php
                                                            $btnLabel = $transaction->transaction_type == 'udhaar_payment' ? 'Return' : 'Refund';
                                                        @endphp
                                                        <a href="{{ route('customer.transactions.refund', $transaction->id) }}" class="btn btn-sm btn-white text-danger me-2" title="{{ $btnLabel }}">
                                                            <i class="fe fe-corner-up-left"></i> {{ $btnLabel }}
                                                        </a>
                                                    @endif
                                                    @if(!in_array($transaction->transaction_type, ['refund', 'udhaar_return']))
                                                        <a href="{{ route('customer.transactions.edit', $transaction->id) }}" class="btn btn-sm btn-white text-info me-2" title="Edit">
                                                            <i class="fe fe-edit"></i> Edit
                                                        </a>
                                                    @endif
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteAction('{{ route('customer.transactions.destroy', $transaction->id) }}')">
                                                        <i class="far fa-trash-alt me-1"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $transactions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal custom-modal fade modal-delete" id="delete_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Transaction</h3>
                        <p>Are you sure you want to delete this transaction? This will also adjust the ledger.</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="modal-footer justify-content-center p-0">
                            <form id="delete_form" action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary paid-continue-btn me-2">Yes, Delete</button>
                            </form>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-back cancel-btn">No, Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setDeleteAction(action) {
            document.getElementById('delete_form').action = action;
        }
    </script>
@endsection
