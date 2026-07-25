@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Packet Masters</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Packet Masters</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('packet-masters.create') }}" class="btn btn-primary me-1">
                            <i class="fas fa-plus"></i> Create Packet
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
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Packet No</th>
                                            <th>Type</th>
                                            <th>Stone</th>
                                            <th>Shape</th>
                                            <th>Color</th>
                                            <th>Clarity</th>
                                            <th>Ct / Pcs</th>
                                            <th>Rate (R / W)</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($packets as $packet)
                                            <tr>
                                                <td>{{ $packet->packet_no }}</td>
                                                <td><span class="badge {{ ($packet->packet_type ?? 'Diamond') == 'Diamond' ? 'bg-primary' : 'bg-info' }}">{{ $packet->packet_type ?? 'Diamond' }}</span></td>
                                                <td>{{ $packet->stone->name ?? '-' }}</td>
                                                <td>{{ $packet->shape->name ?? '-' }}</td>
                                                <td>{{ $packet->color->name ?? '-' }}</td>
                                                <td>{{ $packet->clarity->name ?? '-' }}</td>
                                                <td>{{ $packet->average_wt }} / {{ $packet->average_pcs }}</td>
                                                <td>{{ $packet->rate_retail }} / {{ $packet->rate_wholesale }}</td>
                                                <td class="text-end">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="{{ route('packet-masters.edit', $packet->id) }}">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </a>
                                                            <form action="{{ route('packet-masters.destroy', $packet->id) }}"
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
@endsection
