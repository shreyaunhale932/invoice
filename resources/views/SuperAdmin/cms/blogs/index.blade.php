<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header d-flex align-items-center justify-content-between">
                <div class="content-page-header">
                    <h5>Blog Posts</h5>
                </div>
                <a href="{{ route('superadmin.cms.blogs.create') }}" class="btn btn-primary">
                    <i class="fe fe-plus me-1"></i>Add Blog
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card bg-white">
                <div class="card-body">
                    <form method="GET" action="{{ route('superadmin.cms.blogs.index') }}" class="row g-2 mb-3">
                        <div class="col-md-5 col-lg-4">
                            <label for="blog-search" class="visually-hidden">Search blog posts</label>
                            <input type="search" id="blog-search" name="search" class="form-control"
                                value="{{ $search }}" placeholder="Search blog posts">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">
                                <i class="fe fe-search me-1"></i>
                            </button>
                        </div>
                        @if ($search !== '')
                            <div class="col-auto">
                                <a href="{{ route('superadmin.cms.blogs.index') }}" class="btn btn-outline-secondary">Clear</a>
                            </div>
                        @endif
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Heading</th>
                                    <th>Date</th>
                                    <th>Admin</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogPosts as $blog)
                                    <tr>
                                        <td>{{ $blogPosts->firstItem() + $loop->index }}</td>
                                        <td>
                                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->heading }}"
                                                width="100" height="67" style="object-fit: cover;">
                                        </td>
                                        <td>{{ $blog->heading }}</td>
                                        <td>{{ $blog->date->format('d M Y') }}</td>
                                        <td>{{ $blog->admin }}</td>
                                        <td class="text-end text-nowrap">
                                            <a href="{{ route('superadmin.cms.blogs.edit', $blog) }}"
                                                class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form action="{{ route('superadmin.cms.blogs.destroy', $blog) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Delete this blog post?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            {{ $search !== '' ? 'No blog posts match your search.' : 'No blog posts have been added.' }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($blogPosts->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $blogPosts->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
