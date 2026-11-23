<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header d-flex align-items-center justify-content-between">
                <div class="content-page-header">
                    <h5>Add Video</h5>
                </div>
                <a href="{{ route('superadmin.cms.videos.index') }}" class="btn btn-outline-secondary">
                    <i class="fe fe-arrow-left me-1"></i>Back
                </a>
            </div>
            @include('SuperAdmin.cms.videos.form', [
                'action' => route('superadmin.cms.videos.store'),
                'method' => 'POST',
                'video' => null,
            ])
        </div>
    </div>
@endsection
