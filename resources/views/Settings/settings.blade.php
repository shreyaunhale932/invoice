<?php $page = 'settings'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->

        <!-- /Page Header -->

        <div class="row">
            <div class="col-xl-3 col-md-4">

                <div class="card">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="content-page-header">
                                <h5>Settings</h5>
                            </div>
                        </div>
                        <!-- Settings Menu -->
                        @component('components.settings-menu')
                        @endcomponent
                        <!-- /Settings Menu -->
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-md-8">
                <div class="card">
                    <div class="card-body w-100">
                        <div class="content-page-header">
                            <h5 class="setting-menu">Account Settings</h5>
                        </div>
                        <form action="{{ route('admin.setting') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="profile-picture">
                                    <div class="upload-profile me-2">
                                        <div class="profile-img">
                                            <img id="blah" class="avatar"
                                                src="{{ asset('public/assets/img/profiles/avatar-10.jpg') }}"
                                                alt="profile-img">
                                        </div>
                                    </div>
                                    <div class="img-upload">
                                        <label class="btn btn-primary">
                                            Upload new picture <input type="file" name="image" onchange="previewImage(event)">
                                        </label>
                                        <a class="btn btn-remove">Delete</a>
                                        <p class="mt-1">Logo Should be minimum 152 * 152 Supported File format JPG,PNG,SVG</p>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-title">
                                        <h5>General Information</h5>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email Address" value="{{ $user->email}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Mobile Number</label>
                                        <input type="text" class="form-control" placeholder="Enter Mobile Number" name="contact_number" value="{{ $user->contact_number}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>PAN</label>
                                        <input type="text" class="form-control" placeholder="Enter PAN Number" name="pan" value="{{ $user->pan}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>GSTIN</label>
                                        <input type="text" class="form-control" placeholder="Enter GSTIN" name="gstin" value="{{ $user->gstin}}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-title">
                                        <h5>Address Information</h5>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-block mb-3">
                                        <label>Address</label>
                                        <input type="text" class="form-control" placeholder="Enter your Address" name="address" value="{{ $user->address}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Country</label>
                                        <input type="text" class="form-control" placeholder="Enter your Country" name="country" value="{{ $user->country}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>State</label>
                                        <input type="text" class="form-control" placeholder="Enter your State" name="state" value="{{ $user->state}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>City</label>
                                        <input type="text" class="form-control" placeholder="Enter your City" name="city" value="{{ $user->city}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="input-block mb-3">
                                        <label>Postal Code</label>
                                        <input type="text" class="form-control" placeholder="Enter Your Postal Code" name="postalcode" value="{{ $user->postalcode}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="btn-path text-end">
                                        <a href="javascript:void(0);" class="btn btn-cancel bg-primary-light me-3">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <script>
                            function previewImage(event) {
                                var reader = new FileReader();
                                reader.onload = function() {
                                    var output = document.getElementById('blah');
                                    output.src = reader.result;
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
@endsection