<?php $page = 'register'; ?>
@extends('layout.mainlayout')
@section('content')
  <!-- Sign In -->
  <div class="row gx-0">

    <!-- Banner Content -->
    <div class="col-lg-6">
        <div class="authentication-wrapper">
            <div class="authentication-content">
                <h1>Take control of your invoicing process. Sign up for a account today.</h1>
                <p>Effortless Invoice Management for Your Business</p>
            </div>
            <div class="authen-img">
                <img src="{{asset('/assets/img/saas-login-img.png')}}" alt="">
            </div>
            <div class="login-bg-img">
                <img src="{{asset('/assets/img/saas-login-bg-01.png')}}" class="img-fluid vector-bg-one" alt="Img">
                <img src="{{asset('/assets/img/saas-login-bg-02.png')}}" class="img-fluid vector-bg-two" alt="Img">
                <img src="{{asset('/assets/img/saas-login-bg-03.png')}}" class="img-fluid vector-bg-three" alt="Img">
                <img src="{{asset('/assets/img/saas-login-bg-04.png')}}" class="img-fluid vector-bg-four" alt="Img">
           </div>
        </div>
    </div>
    <!-- /Banner Content -->

    <!-- login Content -->
    <div class="col-lg-6">
        <div class="saas-login-wrapper p-0">
            <div class="login-content">
                <form id="registrationForm">
                    @csrf
                    <div class="login-userset">
                        <div class="login-logo">
                           <img src="{{asset('/assets/img/saas-login-logo.svg')}}" alt="img">
                       </div>
                       <div class="login-card">
                           <div class="login-heading">
                               <h3>Create an Account</h3>
                               <p>Sign Up Instantly to get free trail for 14 days!!!</p>
                           </div>
                           <div id="registrationErrors" class="alert alert-danger" style="display:none;"></div>
                           <div class="input-block mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                            </div>
                            <div class="input-block mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
                           </div>
                           <div class="input-block mb-3">
                                <label class="form-label">Domain Name  </label>
                                <div class="url-text-box">
                                    <input type="text" name="domain" class="form-control" placeholder="Enter Domain Name" required>
                                    <span class="url-text">kanakku.com</span>
                                </div>
                            </div>
                            <div class="input-block mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company" class="form-control" placeholder="Enter Company name" required>
                            </div>
                            <div class="d-flex saas-pass-box">
                                <div class="input-block mb-3" style="flex: 1; margin-right: 10px;">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" name="password" class="form-control pass-input" placeholder="Password" required>
                                        <span class="fas fa-eye-slash toggle-password"></span>
                                    </div>
                                </div>
                                <div class="input-block mb-3" style="flex: 1;">
                                    <label class="form-control-label">Confirm Password</label>
                                    <div class="pass-group">
                                        <input type="password" name="password_confirmation" class="form-control pass-input-two" placeholder="Confirm Password" required>
                                        <span class="fas fa-eye-slash toggle-password-two"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-block mb-3">
                                <div class="form-check custom-checkbox mb-0">
                                    <input type="checkbox" class="form-check-input" id="cb1" required>
                                    <label class="custom-control-label mb-0" for="cb1">I agree to Terms of Service and Privacy Policy.</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" id="registerBtn">Register</button>
                        </div>
                        <div class="acc-in">
                            <p>Already have an account? <a href="{{url('saas-login')}}"> Sign IN</a></p>
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Login Content -->

</div>
<!-- /Sign In -->

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
                        <input type="text" name="otp" class="form-control text-center" placeholder="000000" maxlength="6" style="font-size: 24px; letter-spacing: 10px; font-weight: bold;" required>
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
                let errorHtml = '<ul>';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul>';
                $('#registrationErrors').html(errorHtml).show();
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
                $('#otpErrors').text(xhr.responseJSON.message).show();
            }
        });
    });
});
</script>

@endsection
