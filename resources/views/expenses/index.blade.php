<?php $page = 'expenses'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            @component('components.page-header')
                @slot('title')
                    Expenses
                @endslot
                @slot('add_button')
                    <a href="{{ route('expenses.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle me-2"></i> Add Expense</a>
                @endslot
            @endcomponent

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Expense Category</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($expenses as $expense)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d-m-Y') }}</td>
                                                <td>{{ $expense->expenseAccount->name }}</td>
                                                <td>{{ $expense->paymentAccount->name }}</td>
                                                <td>{{ number_format($expense->amount, 2) }}</td>
                                                <td>{{ $expense->description }}</td>
                                                <td class="text-end">
                                                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-white text-danger me-2" onclick="return confirm('Are you sure you want to delete this expense?')">
                                                            <i class="far fa-trash-alt me-1"></i> Delete
                                                        </button>
                                                    </form>
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
        </div>
    </div>
@endsection
