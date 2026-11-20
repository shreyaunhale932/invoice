<?php $page = 'users'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        @component('components.page-header')
        @slot('title')
        User
        @endslot
        @endcomponent

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- /Page Header -->
        @if (Route::is(['createAdmin']))
        <div class="row">
            <div class="col-sm-12">
                <div class="card p-3">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover" id="example">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>User / Admin</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Role</th>
                                            <th>Company</th>
                                            <th>Location</th>
                                            <th>Database</th>
                                            <th>Status</th>
                                            <th>Created on</th>
                                            <th class="no-sort text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        @php
                                            $locationParts = array_filter([$user->city, $user->state]);
                                            $locationStr = implode(', ', $locationParts);
                                            $initial = strtoupper(substr($user->name ?? 'A', 0, 1));
                                        @endphp
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="javascript:void(0);" class="view-user-btn d-flex align-items-center"
                                                        data-bs-toggle="modal" data-bs-target="#view_user_modal"
                                                        data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}"
                                                        data-username="{{ $user->username }}"
                                                        data-email="{{ $user->email }}"
                                                        data-phone="{{ $user->phone ?? 'N/A' }}"
                                                        data-company="{{ $user->company ?? 'N/A' }}"
                                                        data-role="Admin"
                                                        data-status="{{ $user->status }}"
                                                        data-verification="{{ $user->verification_status ?? 'pending' }}"
                                                        data-dbname="{{ $user->db_name ?? 'N/A' }}"
                                                        data-address="{{ $user->address ?? 'N/A' }}"
                                                        data-city="{{ $user->city ?? 'N/A' }}"
                                                        data-state="{{ $user->state ?? 'N/A' }}"
                                                        data-pincode="{{ $user->pincode ?? 'N/A' }}"
                                                        data-created="{{ $user->created_at ? $user->created_at->format('d M Y, h:i A') : 'N/A' }}"
                                                        data-updated="{{ $user->updated_at ? $user->updated_at->format('d M Y, h:i A') : 'N/A' }}"
                                                        title="Click to view full details">
                                                        <span class="avatar avatar-sm me-2 bg-primary-light text-primary rounded-circle d-inline-flex align-items-center justify-content-center fw-bold">
                                                            {{ $initial }}
                                                        </span>
                                                        <span>
                                                            <strong class="text-dark">{{ $user->name }}</strong>
                                                            <span class="d-block text-muted small">&#64;{{ $user->username }}</span>
                                                        </span>
                                                    </a>
                                                </h2>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}" class="text-muted">{{ $user->email }}</a>
                                            </td>
                                            <td>{{ $user->phone ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-primary-light text-primary">
                                                    <i class="fas fa-user-shield me-1"></i>Admin
                                                </span>
                                            </td>
                                            <td>{{ $user->company ?: '-' }}</td>
                                            <td>{{ $locationStr ?: ($user->address ?: '-') }}</td>
                                            <td>
                                                @if ($user->db_name)
                                                    <span class="badge bg-secondary-light text-secondary">
                                                        <i class="fas fa-database me-1"></i>{{ $user->db_name }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $user->status == 'active' ? 'bg-success-light text-success' : 'bg-danger-light text-danger' }}">
                                                    <i class="fas fa-circle me-1" style="font-size: 8px;"></i>{{ ucfirst($user->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : 'N/A' }}</td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item view-user-btn" href="javascript:void(0);"
                                                                    data-bs-toggle="modal" data-bs-target="#view_user_modal"
                                                                    data-id="{{ $user->id }}"
                                                                    data-name="{{ $user->name }}"
                                                                    data-username="{{ $user->username }}"
                                                                    data-email="{{ $user->email }}"
                                                                    data-phone="{{ $user->phone ?? 'N/A' }}"
                                                                    data-company="{{ $user->company ?? 'N/A' }}"
                                                                    data-role="Admin"
                                                                    data-status="{{ $user->status }}"
                                                                    data-verification="{{ $user->verification_status ?? 'pending' }}"
                                                                    data-dbname="{{ $user->db_name ?? 'N/A' }}"
                                                                    data-address="{{ $user->address ?? 'N/A' }}"
                                                                    data-city="{{ $user->city ?? 'N/A' }}"
                                                                    data-state="{{ $user->state ?? 'N/A' }}"
                                                                    data-pincode="{{ $user->pincode ?? 'N/A' }}"
                                                                    data-created="{{ $user->created_at ? $user->created_at->format('d M Y, h:i A') : 'N/A' }}"
                                                                    data-updated="{{ $user->updated_at ? $user->updated_at->format('d M Y, h:i A') : 'N/A' }}">
                                                                    <i class="far fa-eye me-2 text-info"></i>View Details
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item edit-user-btn" href="javascript:void(0);"
                                                                    data-bs-toggle="modal" data-bs-target="#edit_user"
                                                                    data-id="{{ $user->id }}"
                                                                    data-name="{{ $user->name }}"
                                                                    data-username="{{ $user->username }}"
                                                                    data-email="{{ $user->email }}"
                                                                    data-phone="{{ $user->phone }}"
                                                                    data-company="{{ $user->company }}"
                                                                    data-status="{{ $user->status }}"
                                                                    data-address="{{ $user->address }}"
                                                                    data-city="{{ $user->city }}"
                                                                    data-state="{{ $user->state }}"
                                                                    data-pincode="{{ $user->pincode }}">
                                                                    <i class="far fa-edit me-2 text-warning"></i>Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item delete-user-btn" href="javascript:void(0);"
                                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                                    data-id="{{ $user->id }}">
                                                                    <i class="far fa-trash-alt me-2 text-danger"></i>Delete
                                                                </a>
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
        </div>
        @endif
    </div>
</div>

<!-- View User Details Modal -->
<div id="view_user_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0"><i class="fas fa-id-card text-primary me-2"></i>User Full Details</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <!-- User Profile Header Card -->
                <div class="card bg-light border-0 mb-4 p-3 rounded-3">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fs-2 fw-bold" id="view_avatar_initial" style="width: 60px; height: 60px;">
                            U
                        </div>
                        <div class="flex-grow-1">
                            <h4 class="mb-1" id="view_name">-</h4>
                            <p class="text-muted mb-2"><i class="fas fa-at me-1"></i><span id="view_username">-</span></p>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-primary-light text-primary" id="view_role_badge">
                                    <i class="fas fa-shield-alt me-1"></i>Admin
                                </span>
                                <span class="badge" id="view_status_badge">Active</span>
                                <span class="badge" id="view_verification_badge">Verified</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="text-muted small">User ID</span>
                            <h5 class="text-primary mb-0" id="view_id_display">#1</h5>
                        </div>
                    </div>
                </div>

                <!-- Detail Cards Grid -->
                <div class="row g-3">
                    <!-- Contact Details -->
                    <div class="col-md-6">
                        <div class="card h-100 border p-3 shadow-none">
                            <h6 class="text-uppercase text-muted fw-bold small mb-3">
                                <i class="fas fa-address-book text-primary me-2"></i>Contact Information
                            </h6>
                            <div class="mb-2">
                                <label class="text-muted small d-block mb-1">Email Address</label>
                                <span class="fw-semibold text-dark" id="view_email">-</span>
                            </div>
                            <div class="mb-0">
                                <label class="text-muted small d-block mb-1">Mobile / Phone Number</label>
                                <span class="fw-semibold text-dark" id="view_phone">-</span>
                            </div>
                        </div>
                    </div>

                    <!-- Business / Tenant Information -->
                    <div class="col-md-6">
                        <div class="card h-100 border p-3 shadow-none">
                            <h6 class="text-uppercase text-muted fw-bold small mb-3">
                                <i class="fas fa-building text-primary me-2"></i>Business & Tenant Information
                            </h6>
                            <div class="mb-2">
                                <label class="text-muted small d-block mb-1">Company Name</label>
                                <span class="fw-semibold text-dark" id="view_company">-</span>
                            </div>
                            <div class="mb-0">
                                <label class="text-muted small d-block mb-1">Tenant Database</label>
                                <div>
                                    <span class="badge bg-secondary-light text-secondary fs-13" id="view_dbname">
                                        <i class="fas fa-database me-1"></i>-
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="col-md-12">
                        <div class="card border p-3 mb-0 shadow-none">
                            <h6 class="text-uppercase text-muted fw-bold small mb-3">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>Address & Location
                            </h6>
                            <div class="row g-2">
                                <div class="col-md-6 mb-2">
                                    <label class="text-muted small d-block mb-1">Street Address</label>
                                    <span class="fw-semibold text-dark" id="view_address">-</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="text-muted small d-block mb-1">City</label>
                                    <span class="fw-semibold text-dark" id="view_city">-</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="text-muted small d-block mb-1">State</label>
                                    <span class="fw-semibold text-dark" id="view_state">-</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="text-muted small d-block mb-1">Pincode</label>
                                    <span class="fw-semibold text-dark" id="view_pincode">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Information -->
                    <div class="col-md-12">
                        <div class="card border p-3 mb-0 bg-light shadow-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="far fa-calendar-alt me-1"></i>Registered / Created On
                                    </label>
                                    <span class="fw-semibold text-dark" id="view_created">-</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="far fa-clock me-1"></i>Last Updated
                                    </label>
                                    <span class="fw-semibold text-dark" id="view_updated">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-primary" id="view_modal_edit_btn">
                    <i class="far fa-edit me-1"></i>Edit User
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /View User Details Modal -->

<!-- Edit User Modal -->
<div id="edit_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">Edit User / Admin</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="edit_user_form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Name -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="edit_name" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="edit_email" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" id="edit_phone" required>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Company -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label>Company</label>
                                <input type="text" class="form-control" name="company" id="edit_company" placeholder="Enter Company Name">
                                @error('company')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label>Password (Leave blank to keep current)</label>
                                <input type="password" class="form-control" name="password" placeholder="New Password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status" id="edit_status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group mb-3">
                                <label>Address</label>
                                <textarea class="form-control" name="address" id="edit_address" rows="2" placeholder="Enter Street Address"></textarea>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- City -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label>City</label>
                                <input type="text" class="form-control" name="city" id="edit_city" placeholder="Enter City">
                                @error('city')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- State -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label>State</label>
                                <select class="form-control searchable-select" name="state" id="edit_state">
                                    <option value="">Select State</option>
                                    @foreach(['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Andaman and Nicobar Islands', 'Chandigarh', 'Dadra and Nagar Haveli and Daman and Diu', 'Delhi', 'Jammu and Kashmir', 'Ladakh', 'Lakshadweep', 'Puducherry'] as $stateName)
                                        <option value="{{ $stateName }}">{{ $stateName }}</option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Pincode -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label>Pincode</label>
                                <input type="text" class="form-control" name="pincode" id="edit_pincode" placeholder="Enter Pincode">
                                @error('pincode')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="submit-section mt-3 text-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary submit-btn">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit User Modal -->

<!-- Delete User Modal -->
<div class="modal custom-modal fade" id="delete_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header text-center">
                    <h3>Delete User</h3>
                    <p>Are you sure you want to delete this admin and their database? This action cannot be undone.</p>
                </div>
                <div class="modal-btn delete-action mt-3">
                    <form action="" method="POST" id="delete_user_form">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-danger continue-btn w-100">Delete</button>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-secondary cancel-btn w-100">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete User Modal -->

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // Initialize DataTable
        if (!$.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable({
                responsive: true,
                autoWidth: false,
                ordering: true,
                columnDefs: [
                    { targets: 'no-sort', orderable: false }
                ],
                language: {
                    search: ' ',
                    searchPlaceholder: 'Search users...'
                }
            });
        }

        // View User Details
        var currentActiveUserId = null;
        $(document).on('click', '.view-user-btn', function () {
            var id = $(this).data('id');
            currentActiveUserId = id;

            var name = $(this).data('name') || 'N/A';
            var username = $(this).data('username') || 'N/A';
            var email = $(this).data('email') || 'N/A';
            var phone = $(this).data('phone') || 'N/A';
            var company = $(this).data('company') || 'N/A';
            var role = $(this).data('role') || 'Admin';
            var status = String($(this).data('status') || 'active');
            var verification = String($(this).data('verification') || 'pending');
            var dbname = $(this).data('dbname') || 'N/A';
            var address = $(this).data('address') || 'N/A';
            var city = $(this).data('city') || 'N/A';
            var state = $(this).data('state') || 'N/A';
            var pincode = $(this).data('pincode') || 'N/A';
            var created = $(this).data('created') || 'N/A';
            var updated = $(this).data('updated') || 'N/A';

            $('#view_id_display').text('#' + id);
            $('#view_name').text(name);
            $('#view_avatar_initial').text(name.charAt(0).toUpperCase());
            $('#view_username').text(username);
            $('#view_email').text(email);
            $('#view_phone').text(phone);
            $('#view_company').text(company);
            $('#view_role_badge').html('<i class="fas fa-shield-alt me-1"></i>' + role);
            $('#view_dbname').html('<i class="fas fa-database me-1"></i>' + dbname);
            $('#view_address').text(address);
            $('#view_city').text(city);
            $('#view_state').text(state);
            $('#view_pincode').text(pincode);
            $('#view_created').text(created);
            $('#view_updated').text(updated);

            if (status.toLowerCase() === 'active') {
                $('#view_status_badge').removeClass('bg-danger-light text-danger').addClass('badge bg-success-light text-success').text('Active');
            } else {
                $('#view_status_badge').removeClass('bg-success-light text-success').addClass('badge bg-danger-light text-danger').text('Inactive');
            }

            if (verification.toLowerCase() === 'verified') {
                $('#view_verification_badge').removeClass('bg-warning-light text-warning').addClass('badge bg-success-light text-success').text('Verified');
            } else {
                $('#view_verification_badge').removeClass('bg-success-light text-success').addClass('badge bg-warning-light text-warning').text('Pending Verification');
            }

            $('#view_modal_edit_btn').data('id', id);
        });

        // Trigger Edit from View Modal
        $('#view_modal_edit_btn').on('click', function() {
            var userId = $(this).data('id') || currentActiveUserId;
            $('#view_user_modal').modal('hide');
            setTimeout(function() {
                $('.edit-user-btn[data-id="' + userId + '"]').first().trigger('click');
            }, 350);
        });

        // Edit User
        $(document).on('click', '.edit-user-btn', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var phone = $(this).data('phone');
            var company = $(this).data('company');
            var status = $(this).data('status');
            var address = $(this).data('address');
            var city = $(this).data('city');
            var state = $(this).data('state');
            var pincode = $(this).data('pincode');

            var url = "{{ route('admin.update', ':id') }}";
            url = url.replace(':id', id);

            $('#edit_user_form').attr('action', url);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_phone').val(phone);
            $('#edit_company').val(company === 'N/A' ? '' : company);
            $('#edit_status').val(status).change();
            $('#edit_address').val(address === 'N/A' ? '' : address);
            $('#edit_city').val(city === 'N/A' ? '' : city);
            $('#edit_state').val(state === 'N/A' ? '' : state).trigger('change');
            $('#edit_pincode').val(pincode === 'N/A' ? '' : pincode);
        });

        // Delete User
        $(document).on('click', '.delete-user-btn', function () {
            var id = $(this).data('id');
            var url = "{{ route('admin.destroy', ':id') }}";
            url = url.replace(':id', id);
            $('#delete_user_form').attr('action', url);
        });

        // Initialize Searchable Select2
        if ($('.searchable-select').length > 0) {
            $('.searchable-select').select2({
                dropdownParent: $('#add_user'),
                width: '100%',
                placeholder: 'Select State'
            });

            // For edit modal
            $('#edit_user').on('shown.bs.modal', function () {
                $(this).find('.searchable-select').select2({
                    dropdownParent: $('#edit_user'),
                    width: '100%',
                    placeholder: 'Select State'
                });
            });
        }
    });
</script>
@endsection
