<?php $page = 'register'; ?>
@extends('layout.mainlayout')
@section('content')
  <div class="login-wrapper d-flex align-items-center justify-content-center" style="min-height: 100vh; background: #f4f6f9;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">

                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <img src="{{ asset('/assets/img/logo2.png') }}" height="60">
                            <h4 class="mt-2">Create Your Account</h4>
                        </div>

                        <!-- Error -->
                        <div id="registrationErrors" class="alert alert-danger d-none"></div>

                        <!-- Form -->
                        <form id="registrationForm">
                            @csrf

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control rounded-3" name="first_name" placeholder="Enter first name" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control rounded-3" name="last_name" placeholder="Enter last name" required>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control rounded-3" name="company" placeholder="Enter company name" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Username (Domain)</label>
                                    <input type="text" class="form-control rounded-3" name="username" placeholder="Enter username" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control rounded-3" name="email" placeholder="Enter email" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control rounded-3" name="phone" placeholder="Enter phone">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control rounded-3" name="city" placeholder="Enter city">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">State</label>
                                    <select class="form-control rounded-3" name="state">
                                        @foreach(['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Andaman and Nicobar Islands', 'Chandigarh', 'Dadra and Nagar Haveli and Daman and Diu', 'Delhi', 'Jammu and Kashmir', 'Ladakh', 'Lakshadweep', 'Puducherry'] as $stateName)
                                                            <option value="{{ $stateName }}">{{ $stateName }}</option>
                                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Pincode</label>
                                    <input type="text" class="form-control rounded-3" name="pincode" placeholder="Enter pincode">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control rounded-3" name="address" rows="2" placeholder="Enter address"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control rounded-3" name="password" placeholder="Enter password" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control rounded-3" name="password_confirmation" placeholder="Confirm password" required>
                                </div>

                            </div>

                            <!-- Button -->
                            <div class="mt-4">
                                <button class="btn btn-primary w-100 rounded-3 py-2" type="submit" id="registerBtn">
                                    Register Account
                                </button>
                            </div>

                        </form>

                        <!-- Footer -->
                        <div class="text-center mt-3">
                            Already have an account? <a href="{{ url('login') }}">Login</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    </div>

    <!-- OTP Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0">
                    <div class="mb-4">
                        <i class="feather-mail text-primary" style="font-size: 50px;"></i>
                    </div>
                    <h4 class="mb-2">Verify Your Email</h4>
                    <p class="text-muted mb-4">We've sent a 6-digit code to your email. Please enter it below to continue.</p>
                    <form id="otpForm">
                        @csrf
                        <input type="hidden" name="admin_id" id="otpAdminId">
                        <div id="otpErrors" class="alert alert-danger" style="display:none;"></div>
                        <div class="input-block mb-4">
                            <input type="text" name="otp" class="form-control text-center" placeholder="000000" maxlength="6" style="font-size: 24px; letter-spacing: 12px; font-weight: bold;" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="verifyBtn">Verify & Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script>
    $(document).ready(function() {
        $('#registrationForm').on('submit', function(e) {
            e.preventDefault();
            $('#registrationErrors').hide().empty();
            $('#registerBtn').prop('disabled', true).text('Processing...');

            $.ajax({
                url: "{{ route('saas.register.submit') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#registerBtn').prop('disabled', false).text('Register');
                    if (response.success) {
                        $('#otpAdminId').val(response.admin_id);
                        $('#otpModal').modal('show');
                    }
                },
                error: function(xhr) {
                    $('#registerBtn').prop('disabled', false).text('Register');
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                        let errorHtml = '<ul>';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                        errorHtml += '</ul>';
                        $('#registrationErrors').html(errorHtml).show();
                    } else {
                        $('#registrationErrors').text(xhr.responseJSON.message || 'An error occurred.').show();
                    }
                }
            });
        });

        $('#otpForm').on('submit', function(e) {
            e.preventDefault();
            $('#otpErrors').hide().empty();
            $('#verifyBtn').prop('disabled', true).text('Verifying...');

            $.ajax({
                url: "{{ route('saas.verify.otp') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#verifyBtn').text('Success! Redirecting...');
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    $('#verifyBtn').prop('disabled', false).text('Verify & Create Account');
                    $('#otpErrors').text(xhr.responseJSON.message || 'Invalid OTP.').show();
                }
            });
        });
    });
    </script>
@endsection

