<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Dashboard Image</h5>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card bg-white">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Homepage Dashboard Image</h5>
                    <a href="{{ route('superadmin.cms.dashboard.edit') }}" class="btn btn-primary btn-sm">
                        <i class="fe fe-edit me-1"></i>Edit
                    </a>
                </div>
                <div class="card-body">
                    @if ($banners->dashboard_image)
                        <img class="img-fluid rounded"
                            src="{{ asset($banners->dashboard_image) }}"
                            alt="Homepage dashboard image">
                    @else
                        <div class="text-muted">No dashboard image uploaded.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
