@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Chart of Accounts (Ledger Selection)</h2>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th>Account Name</th>
                                <th>Account Group</th>
                                <th>Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accounts as $account)
                            <tr>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->group->name }}</td>
                                <td>
                                    <span class="badge {{ in_array($account->group->type, ['Asset', 'Expense']) ? 'bg-info' : 'bg-secondary' }}">
                                        {{ $account->group->type }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('accounting.ledger', $account->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-book"></i> View Ledger
                                    </a>
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
@endsection
