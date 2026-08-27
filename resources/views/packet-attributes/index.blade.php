@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="page-title fw-bold">{{ ucfirst($type) }} Master</h5>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ ucfirst($type) }}</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="javascript:void(0);" class="btn btn-primary me-1" data-bs-toggle="modal"
                            data-bs-target="#add_attribute">
                            <i class="fas fa-plus"></i> Add {{ ucfirst(Str::singular($type)) }}
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table p-2">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Short Code</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attributes as $attribute)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $attribute->name }}</td>
                                                <td>{{ $attribute->short_code }}</td>
                                                <td class="text-end">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item edit-attribute" href="javascript:void(0);"
                                                                data-id="{{ $attribute->id }}"
                                                                data-name="{{ $attribute->name }}"
                                                                data-short_code="{{ $attribute->short_code }}">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </a>
                                                            <form
                                                                action="{{ route('packet-attributes.destroy', ['type' => $type, 'id' => $attribute->id]) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('Are you sure?')">
                                                                    <i class="far fa-trash-alt me-2"></i>Delete
                                                                </button>
                                                            </form>
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
    </div>

    <!-- Add Modal -->
    <div class="modal custom-modal fade" id="add_attribute" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add {{ ucfirst(Str::singular($type)) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('packet-attributes.store', $type) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Short Code</label>
                            <input type="text" name="short_code" class="form-control">
                        </div>
                        <div class="submit-section text-end">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal custom-modal fade" id="edit_attribute" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit {{ ucfirst(Str::singular($type)) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Short Code</label>
                            <input type="text" name="short_code" id="edit_short_code" class="form-control">
                        </div>
                        <div class="submit-section text-end">
                            <button type="submit" class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-attribute');
            const editModal = new bootstrap.Modal(document.getElementById('edit_attribute'));
            const editForm = document.getElementById('edit_form');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const short_code = this.getAttribute('data-short_code');

                    document.getElementById('edit_name').value = name;
                    document.getElementById('edit_short_code').value = short_code;

                    // Dynamically set the action URL
                    let actionUrl =
                        "{{ route('packet-attributes.update', ['type' => $type, 'id' => ':id']) }}";
                    actionUrl = actionUrl.replace(':id', id);
                    editForm.action = actionUrl;

                    editModal.show();
                });
            });
        });
    </script>
@endsection
