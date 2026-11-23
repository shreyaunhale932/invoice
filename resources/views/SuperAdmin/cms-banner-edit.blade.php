<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit Home Images</h5>
                </div>
                <!-- <div class="page-btn">
                    <a href="{{ route('superadmin.cms') }}" class="btn btn-outline-secondary">
                        <i class="fe fe-arrow-left me-1"></i>Back
                    </a>
                </div> -->
            </div>

            <div class="card bg-white">
                <div class="card-body">
                    <form id="cms-banner-form" method="POST" enctype="multipart/form-data"
                        action="{{ route('superadmin.cms.home.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            @foreach ([1, 2, 3] as $image)
                                <div class="col-md-4">
                                    <div class="input-block mb-3">
                                        <label class="form-label">Image {{ $image }}</label><small class="text-danger form-label">(image size 1400x600 )</small>
                                        <input name="image{{ $image }}" id="image{{ $image }}" class="form-control" type="file"
                                            accept="image/jpeg,image/png,image/webp">
                                        <small id="image_error{{ $image }}" class="text-danger d-block"></small>
                                        @error('image' . $image)
                                            <small class="text-danger d-block">{{ $message }}</small>
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

                        <hr>
                        <h6 class="mb-3">Mobile banner images</h6>
                        <div class="row">
                            @foreach ([1, 2, 3] as $image)
                                <div class="col-md-4">
                                    <div class="input-block mb-3">
                                        <label class="form-label">Mobile Image {{ $image }}</label>
                                        <small class="text-danger form-label">(image size 768x1000)</small>
                                        <input name="mob_img{{ $image }}" id="mob_img{{ $image }}" class="form-control"
                                            type="file" accept="image/jpeg,image/png,image/webp">
                                        <small id="mob_img_error{{ $image }}" class="text-danger d-block"></small>
                                        @error('mob_img' . $image)
                                            <small class="text-danger d-block">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    @if ($banners->{'mob_img' . $image})
                                        <img class="img-fluid rounded mb-4" style="max-height: 240px"
                                            src="{{ asset($banners->{'mob_img' . $image}) }}"
                                            alt="Mobile home image {{ $image }}">
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
