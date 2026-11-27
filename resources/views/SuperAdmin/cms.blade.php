<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Home Page</h5>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card bg-white">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Home Images</h5>
                        <a href="{{ route('superadmin.cms.home.edit') }}" class="btn btn-primary btn-sm">
                            <i class="fe fe-edit me-1"></i>Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ([1, 2, 3] as $position)
                            <div class="col-xl-4 col-md-6">
                                <div class="card border">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h6 class="mb-0">Image {{ $position }}</h6>
                                    </div>
                                    <div class="card-body">
                                        @if ($banners->{'image' . $position})
                                            <img class="img-fluid rounded mb-3"
                                                src="{{ asset($banners->{'image' . $position}) }}"
                                                alt="Home image {{ $position }}">
                                        @else
                                            <div class="text-muted mb-3">No image uploaded.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card bg-white mt-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Homepage Dashboard Image</h5>
                    <a href="{{ route('superadmin.cms.dashboard') }}" class="btn btn-primary btn-sm">
                        <i class="fe fe-eye me-1"></i>Manage
                    </a>
                </div>
            </div>

            <div class="card bg-white mt-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-1">Pricing Plans & Section</h5>
                        <p class="text-muted small mb-0">Manage plan cards, cut price, discount off, savings, features, button text, and trial notes.</p>
                    </div>
                    <a href="{{ route('superadmin.cms.pricing.index') }}" class="btn btn-primary btn-sm">
                        <i class="fe fe-settings me-1"></i>Manage Plans
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
