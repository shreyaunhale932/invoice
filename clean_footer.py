import re

with open(r'resources/views/invoice_front/includes/footer.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# The first clean script block ends at the closing of the DOMContentLoaded block
# Find the FIRST </script> that follows the modal-switching block
# We'll keep everything up to and including the first closing </script> after the DOMContentLoaded block

# Find the marker that ends the first (non-jQuery) script block
marker = '        });\n    });\n</script>'
idx = content.find(marker)
if idx == -1:
    # Try Windows line endings
    marker = '        });\r\n    });\r\n</script>'
    idx = content.find(marker)

if idx == -1:
    print('ERROR: First script closing marker not found.')
    # print a snippet around the DOMContentLoaded closing area
    sample_idx = content.find('});')
    print(repr(content[sample_idx-20:sample_idx+60]))
else:
    base_content = content[:idx + len(marker)]
    print(f'Cut at index {idx}, base length = {len(base_content)}')

    js_addition = '''


<!-- Custom JavaScript -->
<script src="{{ asset('front_assets/script/script.js') }}"></script>
<script src="{{ asset('front_assets/script/animation.js') }}"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Modal Helpers for Bootstrap 5
    function closeRegisterPopup() {
        const signupModal = document.getElementById('jewelSignupModal');
        if (signupModal) {
            const modalInstance = bootstrap.Modal.getInstance(signupModal);
            if (modalInstance) { modalInstance.hide(); }
        }
    }

    function openOtpModal() {
        const otpModal = document.getElementById('jewelSignupVerificationModal');
        if (otpModal) { bootstrap.Modal.getOrCreateInstance(otpModal).show(); }
    }

    function closeOtpModal() {
        const otpModal = document.getElementById('jewelSignupVerificationModal');
        if (otpModal) {
            const modalInstance = bootstrap.Modal.getInstance(otpModal);
            if (modalInstance) { modalInstance.hide(); }
        }
    }

    function openAuthPopup() {
        const loginModal = document.getElementById('jewelLoginModal');
        if (loginModal) { bootstrap.Modal.getOrCreateInstance(loginModal).show(); }
    }

    function closeForgotPopup() {
        const modal = document.getElementById('jewelForgotModal');
        if (modal) {
            const instance = bootstrap.Modal.getInstance(modal);
            if (instance) instance.hide();
        }
    }

    function openNewPasswordPopup() {
        const modal = document.getElementById('jewelNewPasswordModal');
        if (modal) { bootstrap.Modal.getOrCreateInstance(modal).show(); }
    }

    function closeNewPasswordPopup() {
        const modal = document.getElementById('jewelNewPasswordModal');
        if (modal) {
            const instance = bootstrap.Modal.getInstance(modal);
            if (instance) instance.hide();
        }
    }

    // 1. Registration Form Submit
    $('#registrationForm').submit(function(e) {
        e.preventDefault();
        $('#registrationErrors').hide().empty();
        $('#registerBtn').prop('disabled', true).text('Please wait...');

        $.ajax({
            url: "{{ route('saas.register.submit') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#registerBtn').prop('disabled', false).text('Sign Up');
                if (response.success) {
                    $('#otpAdminId').val(response.admin_id);
                    $('#jewelSignupVerificationEmail').text($('#registrationForm input[name="email"]').val());
                    $('#jewelSignupVerificationCode').val('');
                    $('#jewelSignupVerificationMessage').text('');
                    closeRegisterPopup();
                    openOtpModal();
                }
            },
            error: function(xhr) {
                $('#registerBtn').prop('disabled', false).text('Sign Up');
                $('.text-danger.first_name_error, .text-danger.last_name_error, .text-danger.email_error, .text-danger.username_error, .text-danger.company_error').text('');
                $('#registrationForm input').removeClass('is-invalid');
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    let html = '<ul>';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        html += '<li>' + value[0] + '</li>';
                        $('#registrationForm [name="' + key + '"]').addClass('is-invalid');
                    });
                    html += '</ul>';
                    $('#registrationErrors').html(html).show();
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    $('#registrationErrors').text(xhr.responseJSON.message).show();
                } else {
                    $('#registrationErrors').text('An error occurred during registration. Please try again.').show();
                }
            }
        });
    });

    // 2. OTP Verification Form Submit
    $('#jewelSignupVerificationForm').submit(function(e) {
        e.preventDefault();
        $('#jewelSignupVerificationMessage').text('');
        $('#verifyBtn').prop('disabled', true).text('Verifying...');

        $.ajax({
            url: "{{ route('saas.verify.otp') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#verifyBtn').prop('disabled', false).text('Verify & Create Account');
                if (response.success) {
                    closeOtpModal();
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful!',
                        text: 'Your account has been created successfully. You can now login.',
                        confirmButtonText: 'Login Now',
                        allowOutsideClick: false
                    }).then(() => { openAuthPopup(); });
                }
            },
            error: function(xhr) {
                $('#verifyBtn').prop('disabled', false).text('Verify & Create Account');
                let msg = 'Invalid or expired OTP. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const firstErr = Object.values(xhr.responseJSON.errors)[0];
                    if (firstErr && firstErr[0]) msg = firstErr[0];
                }
                $('#jewelSignupVerificationMessage').text(msg).css('color', '#a12622');
            }
        });
    });

    // Resend OTP Button Handler
    $('#jewelSignupResendOtp').click(function(e) {
        e.preventDefault();
        const $btn = $(this);
        $btn.prop('disabled', true).text('Resending...');
        $('#jewelSignupVerificationMessage').text('');

        $.ajax({
            url: "{{ route('saas.register.submit') }}",
            type: "POST",
            data: $('#registrationForm').serialize(),
            success: function(response) {
                $btn.prop('disabled', false).text('Resend OTP');
                if (response.success) {
                    $('#otpAdminId').val(response.admin_id);
                    $('#jewelSignupVerificationMessage').text('A new OTP has been sent to your email.').css('color', '#198754');
                }
            },
            error: function() {
                $btn.prop('disabled', false).text('Resend OTP');
                $('#jewelSignupVerificationMessage').text('Failed to resend OTP. Please try again.').css('color', '#a12622');
            }
        });
    });

    // 3. Login Form Submit
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
                $('#loginBtn').prop('disabled', false).text('Log In');
                if (xhr.status == 401) {
                    $('#loginErrors').html(xhr.responseJSON.message).show();
                } else if (xhr.status == 422) {
                    let html = '<ul>';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        html += '<li>' + value[0] + '</li>';
                    });
                    html += '</ul>';
                    $('#loginErrors').html(html).show();
                } else {
                    $('#loginErrors').html('Authentication failed. Please check credentials.').show();
                }
            }
        });
    });

    // 4. Send Forgot Password OTP (single handler, bound once)
    $('#sendForgotOtpBtn').off('click').on('click', function(e) {
        e.preventDefault();
        const $btn = $(this);
        const email = $.trim($('#forgotEmail').val());

        $('#forgotPasswordErrors').hide().empty();
        $('#forgotPasswordSuccess').hide().empty();

        if (!email) {
            $('#forgotPasswordErrors').text('Please enter your email address.').show();
            $('#forgotEmail').focus();
            return;
        }

        $btn.prop('disabled', true).text('Sending OTP...');

        $.ajax({
            url: "{{ route('forgot.password.send.otp') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}", email: email },
            success: function(response) {
                $btn.prop('disabled', false).text('Resend OTP');
                if (response.success) {
                    $('#forgotPasswordSuccess').text(response.message).show();
                    $('input[name="forgot_otp[]"]').first().focus();
                }
            },
            error: function(xhr) {
                $btn.prop('disabled', false).text('Submit');
                let msg = 'Failed to send OTP. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const firstErr = Object.values(xhr.responseJSON.errors)[0];
                    if (firstErr && firstErr[0]) msg = firstErr[0];
                }
                $('#forgotPasswordErrors').text(msg).show();
            }
        });
    });

    // Prevent form submit from firing again
    $('#jewelForgotForm').off('submit').on('submit', function(e) {
        e.preventDefault();
    });

    // Handle Forgot OTP input digits - enable verify button when complete
    $(document).on('input keyup', 'input[name="forgot_otp[]"]', function() {
        let code = '';
        $('input[name="forgot_otp[]"]').each(function() {
            code += $.trim($(this).val());
        });
        if (code.length === 6) {
            $('#verifyForgotOtpBtn').css({ 'background': '#07349a', 'cursor': 'pointer' });
        } else {
            $('#verifyForgotOtpBtn').css({ 'background': '#c8d2e8', 'cursor': 'not-allowed' });
        }
    });

    // 5. Verify Forgot Password OTP (single handler)
    $('#verifyForgotOtpBtn').off('click').on('click', function(e) {
        e.preventDefault();
        const $btn = $(this);
        const email = $.trim($('#forgotEmail').val());

        $('#forgotPasswordErrors').hide().empty();

        if (!email) {
            $('#forgotPasswordErrors').text('Please enter your email address first.').show();
            $('#forgotEmail').focus();
            return;
        }

        let otp = '';
        $('input[name="forgot_otp[]"]').each(function() {
            otp += $.trim($(this).val());
        });

        if (otp.length < 6) {
            $('#forgotPasswordErrors').text('Please enter all 6 digits of the verification code.').show();
            return;
        }

        $btn.prop('disabled', true).text('Verifying...');

        $.ajax({
            url: "{{ route('forgot.password.verify.otp') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}", email: email, otp: otp },
            success: function(response) {
                $btn.prop('disabled', false).text('Submit');
                if (response.success) {
                    $('#resetPasswordEmail').val(email);
                    $('#resetPasswordToken').val(response.reset_token);
                    $('#resetPasswordErrors').hide().empty();
                    $('#newPassword').val('');
                    $('#confirmNewPassword').val('');
                    closeForgotPopup();
                    setTimeout(function() { openNewPasswordPopup(); }, 300);
                }
            },
            error: function(xhr) {
                $btn.prop('disabled', false).text('Submit');
                let msg = 'Invalid or expired OTP. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const firstErr = Object.values(xhr.responseJSON.errors)[0];
                    if (firstErr && firstErr[0]) msg = firstErr[0];
                }
                $('#forgotPasswordErrors').text(msg).show();
            }
        });
    });

    // 6. Reset Password Form Submit
    $('#jewelResetPasswordForm').off('submit').on('submit', function(e) {
        e.preventDefault();
        $('#resetPasswordErrors').hide().empty();

        const pass = $('#newPassword').val();
        const confirmPass = $('#confirmNewPassword').val();

        if (pass.length < 6) {
            $('#resetPasswordErrors').text('Password must be at least 6 characters long.').show();
            return;
        }
        if (pass !== confirmPass) {
            $('#resetPasswordErrors').text('Password confirmation does not match.').show();
            return;
        }

        $('#resetPasswordBtn').prop('disabled', true).text('Submitting...');

        $.ajax({
            url: "{{ route('password.reset.submit') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#resetPasswordBtn').prop('disabled', false).text('Submit');
                if (response.success) {
                    closeNewPasswordPopup();
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Reset Successful!',
                        text: response.message,
                        confirmButtonText: 'Login Now',
                        allowOutsideClick: false
                    }).then(() => { openAuthPopup(); });
                }
            },
            error: function(xhr) {
                $('#resetPasswordBtn').prop('disabled', false).text('Submit');
                let msg = 'Failed to reset password. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let html = '<ul>';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        html += '<li>' + value[0] + '</li>';
                    });
                    html += '</ul>';
                    $('#resetPasswordErrors').html(html).show();
                    return;
                }
                $('#resetPasswordErrors').text(msg).show();
            }
        });
    });
</script>
'''

    with open(r'resources/views/invoice_front/includes/footer.blade.php', 'w', encoding='utf-8') as f:
        f.write(base_content + js_addition)
    print('SUCCESS: Duplicate script blocks removed. File saved.')

