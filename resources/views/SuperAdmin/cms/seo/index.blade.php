<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>SEO Settings</h5>
                    <p class="text-muted mb-0">Manage the title, description, keywords, and canonical URL for each public page.</p>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($seoPages->isEmpty())
                <div class="alert alert-warning">No SEO pages are configured. Run the database migrations to load the default pages.</div>
            @else
                <ul class="nav nav-tabs mb-4" role="tablist">
                    @foreach ($seoPages as $seoPage)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activePage === $seoPage->page_key ? 'active' : '' }}"
                                href="{{ route('superadmin.cms.seo.index', ['tab' => $seoPage->page_key]) }}"
                                role="tab">
                                {{ $seoPage->page_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                @foreach ($seoPages as $seoPage)
                    @if ($activePage === $seoPage->page_key)
                        <div class="card bg-white">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ $seoPage->page_name }} Page SEO</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST"
                                    action="{{ route('superadmin.cms.seo.update', $seoPage->page_key) }}?tab={{ $seoPage->page_key }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="input-block mb-3">
                                        <label for="title" class="form-label">Page title</label>
                                        <input id="title" name="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title', $seoPage->title) }}" maxlength="255" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="input-block mb-3">
                                        <label for="description" class="form-label">Meta description</label>
                                        <textarea id="description" name="description" rows="3"
                                            class="form-control @error('description') is-invalid @enderror"
                                            maxlength="5000">{{ old('description', $seoPage->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="input-block mb-3">
                                        <label for="keywords" class="form-label">Meta keywords</label>
                                        <textarea id="keywords" name="keywords" rows="5"
                                            class="form-control @error('keywords') is-invalid @enderror"
                                            maxlength="10000">{{ old('keywords', $seoPage->keywords) }}</textarea>
                                        @error('keywords')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="input-block mb-3">
                                        <label for="canonical_url" class="form-label">Canonical URL</label>
                                        <input id="canonical_url" name="canonical_url" type="url"
                                            class="form-control @error('canonical_url') is-invalid @enderror"
                                            value="{{ old('canonical_url', $seoPage->canonical_url) }}" maxlength="255">
                                        @error('canonical_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save SEO Settings</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@endsection
