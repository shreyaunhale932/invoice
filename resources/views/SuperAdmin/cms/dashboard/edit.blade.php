<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit Dashboard Image</h5>
                </div>
                <div class="page-btn">
                    <a href="{{ route('superadmin.cms.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fe fe-arrow-left me-1"></i>Back
                    </a>
                </div>
            </div>

            <div class="card bg-white">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('superadmin.cms.dashboard.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="input-block mb-3">
                            <label class="form-label" for="dashboard_image">Dashboard Image</label>
                            <input name="dashboard_image" id="dashboard_image" class="form-control"
                                type="file" accept="image/jpeg,image/png,image/webp">
                            @error('dashboard_image')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        @if ($banners->dashboard_image)
                            <img class="img-fluid rounded mb-4" style="max-height: 240px"
                                src="{{ asset($banners->dashboard_image) }}"
                                alt="Current dashboard image">
                        @endif

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('superadmin.cms.dashboard') }}" class="btn btn-light ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
