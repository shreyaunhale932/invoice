<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header d-flex align-items-center justify-content-between">
                <div class="content-page-header">
                    <h5>Testimonials</h5>
                </div>
                <a href="{{ route('superadmin.cms.testimonials.create') }}" class="btn btn-primary">
                    <i class="fe fe-plus me-1"></i>Add Testimonial
                </a>
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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Short detail</th>
                                    <th>Rating</th>
                                    <th>Content</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($testimonials as $testimonial)
                                    <tr>
                                        <td>{{ $testimonials->firstItem() + $loop->index }}</td>
                                        <td>{{ $testimonial->name }}</td>
                                        <td>{{ $testimonial->short_detail }}</td>
                                        <td>{{ $testimonial->rating }} / 5</td>
                                        <td class="text-break" style="max-width: 500px; overflow-wrap: anywhere; white-space: pre-line;">
                                            {{ $testimonial->content }}
                                        </td>
                                        <td class="text-end text-nowrap">
                                            <a href="{{ route('superadmin.cms.testimonials.edit', $testimonial) }}"
                                                class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form action="{{ route('superadmin.cms.testimonials.destroy', $testimonial) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Delete this testimonial?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No testimonials have been added.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($testimonials->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $testimonials->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
