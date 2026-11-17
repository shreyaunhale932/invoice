<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit Home Images</h5>
                </div>
                <div class="page-btn">
                    <a href="{{ route('superadmin.cms') }}" class="btn btn-outline-secondary">
                        <i class="fe fe-arrow-left me-1"></i>Back
                    </a>
                </div>
            </div>

            <div class="card bg-white">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('superadmin.cms.home.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            @foreach ([1, 2, 3] as $image)
                                <div class="col-md-4">
                                    <div class="input-block mb-3">
                                        <label class="form-label">Image {{ $image }}</label>
                                        <input name="image{{ $image }}" class="form-control" type="file"
                                            accept="image/*">
                                        @error('image' . $image)
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    @if ($banners->{'image' . $image})
                                        <img class="img-fluid rounded mb-4" style="max-height: 240px"
                                            src="{{ asset($banners->{'image' . $image}) }}"
                                            alt="Home image {{ $image }}">
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('superadmin.cms') }}" class="btn btn-light ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
