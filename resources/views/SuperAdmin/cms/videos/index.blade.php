<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header d-flex align-items-center justify-content-between">
                <div class="content-page-header">
                    <h5>Video Tutorials</h5>
                </div>
                <a href="{{ route('superadmin.cms.videos.create') }}" class="btn btn-primary">
                    <i class="fe fe-plus me-1"></i>Add Video
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
                                    <th>Tag</th>
                                    <th>T1 Category</th>
                                    <th>Heading</th>
                                    <th>T2 Label</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($videos as $video)
                                    <tr>
                                        <td>VIDEO {{ str_pad((string) ($videos->firstItem() + $loop->index), 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $categories[$video->category] }}</td>
                                        <td>{{ $video->title }}</td>
                                        <td>{{ $video->t2_label }}</td>
                                        <td class="text-end text-nowrap">
                                            <a href="{{ route('superadmin.cms.videos.edit', $video) }}"
                                                class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form action="{{ route('superadmin.cms.videos.destroy', $video) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Delete this video?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No videos have been added.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($videos->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $videos->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
