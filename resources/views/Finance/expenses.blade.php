<?php $page = 'expenses'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Expenses
                @endslot
            @endcomponent
            <!-- /Page Header -->
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Expense ID</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <th>Payment Mode</th>
                                            <th>Notes</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($expenses as $expense)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}</td>
                                                <td>
                                                    <a href="javascript:void(0);"
                                                        class="invoice-link">EXP-{{ str_pad($expense->id, 4, '0', STR_PAD_LEFT) }}</a>
                                                </td>
                                                <td>{{ $expense->expenseAccount->name }}</td>
                                                <td>{{ number_format($expense->amount, 2) }}</td>
                                                <td>{{ $expense->paymentAccount->name }}</td>
                                                <td>{{ $expense->description }} </td>
                                                <td><span class="badge bg-success-light">Paid</span></td>
                                                <td class="d-flex align-items-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item edit-expense"
                                                                        data-id="{{ $expense->id }}"
                                                                        data-date="{{ $expense->expense_date }}"
                                                                        data-amount="{{ $expense->amount }}"
                                                                        data-category="{{ $expense->expense_account_id }}"
                                                                        data-payment="{{ $expense->payment_account_id }}"
                                                                        data-description="{{ $expense->description }}">
                                                                        <i class="far fa-edit me-2"></i>Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this expense?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item">
                                                                            <i class="far fa-trash-alt me-2"></i>Delete
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Table -->

        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add Expenses Modal -->
    <div class="modal custom-modal fade" id="add_expenses" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Add Expenses</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ route('expenses.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Expense Date <span class="text-danger">*</span></label>
                                    <input type="date" name="expense_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Amount <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Expense Category <span class="text-danger">*</span></label>
                                    <select name="expense_account_id" class="form-control select" required>
                                        <option value="">Select Category</option>
                                        @foreach ($expenseAccounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Payment Method <span class="text-danger">*</span></label>
                                    <select name="payment_account_id" class="form-control select" required>
                                        <option value="">Select Payment Method</option>
                                        @foreach ($paymentAccounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-back cancel-btn me-2">Cancel</button>
                        <button type="submit" class="btn btn-primary paid-continue-btn">Save Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Expenses Modal -->

    <!-- Edit Expenses Modal -->
    <div class="modal custom-modal fade" id="edit_expenses" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Edit Expenses</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="edit_expense_form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Expense Date <span class="text-danger">*</span></label>
                                    <input type="date" name="expense_date" id="edit_expense_date" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Amount <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="amount" id="edit_amount" class="form-control" placeholder="0.00" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Expense Category <span class="text-danger">*</span></label>
                                    <select name="expense_account_id" id="edit_expense_account_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($expenseAccounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Payment Method <span class="text-danger">*</span></label>
                                    <select name="payment_account_id" id="edit_payment_account_id" class="form-control" required>
                                        <option value="">Select Payment Method</option>
                                        @foreach ($paymentAccounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Description</label>
                                    <textarea name="description" id="edit_description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-back cancel-btn me-2">Cancel</button>
                        <button type="submit" class="btn btn-primary paid-continue-btn">Update Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Edit Expenses Modal -->

    <script>
        const EXPENSE_UPDATE_ROUTE = @json(route('expenses.update', ['expense' => '__ID__']));
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-expense');
            const editModal = new bootstrap.Modal(document.getElementById('edit_expenses'));
            const editForm = document.getElementById('edit_expense_form');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const date = this.getAttribute('data-date');
                    const amount = this.getAttribute('data-amount');
                    const category = this.getAttribute('data-category');
                    const payment = this.getAttribute('data-payment');
                    const description = this.getAttribute('data-description');

                    document.getElementById('edit_expense_date').value = date;
                    document.getElementById('edit_amount').value = amount;
                    document.getElementById('edit_expense_account_id').value = category;
                    document.getElementById('edit_payment_account_id').value = payment;
                    document.getElementById('edit_description').value = description;

                    editForm.action = EXPENSE_UPDATE_ROUTE.replace('__ID__', id);

                    // Optional: store ID if needed later
                    editForm.dataset.expenseId = id;

                    editModal.show();
                });
            });
        });
    </script>
@endsection
