@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="container mt-5">
            <!-- Header Block -->
            <div class="d-flex justify-content-between align-items-center mb-4 p-4 rounded-4 shadow-sm bg-white" style="border-left: 5px solid #4f46e5;">
                <div>
                    <h2 class="fw-bold mb-1 text-dark" style="font-family: 'Outfit', sans-serif;">Chart of Accounts</h2>
                    <p class="text-muted mb-0 small">Create and manage your system and user-defined accounts</p>
                </div>
                <button type="button" class="btn btn-primary px-4 py-2 rounded-3 shadow" data-bs-toggle="modal" data-bs-target="#addAccountModal" style="background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); border: none; font-weight: 500; transition: all 0.3s ease;">
                    <i class="fas fa-plus-circle me-2"></i> Add Account
                </button>
            </div>

            <!-- Table Card -->
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden bg-white">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-uppercase text-secondary small fw-bold" style="letter-spacing: 0.5px;">
                                <tr>
                                    <th class="ps-4 py-3">Account Name</th>
                                    <th class="py-3">Account Group</th>
                                    <th class="py-3">Type</th>
                                    <th class="py-3">Sub-Type</th>
                                    <th class="text-end py-3">Opening Balance</th>
                                    <th class="text-center py-3">Bal Type</th>
                                    <th class="text-center pe-4 py-3" style="width: 280px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accounts as $account)
                                <tr style="transition: background-color 0.2s ease;">
                                    <td class="ps-4 fw-semibold text-dark">
                                        {{ $account->name }}
                                        @if($account->is_system)
                                            <span class="badge bg-secondary-light text-secondary ms-1 small px-2 py-1" style="font-size: 0.7rem; border-radius: 4px; font-weight: 500; background-color: #f3f4f6; color: #4b5563 !important;">System</span>
                                        @endif
                                    </td>
                                    <td class="text-secondary">{{ $account->group->name }}</td>
                                    <td>
                                        <span class="badge px-3 py-1.5 rounded-pill fw-medium" 
                                              style="font-size: 0.75rem; 
                                                     background-color: {{ $account->group->type === 'Asset' ? '#e0f2fe' : ($account->group->type === 'Liability' ? '#fef3c7' : ($account->group->type === 'Expense' ? '#fee2e2' : ($account->group->type === 'Income' ? '#dcfce7' : '#f3f4f6'))) }};
                                                     color: {{ $account->group->type === 'Asset' ? '#0369a1' : ($account->group->type === 'Liability' ? '#b45309' : ($account->group->type === 'Expense' ? '#b91c1c' : ($account->group->type === 'Income' ? '#15803d' : '#4b5563'))) }};">
                                            {{ $account->group->type }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge px-3 py-1.5 rounded-pill text-uppercase fw-medium"
                                              style="font-size: 0.75rem;
                                                     background-color: {{ $account->sub_type === 'bank' ? '#e0e7ff' : ($account->sub_type === 'card' ? '#fae8ff' : ($account->sub_type === 'upi' ? '#d1fae5' : '#f3f4f6')) }};
                                                     color: {{ $account->sub_type === 'bank' ? '#4338ca' : ($account->sub_type === 'card' ? '#a21caf' : ($account->sub_type === 'upi' ? '#065f46' : '#4b5563')) }};">
                                            {{ $account->sub_type }}
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold text-dark">
                                        {{ number_format($account->opening_balance, 2) }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge px-2.5 py-1 fw-bold text-uppercase" 
                                              style="font-size: 0.75rem; border-radius: 4px;
                                                     background-color: {{ $account->opening_balance_type === 'dr' ? '#dcfce7' : '#fee2e2' }};
                                                     color: {{ $account->opening_balance_type === 'dr' ? '#15803d' : '#b91c1c' }};">
                                            {{ $account->opening_balance_type }}
                                        </span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('accounting.ledger', $account->id) }}" class="btn btn-sm btn-outline-primary px-3 rounded-3" style="font-weight: 500;">
                                                <i class="fas fa-book me-1"></i> Ledger
                                            </a>
                                            
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-secondary edit-account-btn px-3 rounded-3"
                                                    data-id="{{ $account->id }}"
                                                    data-name="{{ $account->name }}"
                                                    data-type="{{ $account->group->type }}"
                                                    data-subtype="{{ $account->sub_type }}"
                                                    data-balance="{{ $account->opening_balance }}"
                                                    data-baltype="{{ $account->opening_balance_type }}"
                                                    data-issystem="{{ $account->is_system ? 1 : 0 }}"
                                                    style="font-weight: 500;">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </button>

                                            @if(!$account->is_system)
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger delete-account-btn px-3 rounded-3"
                                                    data-id="{{ $account->id }}"
                                                    data-name="{{ $account->name }}"
                                                    style="font-weight: 500;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-sm btn-outline-danger px-3 rounded-3 disabled" disabled style="opacity: 0.4;">
                                                <i class="fas fa-lock"></i>
                                            </button>
                                            @endif
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
</div>

