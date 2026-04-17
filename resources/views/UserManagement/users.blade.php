<?php $page = 'users'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        @component('components.page-header')
        @slot('title')
        Usersr
        @endslot
        @endcomponent
         @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
        <!-- /Page Header -->
        @if (Route::is(['createAdmin']))
        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover " id="example">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>User admin 1Name</th>
                                        <th>Mobile Number</th>
                                        <th>Role </th>

                                        <th>Created on</th>
                                        <th>Status</th>
                                        <th Class="no-sort">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            <h2 class="table-avatar">

                                                <a href="{{ url('profile') }}">{{ $user->name }}
                                                    <span>{{ $user->email }}</span>
                                                </a>
                                            </h2>
                                        </td>
                                        <td>{{ $user->phone ?? 'N/A' }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : 'N/A' }}</td>
                                        <td>
                                            <span class="{{ $user->status == 'active' ? 'text-success' : 'text-danger' }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item edit-user-btn" href="javascript:void(0);"
                                                                data-bs-toggle="modal" data-bs-target="#edit_user"
                                                                data-id="{{ $user->id }}"
                                                                data-name="{{ $user->name }}"
                                                                data-email="{{ $user->email }}"
                                                                data-phone="{{ $user->phone }}"
                                                                data-status="{{ $user->status }}"
                                                                data-address="{{ $user->address }}"
                                                                data-city="{{ $user->city }}"
                                                                data-state="{{ $user->state }}"
                                                                data-pincode="{{ $user->pincode }}">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item delete-user-btn" href="javascript:void(0);"
                                                                data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                                data-id="{{ $user->id }}">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
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
        @endif

    </div>
</div>
<!-- jQuery (Load First) -->




<script>
    $(document).ready(function () {
        console.log("DataTables Loaded:", typeof $.fn.DataTable);
        console.log("Buttons Loaded:", $.fn.DataTable.Buttons ? "Yes" : "No");

        var table = $("#example").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            dom: 'Bfrtip',  // Important for Buttons
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        if ($.fn.DataTable.Buttons) {
            console.log("Appending Buttons...");
            table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        } else {
            console.error("Buttons extension is missing!");
        }
    });
</script>



<!-- Edit User Modal -->
<div id="edit_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User22</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="edit_user_form">
                    @csrf
                    @method('PUT')
                    <div class="row">

    <!-- Name -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" id="edit_name">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Email -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" id="edit_email">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Phone -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" name="phone" id="edit_phone">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Password -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Password (Leave blank to keep current)</label>
            <input type="password" class="form-control" name="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Address -->
    <div class="col-md-12">
        <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" name="address" id="edit_address"></textarea>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- City -->
    <div class="col-md-4">
        <div class="form-group">
            <label>City</label>
            <input type="text" class="form-control" name="city" id="edit_city">
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- State -->
    <div class="col-md-4">
        <div class="form-group">
            <label>State</label>
           <select class="form-control searchable-select" name="state" id="edit_state"> <option value="">Select State</option> @foreach(['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Andaman and Nicobar Islands', 'Chandigarh', 'Dadra and Nagar Haveli and Daman and Diu', 'Delhi', 'Jammu and Kashmir', 'Ladakh', 'Lakshadweep', 'Puducherry'] as $stateName) <option value="{{ $stateName }}">{{ $stateName }}</option> @endforeach </select>
            @error('state')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Pincode -->
    <div class="col-md-4">
        <div class="form-group">
            <label>Pincode</label>
            <input type="text" class="form-control" name="pincode" id="edit_pincode">
            @error('pincode')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Status -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Status</label>
            <select class="select" name="status" id="edit_status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Update</button>
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
                <div class="form-header">
                    <h3>Delete User</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <form action="" method="POST" id="delete_user_form">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary continue-btn w-100">Delete</button>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn w-100">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete User Modal -->

<!-- /Page Wrapper -->
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // Edit User
        $(document).on('click', '.edit-user-btn', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var phone = $(this).data('phone');
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
            $('#edit_status').val(status).change();
            $('#edit_address').val(address);
            $('#edit_city').val(city);
            $('#edit_state').val(state).trigger('change');
            $('#edit_pincode').val(pincode);
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
                dropdownParent: $('#add_user'), // Ensure dropdown works inside modal
                width: '100%',
                placeholder: 'Select State'
            });

            // For edit modal
            $('#edit_user').on('shown.bs.modal', function () {
                $('.searchable-select').select2({
                    dropdownParent: $('#edit_user'),
                    width: '100%',
                    placeholder: 'Select State'
                });
            });
        }
    });
</script>
@endsection
