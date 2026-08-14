<div class="auth-popup" id="authPopup">
    <div class="auth-overlay" onclick="closeAuthPopup()"></div>

    <div class="auth-modal">

        <!-- Left Panel -->
        <!-- Left Panel -->
        <div class="auth-left">
            <!-- Illustration -->
            <div class="login-illustration">
                <img src="{{ asset('front_assets/img/LoginIllustration.png') }}" alt="Login Illustration"
                    class="login-illustration-img">
            </div>

            <!-- Content -->
            <div class="auth-left-content">
                <h3>Welcome to Sirsonite</h3>
                <p>Manage your jewellery business with ease</p>

                <div class="auth-stats">
                    <div class="stat-item">
                        <strong>500+</strong>
                        <span>Users</span>
                    </div>

                    <div class="stat-item">
                        <strong>50K+</strong>
                        <span>Invoices</span>
                    </div>

                    <div class="stat-item">
                        <strong>99.9%</strong>
                        <span>Uptime</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="auth-right">
            <!-- Close Button -->
            <button type="button" class="auth-close" onclick="closeAuthPopup()" aria-label="Close popup">
                &times;
            </button>
            <!-- Heading -->
            <h2>Welcome Back</h2>
            <p class="auth-subtitle">Login to access your dashboard</p>

            <!-- Social Login -->
            <!-- <div class="social-login">
        <button type="button" class="social-btn">
<img src="front_assets/img/icons/chrom.svg" alt="Chrome" class="social-icon">        </button>

        <button type="button" class="social-btn">
<img src="front_assets/img/icons/facebook.svg" alt="Chrome" class="social-icon">        </button>
        </button>

        <button type="button" class="social-btn">
<img src="front_assets/img/icons/apple.svg" alt="Chrome" class="social-icon">        </button>
    </div> -->

            <!-- Divider -->
            <!-- <div class="auth-divider">
        <span>or continue with email</span>
    </div> -->
            @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
            @endif
            <!-- Form -->
            <form id="loginForm">
                @csrf

                <div id="loginErrors" class="alert alert-danger" style="display:none;"></div>

                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Enter your username">
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="••••••••">
                        <i class="far fa-eye toggle-password"></i>
                    </div>
                </div>

                <button type="submit" class="auth-btn" id="loginBtn">
                    Sign In
                </button>

                <p class="auth-footer">
                    Don't have an account?
                    <a href="javascript:void(0)" onclick="openRegisterPopup()">Sign Up</a>
                </p>

            </form>
        </div>
    </div>
</div>

<!-- =================================== sign-up modal=========================  -->
<div class="register-popup" id="registerPopup">
    <div class="auth-overlay" onclick="closeRegisterPopup()"></div>

    <div class="register-modal">

        <button class="auth-close" onclick="closeRegisterPopup()">&times;</button>

        <h3 class="text-center">Create Your Account</h3>

        <form id="registrationForm" class="register-form">
            @csrf

            <div id="registrationErrors" class="alert alert-danger" style="display:none;"></div>

            <div class="form-row">
                <div class="form-group">
                    <label>First Name <span class="text-danger"> *</span></label>
                    <input type="text" name="first_name" placeholder="Enter first name" required>
                    <span class="text-danger first_name_error"></span>
                </div>

                <div class="form-group">
                    <label>Last Name <span class="text-danger"> *</span></label>
                    <input type="text" name="last_name" placeholder="Enter last name" required>
                    <span class="text-danger last_name_error"></span>
                </div>
                <div class="form-group">
                    <label>Company Name <span class="text-danger"> *</span></label>
                    <input type="text" name="company" placeholder="Enter company name" required>
                    <span class="text-danger company_error"></span>
                </div>
            </div>



            <div class="form-row">

                <div class="form-group">
                    <label>Username <span class="text-danger"> *</span></label>
                    <input type="text" name="username" placeholder="Username" required>
                    <span class="text-danger username_error"></span>
                </div>

                <div class="form-group">
                    <label>Email <span class="text-danger"> *</span></label>
                    <input type="email" name="email" placeholder="Enter email" required>
                    <span class="text-danger email_error"></span>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="Enter phone">
                </div>

            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" placeholder="Enter city">
                </div>

                <div class="form-group">
                    <label>State</label>

                    <select name="state">
                        @foreach (['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Andaman and Nicobar Islands', 'Chandigarh', 'Dadra and Nagar Haveli and Daman and Diu', 'Delhi', 'Jammu and Kashmir', 'Ladakh', 'Lakshadweep', 'Puducherry'] as $stateName)
                        <option value="{{ $stateName }}">
                            {{ $stateName }}
                        </option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label>Pincode</label>
                    <input type="text" name="pincode" placeholder="Enter pincode">
                </div>

            </div>

            <!-- <div class="form-row">

                

            </div> -->



            <div class="form-row">

                <div class="form-group">
                    <label>Address</label>
                    <textarea placeholder="Enter address" name="address"></textarea>
                </div>

                <div class="form-group">
                    <label>Password <span class="text-danger"> *</span></label>
                    <input type="password" name="password" placeholder="Password" required>
                    <span class="text-danger password_error"></span>
                </div>

                <div class="form-group">
                    <label>Confirm Password <span class="text-danger"> *</span></label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    <span class="text-danger password_confirmation_error"></span>
                </div>

            </div>


            <button type="submit" class="register-btn" id="registerBtn">
                Register Account
            </button>

            <p class="register-footer">
                Already have an account?
                <a href="javascript:void(0)" onclick="backToLogin()">Login</a>
            </p>

        </form>

    </div>