<!-- Add Account Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 bg-light py-3" style="border-top-left-radius: 16px; border-top-right-radius: 16px;">
                <h5 class="modal-title fw-bold text-dark" id="addAccountModalLabel"><i class="fas fa-plus-circle me-2 text-primary"></i>Add New Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addAccountForm">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Account Name</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="e.g. HDFC Current Account" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary">Account Type</label>
                            <select name="account_type" class="form-select rounded-3" required>
                                <option value="Asset">Asset</option>
                                <option value="Liability">Liability</option>
                                <option value="Expense">Expense</option>
                                <option value="Income">Income</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary">Sub-Type</label>
                            <select name="sub_type" class="form-select rounded-3" required>
                                <option value="normal">Normal</option>
                                <option value="bank">Bank</option>
                                <option value="card">Card</option>
                                <option value="upi">UPI</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label class="form-label fw-semibold text-secondary">Opening Balance</label>
                            <input type="number" step="0.01" name="opening_balance" class="form-control rounded-3" value="0.00" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-semibold text-secondary">Balance Type</label>
                            <select name="opening_balance_type" class="form-select rounded-3" required>
                                <option value="dr">Debit (DR)</option>
                                <option value="cr">Credit (CR)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 py-2 rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3" style="background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); border: none;">Save Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Account Modal -->
<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 bg-light py-3" style="border-top-left-radius: 16px; border-top-right-radius: 16px;">
                <h5 class="modal-title fw-bold text-dark" id="editAccountModalLabel"><i class="fas fa-edit me-2 text-warning"></i>Edit Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAccountForm">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Account Name</label>
                        <input type="text" name="name" class="form-control rounded-3" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary">Account Type</label>
                            <select name="account_type" class="form-select rounded-3" required>
                                <option value="Asset">Asset</option>
                                <option value="Liability">Liability</option>
                                <option value="Expense">Expense</option>
                                <option value="Income">Income</option>
                            </select>
                            <small class="text-danger mt-1" id="issystem-warning" style="display: none; font-size: 0.75rem;">
                                <i class="fas fa-info-circle me-1"></i>System account type cannot be changed.
                            </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-secondary">Sub-Type</label>
                            <select name="sub_type" class="form-select rounded-3" required>
                                <option value="normal">Normal</option>
                                <option value="bank">Bank</option>
                                <option value="card">Card</option>
                                <option value="upi">UPI</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label class="form-label fw-semibold text-secondary">Opening Balance</label>
                            <input type="number" step="0.01" name="opening_balance" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-semibold text-secondary">Balance Type</label>
                            <select name="opening_balance_type" class="form-select rounded-3" required>
                                <option value="dr">Debit (DR)</option>
                                <option value="cr">Credit (CR)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 py-2 rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3" style="background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); border: none;">Update Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Add Account Form Submit
    $('#addAccountForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');

        $.ajax({
            url: "{{ route('accounting.accounts.store') }}",
            method: "POST",
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message || 'Something went wrong.');
                    submitBtn.prop('disabled', false).text('Save Account');
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON;
                alert(errors.message || 'Validation failed. Please check your input.');
                submitBtn.prop('disabled', false).text('Save Account');
            }
        });
    });

    // Populate Edit Modal
    $('.edit-account-btn').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var type = $(this).data('type');
        var subtype = $(this).data('subtype');
        var balance = $(this).data('balance');
        var baltype = $(this).data('baltype');
        var issystem = $(this).data('issystem');

        var modal = $('#editAccountModal');
        modal.find('form').attr('action', '/accounting/accounts/' + id);
        modal.find('[name="name"]').val(name);
        modal.find('[name="sub_type"]').val(subtype);
        modal.find('[name="opening_balance"]').val(balance);
        modal.find('[name="opening_balance_type"]').val(baltype);

        var typeSelect = modal.find('[name="account_type"]');
        typeSelect.val(type);
        if (issystem == 1) {
            typeSelect.attr('disabled', true);
            modal.find('#issystem-warning').show();
        } else {
            typeSelect.attr('disabled', false);
            modal.find('#issystem-warning').hide();
        }

        modal.modal('show');
    });

    // Edit Account Form Submit
    $('#editAccountForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');

        var actionUrl = form.attr('action');

        // Temporarily enable fields so they are serialized
        var typeSelect = form.find('[name="account_type"]');
        var wasDisabled = typeSelect.is(':disabled');
        if (wasDisabled) {
            typeSelect.prop('disabled', false);
        }

        var formData = form.serialize();

        if (wasDisabled) {
            typeSelect.prop('disabled', true);
        }

        $.ajax({
            url: actionUrl,
            method: "POST", // Standard Laravel way using post method and _method=PUT in form serialization
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message || 'Something went wrong.');
                    submitBtn.prop('disabled', false).text('Update Account');
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON;
                alert(errors.message || 'Validation failed. Please check your input.');
                submitBtn.prop('disabled', false).text('Update Account');
            }
        });
    });

    // Delete Account Handler
    $('.delete-account-btn').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        
        if (confirm('Are you sure you want to delete the account "' + name + '"? This action cannot be undone.')) {
            $.ajax({
                url: '/accounting/accounts/' + id,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message || 'Failed to delete account.');
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON;
                    alert(errors.message || 'An error occurred while deleting.');
                }
            });
        }
    });
});
</script>
@endsection
