@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="content-page-header">
                <h5>Firm Management</h5>
                <div class="list-btn">
                    <ul class="filter-list">
                        <li>
                            <a class="btn btn-primary" href="{{ route('firms.create') }}">
                                <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Firm
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable" id="firms_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Firm Name</th>
                                        <th>Contact</th>
                                        <th>Location</th>
                                        <th>GSTIN/PAN</th>
                                        <th>Status</th>
                                        <th class="no-sort text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($firms as $firm)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="javascript:void(0);" class="avatar avatar-sm me-2">
                                                    <div class="bg-primary-light rounded-circle p-2 text-center" style="width: 32px; height: 32px; line-height: 16px;">
                                                        <i class="fas fa-building text-primary small"></i>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0);">{{ $firm->name }}
                                                    @if(Session::get('selected_firm_id') == $firm->id)
                                                        <span class="badge bg-success-light ms-2">Active</span>
                                                    @endif
                                                </a>
                                            </h2>
                                        </td>
                                        <td>
                                            <div>{{ $firm->email ?? 'N/A' }}</div>
                                            <small class="text-muted">{{ $firm->phone ?? '' }}</small>
                                        </td>
                                        <td>{{ $firm->city ?? 'N/A' }}, {{ $firm->state ?? '' }}</td>
                                        <td>
                                            <div>G: {{ $firm->gstin ?? 'N/A' }}</div>
                                            <small class="text-muted">P: {{ $firm->pan ?? 'N/A' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge {{ $firm->status == 'active' ? 'bg-success-light' : 'bg-danger-light' }}">
                                                {{ ucfirst($firm->status) }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <form action="{{ route('firms.switch') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="firm_id" value="{{ $firm->id }}">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-toggle-on me-2"></i>Select Firm
                                                        </button>
                                                    </form>
                                                    <a class="dropdown-item" href="{{ route('firms.edit', $firm->id) }}">
                                                        <i class="far fa-edit me-2"></i>Edit
                                                    </a>
                                                    {{-- <form action="{{ route('firms.destroy', $firm->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this firm?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="far fa-trash-alt me-2"></i>Delete
                                                        </button>
                                                    </form> --}}
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
@endsection