</div>

<!-- ======================otp-modal====================== -->
<div class="otp-popup" id="otpPopup">

    <div class="otp-overlay" onclick="closeOtpModal()"></div>

    <div class="otp-modal">

        <button class="otp-close" onclick="closeOtpModal()">
            &times;
        </button>

        <div class="otp-icon">
            <i class="fas fa-envelope-open-text"></i>
        </div>

        <h2>Verify Your Email</h2>

        <p>
            We've sent a <strong>6-digit verification code</strong> to your
            registered email address.
        </p>

        <form id="otpForm">

            @csrf

            <input type="hidden" name="admin_id" id="otpAdminId">

            <div id="otpErrors" class="otp-error"></div>

            <div class="otp-input-wrapper">
                <input type="text" name="otp" id="otp" maxlength="6" placeholder="Enter OTP"
                    autocomplete="off" required>
            </div>

            <button type="submit" class="verify-btn" id="verifyBtn">
                Verify & Create Account
            </button>

            <div class="otp-footer">
                Didn't receive the code?
                <a href="javascript:void(0)">Resend OTP</a>
            </div>

        </form>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#registrationForm').submit(function(e) {

        e.preventDefault();

        $('#registrationErrors').hide().empty();

        $('#registerBtn').prop('disabled', true);

        $.ajax({

            url: "{{ route('saas.register.submit') }}",

            type: "POST",

            data: $(this).serialize(),

            success: function(response) {

                $('#registerBtn').prop('disabled', false);

                if (response.success) {

                    $('#otpAdminId').val(response.admin_id);

                    closeRegisterPopup();

                    openOtpModal();

                }

            },

            error: function(xhr) {

                $('#registerBtn').prop('disabled', false);

                $('.text-danger').text('');
                $('input').removeClass('is-invalid');

                $.each(xhr.responseJSON.errors, function(key, value) {

                    $('.' + key + '_error').text(value[0]);

                    $('[name="' + key + '"]').addClass('is-invalid');

                });

            }

        });

    });
    $('#otpForm').submit(function(e) {

        e.preventDefault();
        $('#otpErrors').hide().empty();
        $('#verifyBtn').prop('disabled', true).text('Verifying...');

        $.ajax({

            url: "{{ route('saas.verify.otp') }}",

            type: "POST",

            data: $(this).serialize(),

            success: function(response) {

                if (response.success) {

                    // Close OTP popup
                    // closeOtpModal();

                    // Or
                    $('#otpPopup').hide();

                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful!',
                        text: 'Your account has been created successfully. You can now login.',
                        confirmButtonText: 'Login Now',
                        allowOutsideClick: false
                    }).then(() => {

                        // Open Login Popup
                        openAuthPopup();

                        // If you want to redirect instead
                        // window.location.href = response.redirect;

                    });

                }

            },

            error: function(xhr) {

                $('#verifyBtn').prop('disabled', false);

                $('#otpErrors')
                    .text(xhr.responseJSON.message)
                    .show();

            }

        });

    });
    $('#loginForm').submit(function(e) {

        e.preventDefault();

        $('#loginErrors').hide().html('');

        $.ajax({
            url: "{{ route('admin.authenticate') }}",
            type: "POST",
            data: $(this).serialize(),

            beforeSend: function() {
                $('#loginBtn').prop('disabled', true).text('Signing In...');
            },

            success: function(response) {

                window.location.href = response.redirect;

            },

            error: function(xhr) {

                $('#loginBtn').prop('disabled', false).text('Sign In');

                if (xhr.status == 401) {

                    $('#loginErrors')
                        .html(xhr.responseJSON.message)
                        .show();

                }

                if (xhr.status == 422) {

                    let html = '<ul>';

                    $.each(xhr.responseJSON.errors, function(key, value) {

                        html += '<li>' + value[0] + '</li>';

                    });

                    html += '</ul>';

                    $('#loginErrors').html(html).show();
                }

            }

        });

    });
</script>