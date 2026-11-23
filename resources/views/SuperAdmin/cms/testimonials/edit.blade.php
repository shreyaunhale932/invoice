<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header d-flex align-items-center justify-content-between">
                <div class="content-page-header">
                    <h5>Edit Testimonial</h5>
                </div>
                <a href="{{ route('superadmin.cms.testimonials.index') }}" class="btn btn-outline-secondary">
                    <i class="fe fe-arrow-left me-1"></i>Back
                </a>
            </div>
            @include('SuperAdmin.cms.testimonials.form', [
                'action' => route('superadmin.cms.testimonials.update', $testimonial),
                'method' => 'PUT',
                'testimonial' => $testimonial,
            ])
        </div>
    </div>
@endsection
