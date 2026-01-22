<?php $page = 'expenses'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            @component('components.page-header')
                @slot('title')
                    Add Expense
                @endslot
            @endcomponent

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('expenses.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Expense Date <span class="text-danger">*</span></label>
                                            <input type="date" name="expense_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Amount <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Expense Category <span class="text-danger">*</span></label>
                                            <select name="expense_account_id" class="form-control select" required>
                                                <option value="">Select Category</option>
                                                @foreach ($expenseAccounts as $account)
                                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Payment Method <span class="text-danger">*</span></label>
                                            <select name="payment_account_id" class="form-control select" required>
                                                <option value="">Select Payment Method</option>
                                                @foreach ($paymentAccounts as $account)
                                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Save Expense</button>
                                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
