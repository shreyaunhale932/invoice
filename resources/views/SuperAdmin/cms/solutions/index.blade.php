<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Our Solutions</h5>
                </div>
                <!-- <div class="page-btn">
                    <a href="{{ route('superadmin.cms.solutions.create') }}" class="btn btn-primary">
                        <i class="fe fe-plus me-1"></i>Add Solution
                    </a>
                </div> -->
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card bg-white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Solution title</th>
                                    <th>Home description</th>
                                    <th>Home tag line</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($solutions as $solution)
                                    <tr>
                                        <td>{{ $solution->sort_order }}</td>
                                        <td>{{ $solution->title }}</td>
                                        <td>{{ $solution->home_description }}</td>
                                        <td>{{ $solution->tagline }}</td>
                                        <td>
                                            <span class="badge {{ $solution->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $solution->is_active ? 'Active' : 'Hidden' }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('superadmin.cms.solutions.edit', $solution) }}"
                                                class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form action="{{ route('superadmin.cms.solutions.destroy', $solution) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Delete this solution?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No solutions have been added.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $solutions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
