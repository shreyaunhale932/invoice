<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header d-flex align-items-center justify-content-between">
                <div class="content-page-header">
                    <h5>Edit Home Benefits</h5>
                </div>
                <a href="{{ route('superadmin.cms.home.edit') }}" class="btn btn-outline-secondary">
                    <i class="fe fe-arrow-left me-1"></i>Back
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
                    <form method="POST" action="{{ route('superadmin.cms.home.benefits.update') }}">
                        @csrf
                        @method('PUT')

                        @for ($number = 1; $number <= 4; $number++)
                            <div class="border rounded p-3 mb-3">
                                <h6>Benefit {{ $number }}</h6>
                                <div class="input-block mb-3">
                                    <label for="benefit_h{{ $number }}" class="form-label">H{{ $number }} - Heading</label>
                                    <input id="benefit_h{{ $number }}" name="benefit_h{{ $number }}" type="text"
                                        class="form-control @error('benefit_h' . $number) is-invalid @enderror"
                                        value="{{ old('benefit_h' . $number, $banners->{'benefit_h' . $number} ?? ['Save Time', 'Reduce Manual Errors', 'Stay Organized', 'Improve Daily Operations'][$number - 1]) }}"
                                        maxlength="255">
                                    @error('benefit_h' . $number)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-block mb-0">
                                    <label for="benefit_t{{ $number }}" class="form-label">T{{ $number }} - Text</label>
                                    <textarea id="benefit_t{{ $number }}" name="benefit_t{{ $number }}" rows="3"
                                        class="form-control @error('benefit_t' . $number) is-invalid @enderror"
                                        maxlength="2000">{{ old('benefit_t' . $number, $banners->{'benefit_t' . $number} ?? [
                                            'Automate repetitive tasks and reduce invoice creation time from 10 minutes to just 2 minutes. Focus on growing your business, not paperwork.',
                                            'Eliminate calculation mistakes with automated GST, making charges, and stone cost calculations. 100% accuracy guaranteed.',
                                            'Keep all your invoices, inventory records, and customer data in one secure, searchable place. Never lose track of important information.',
                                            'Get real-time insights into sales, stock levels, and profitability. Make data-driven decisions to grow your jewellery business.',
                                        ][$number - 1]) }}</textarea>
                                    @error('benefit_t' . $number)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endfor

                        @for ($number = 1; $number <= 3; $number++)
                            <div class="border rounded p-3 mb-3">
                                <h6>Statistic {{ $number }}</h6>
                                <div class="input-block mb-3">
                                    <label for="benefit_stat{{ $number }}_value" class="form-label">Value</label>
                                    <input id="benefit_stat{{ $number }}_value" name="benefit_stat{{ $number }}_value"
                                        type="text" class="form-control @error('benefit_stat' . $number . '_value') is-invalid @enderror"
                                        value="{{ old('benefit_stat' . $number . '_value', $banners->{'benefit_stat' . $number . '_value'} ?? ['5 hours', '100%', '24/7'][$number - 1]) }}"
                                        maxlength="100">
                                    @error('benefit_stat' . $number . '_value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-block mb-0">
                                    <label for="benefit_stat{{ $number }}_label" class="form-label">Text</label>
                                    <input id="benefit_stat{{ $number }}_label" name="benefit_stat{{ $number }}_label"
                                        type="text" class="form-control @error('benefit_stat' . $number . '_label') is-invalid @enderror"
                                        value="{{ old('benefit_stat' . $number . '_label', $banners->{'benefit_stat' . $number . '_label'} ?? ['Saved per week', 'Calculation accuracy', 'Access anywhere'][$number - 1]) }}"
                                        maxlength="255">
                                    @error('benefit_stat' . $number . '_label')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endfor

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('superadmin.cms.home.edit') }}" class="btn btn-light ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
