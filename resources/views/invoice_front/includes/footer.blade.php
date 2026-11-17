<footer class="jewel-footer">
    <div class="container-fluid jewel-footer-container">

        <div class="row jewel-footer-main align-items-start g-5">

            {{-- Company Information --}}
            <div class="col-lg-3 col-md-6 jewel-footer-brand">
                <a href="{{ route('invoice-front') }}" class="jewel-footer-logo">
                    <img
                        src="{{ asset('front_assets/img/logo.png') }}"
                        alt="Jewelero.in"
                        class="jewel-footer-logo-img">
                </a>

                <p class="jewel-footer-description">
                    India’s trusted Jewellery ERP software, built to
                    simplify Billing, Inventory, and Business Management
                    for Jewellery Retailers, Wholesalers, and
                    Manufacturers.
                </p>



                <div class="jewel-footer-column jewel-footer-contact mt-3">
                    <h5>Contact Us</h5>

                    <ul class="jewel-contact-list">
                        <li>
                            <i class="fa-solid fa-envelope"></i>

                            <a href="mailto:support@jewelerp.in">
                                support@jewelerp.in
                            </a>
                        </li>

                        <li>

                            <i class="bi bi-telephone-fill"></i>
                            <a href="tel:+919021747534">
                                +91 90217 47534
                            </a>
                        </li>

                        <li> <i class="fa-solid fa-location-pin"></i>

                            <span>Pune, Maharashtra, India.</span>
                        </li>
                    </ul>
                </div>



                <div class="jewel-footer-socials">

                    <a href="https://www.facebook.com/jewelerpin"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="https://www.youtube.com/@Jewelerp"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>

                    <a href="https://www.instagram.com/jewelerpin/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="https://www.linkedin.com/company/jewelerp/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>

                </div>
            </div>



            <div class="col-lg-3 col-md-6 col-12 jewel-footer-column">
                <h5>Our Solutions</h5>
                <ul>
                    <li><a href="{{ url('/invoice-and-solution') }}">Invoice & Sell Management</a></li>
                    <li><a href="{{ url('/invoice-and-solution') }}">Purchase Management</a></li>
                    <li><a href="{{ url('/invoice-and-solution') }}"> Karigar & Job Work</a></li>
                    <li><a href="{{ url('/invoice-and-solution') }}">Barcode & RFID Tagging</a></li>
                    <li><a href="{{ url('/invoice-and-solution') }}">Discount & Scheme Management</a></li>
                    <!-- <li><a href="#">FAQ</a></li> -->
                    <li><a href="{{ url('/invoice-and-solution') }}">Real-Time MIS Reports</a></li>
                    <li><a href="{{ url('/invoice-and-solution') }}">Multi-Branch Management</a></li>
                    <li><a href="{{ url('/invoice-and-solution') }}">Old Gold Exchange</a></li>
                    <li><a href="{{ url('/invoice-and-solution') }}">Inventory Management</a></li>

                </ul>
            </div>



            {{-- Quick Links --}}
            <div class="col-lg-2 col-md-4 col-12 jewel-footer-column">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('pricing') }}">Pricing</a></li>
                    <li> <a href="{{ route('invoice-front') }}#solutions"> Our Solution</a></li>
                    <li><a href="{{ url('/integration') }}">Integration</a></li>
                    <li><a href="{{ url('videos') }}">videos</a></li>

                    <li><a href="{{ url('contact') }}">Contact</a></li>
                    <!-- <li><a href="#">FAQ</a></li> -->
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ url('FAQS') }}">FAQs</a></li>
                </ul>
            </div>


            <div class="col-lg-2 col-md-4 col-12 jewel-footer-column">
                <h5>Support</h5>
                <ul>
                    <li><a href="{{ url('help') }}">Help Center</a></li>

                    <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('refund-and-cancellation') }}">Refund &amp; Cancellation</a></li>
                    <li>
                        <a href="{{ url('terms-conditions') }}">
                            Terms &amp; Conditions
                        </a>
                    </li>

                    </li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-12 jewel-footer-column">
                <h5>By City</h5>
                <ul>
                    <li>Jewelerp software in Pune</li>
                    <li>Jewelerp software in Mumbai</li>
                    <li>Jewelerp software in Delhi</li>
                    <li>Jewelerp software in Bangalore</li>
                    <li>Jewelerp software in Gujarat</li>
                    <li>Jewelerp software in Ahmedabad</li>
                    <li>Jewelerp software in Hyderabad</li>


                    </li>

                    </li>
                </ul>
            </div>


            {{-- Support --}}

            {{-- Contact --}}
            <!-- <div class="col-lg-3 col-md-4 col-12 jewel-footer-column jewel-footer-contact">
                <h5>Contact Us</h5>

                <ul class="jewel-contact-list">
                    <li>
                       <i class="fa-solid fa-envelope"></i>

                        <a href="mailto:support@jewelerp.in">
                            support@jewelerp.in
                        </a>
                    </li>

                    <li>
                      
 <i class="bi bi-telephone-fill"></i>
                        <a href="tel:+919021747534">
                            +91 90217 47534
                        </a>
                    </li>

                    <li> <i class="fa-solid fa-location-pin"></i>
                       
                        <span>Pune, Maharashtra, India.</span>
                    </li>
                </ul>
            </div>

        </div> -->

            {{-- Copyright --}}
            <div class="jewel-footer-bottom">
                <p>
                    © 2026 All Rights Reserved by Jewelerp.
                    <a href="https://sirsonite.com" target="_blank" rel="noopener noreferrer">
                        Powered by Sirsonite Solutions Pvt. Ltd.
                    </a>
                </p>
            </div>

        </div>
</footer>

<!-- =========================================================
     JEWELERP CHAT SYSTEM
========================================================= -->

<div class="jewel-chat-system">


    <!-- =====================================================
         FLOATING BUTTONS
    ====================================================== -->

    <div class="jewel-floating-buttons">


        <!-- WHATSAPP -->

        <a
            href="https://wa.me/9021747534"
            target="_blank"
            rel="noopener noreferrer"
            class="jewel-whatsapp"
            aria-label="WhatsApp">

            <i class="fa-brands fa-whatsapp"></i>

        </a>


        <!-- FREE CHAT -->

        <button
            type="button"
            class="jewel-chat-open"
            id="jewelOpenChat"
            aria-label="Open Free Chat">



            <i class="fa-solid fa-comments"></i>

        </button>


        <!-- BACK TO TOP -->

        <button
            type="button"
            class="jewel-back-top"
            id="jewelBackTop"
            aria-label="Back to top">

            <i class="fa-solid fa-arrow-up"></i>

        </button>


    </div>


    <!-- =====================================================
         chatboat
    ====================================================== -->

    <div
        class="jewel-chat-overlay"
        id="jewelChatOverlay"></div>


    <!-- =====================================================
         RIGHT ALIGNED CHATBOX
    ====================================================== -->

    <div
        class="jewel-chat-box"
        id="jewelChatBox"
        aria-hidden="true">


        <!-- =================================================
             HEADER
        ================================================== -->

        <div class="jewel-chat-header">


            <div class="jewel-chat-profile">

                <div class="jewel-chat-avatar">

                    <i class="fa-solid fa-headset"></i>

                </div>


                <div>

                    <strong class="jewel-chat-heading">
                        JewelERP Support
                    </strong>


                    <span class="jewel-chat-online">

                        <i class="fa-solid fa-circle"></i>

                        Online Assistance

                    </span>

                </div>

            </div>


            <button
                type="button"
                class="jewel-chat-close"
                id="jewelCloseChat"
                aria-label="Close chat">

                <i class="fa-solid fa-xmark"></i>

            </button>


        </div>


        <!-- =================================================
             CHAT BODY
        ================================================== -->

        <div
            class="jewel-chat-body"
            id="jewelChatBody">


            <!-- BOT MESSAGE -->

            <div class="jewel-chat-message">

                <div class="jewel-message-icon">

                    <i class="fa-solid fa-robot"></i>

                </div>


                <div class="jewel-message-content">

                    <p>
                        Hello! Welcome to JewelERP.
                        How can I assist you with your
                        jewellery business today?
                    </p>

                </div>

            </div>


            <!-- QUICK ACTIONS -->

            <div class="jewel-quick-buttons">

                <button
                    type="button"
                    data-question="Tell me about your services">
                    Services
                </button>


                <button
                    type="button"
                    data-question="I want to contact your team">
                    Contact Team
                </button>


                <button
                    type="button"
                    data-question="Tell me about JewelERP">
                    About Us
                </button>

            </div>


        </div>


        <!-- =================================================
             FOOTER
        ================================================== -->

        <div class="jewel-chat-footer">


            <input
                type="text"
                class="jewel-chat-input"
                id="jewelChatInput"
                placeholder="Type your message..."
                autocomplete="off">


            <button
                type="button"
                class="jewel-chat-send"
                id="jewelSendChat"
                aria-label="Send message">

                <i class="fa-solid fa-paper-plane"></i>

            </button>


        </div>





    </div>

</div>


<!-- ===========chatboat-end=============  -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const topBtn = document.querySelector(".zri-top-btn");

        if (!topBtn) return;

        const updateTopButton = function() {
            topBtn.classList.toggle("show", window.scrollY > 200);
        };

        window.addEventListener("scroll", updateTopButton, {
            passive: true
        });
        updateTopButton();

        // Scroll smoothly to the top
        topBtn.addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: "smooth"
            });
        });

    });
</script>




<!------------ Payment Success Popup -------------->

<div class="modal fade" id="paymentSuccessOverlay"
    tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content payment-success-modal">
            <div class="payment-success-modal">

                <!-- Success Icon -->
                <div class="payment-success-icon">
                    <i class="bi bi-check-circle"></i>
                </div>

                <!-- Heading -->
                <h5 class="payment-success-title">Payment Successful!</h5>

                <p class="payment-success-description">
                    Your payment has been processed successfully.
                    You will receive a confirmation email shortly.
                </p>

                <!-- Transaction Details -->
                <div class="payment-transaction-details">
                    <div class="payment-detail-row forborder">
                        <span>Amount</span>
                        <strong>149.99</strong>
                    </div>

                    <div class="payment-detail-row">
                        <span>Transaction ID</span>
                        <strong class="transaction-id">TXN-789123456</strong>
                    </div>

                    <div class="payment-detail-row">
                        <span>Payment Method</span>
                        <strong>•••• 4242</strong>
                    </div>

                    <div class="payment-detail-row">
                        <span>Date</span>
                        <strong>Dec 15, 2024</strong>
                    </div>

                    <div class="payment-detail-row">
                        <span>Merchant</span>
                        <strong>TechStore Pro</strong>
                    </div>
                </div>

                <!-- Receipt Notification -->
                <div class="payment-receipt-notice">
                    <i class="bi bi-envelope"></i>
                    <span>Receipt sent to customer@example.com</span>
                </div>

                <!-- Action Buttons -->
                <div class="payment-success-actions">
                    <button type="button" class="btn payment-download-btn"
                        onclick="downloadPaymentReceipt()">
                        <i class="bi bi-download me-2"></i>
                        Download Receipt
                    </button>

                    <a href="{{ url('/') }}" class="btn payment-home-btn">
                        <i class="bi bi-arrow-left me-2"></i>
                        Return to Home
                    </a>
                </div>

                <!-- Support -->
                <p class="payment-support-text">
                    Need help? Contact our support team at
                    <a href="mailto:support@techstore.com">
                        support@techstore.com
                    </a>
                </p>

            </div>
        </div>
    </div>
</div>

<!-- ===================password recovery suceesfull=========== -->

<!-- Open Popup Button (optional) -->
<div class="modal fade password-recovery-modal"
    id="passwordRecoveryModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content password-recovery-content">

            <div class="password-recovery-icon">
                <span>👍🏻</span>
            </div>

            <h4>Password Recovery<br>Successful</h4>

            <p>
                Return to the login screen to enter the application
            </p>

            <a href="{{ url('/login') }}"
                class="btn password-recovery-btn">
                Return to login
            </a>

        </div>
    </div>
</div>



<!-- Signup Modal -->
<div class="modal fade jewel-signup-modal"
    id="jewelSignupModal"
    tabindex="-1"
    aria-labelledby="jewelSignupModalLabel"
    aria-hidden="true"
    data-bs-backdrop="static">

    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- Close Button -->
            <button type="button"
                class="btn-close jewel-signup-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>

            <section class="jewel-signup-page">
                <div class="container-fluid p-0">
                    <div class="row g-0 jewel-signup-row">

                        <!-- Left Image -->
                        <div class="col-lg-6 jewel-signup-image">
                            <img
                                src="{{ asset('front_assets/img/sign-up.jpg') }}"
                                alt="Jewelry Dashboard"
                                class="jewel-signup-main-image">
                        </div>

                        <!-- Right Signup Section -->
                        <div class="col-lg-6 jewel-signup-right">

                            <div class="jewel-signup-decoration jewel-signup-decoration-top">
                                <img src="{{ asset('front_assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-decoration jewel-signup-decoration-bottom">
                                <img src="{{ asset('front_assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-content">

                                <!-- Logo -->
                                <a href="{{ url('/') }}" class="jewel-signup-logo">
                                    <img
                                        src="{{ asset('front_assets/img/logo.png') }}"
                                        alt="Jewelerp Logo">
                                </a>

                                <h4 class="jewel-signup-title"
                                    id="jewelSignupModalLabel">Sign Up</h4>

                                <!-- Signup Form -->

                                <form id="registrationForm" class="jewel-signup-form">
                                    @csrf

                                    <div id="registrationErrors" class="alert alert-danger" style="display:none;"></div>


                                    <!-- Full Name -->
                                    <div class="jewel-signup-field">
                                        <i class="bi bi-person-fill"></i>
                                        <input type="text"
                                            name="name"
                                            placeholder="Full Name"
                                            required>
                                    </div>

                                    <!-- Email -->
                                    <div class="jewel-signup-field">
                                        <i class="bi bi-envelope-fill"></i>
                                        <input type="email"
                                            name="email"
                                            placeholder="Email Address"
                                            required>
                                    </div>

                                    <!-- Username -->
                                    <div class="jewel-signup-field">
                                        <i class="bi bi-person-fill"></i>
                                        <input type="text"
                                            name="username"
                                            placeholder="Username"
                                            autocomplete="username"
                                            required>
                                    </div>

                                    <!-- Phone -->
                                    <div class="jewel-signup-field">
                                        <i class="bi bi-telephone-fill"></i>
                                        <input type="tel"
                                            name="phone"
                                            placeholder="Phone Number">
                                    </div>

                                    <!-- Company -->
                                    <div class="jewel-signup-field">
                                        <i class="bi bi-building"></i>
                                        <input type="text"
                                            name="company"
                                            placeholder="Company Name"
                                            required>
                                    </div>

                                    <!-- Password -->
                                    <div class="jewel-signup-field">
                                        <i class="bi bi-lock-fill"></i>
                                        <input
                                            type="password"
                                            name="password"
                                            id="signupPassword"
                                            placeholder="Password***"
                                            required>
                                        <button type="button"
                                            class="jewel-password-toggle"
                                            onclick="toggleSignupPassword('signupPassword', this)">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="jewel-signup-field">
                                        <i class="bi bi-lock-fill"></i>
                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            id="confirmSignupPassword"
                                            placeholder="Confirm Password***"
                                            required>
                                        <button type="button"
                                            class="jewel-password-toggle"
                                            onclick="toggleSignupPassword('confirmSignupPassword', this)">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" id="registerBtn" class="jewel-signup-button">
                                        Sign Up
                                    </button>

                                </form>

                                <p class="jewel-signup-login">
                                    Already have an account?
                                    <a href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#jewelLoginModal">Login</a>
                                </p>

                                <p class="jewel-signup-login jewel-forgot-password">
                                    <a href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#jewelForgotModal">
                                        Forgot Password
                                    </a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>



<!-- =================new-mode-============== -->
<!-- Signup email verification modal -->
<div class="modal fade jewel-verification-modal"
    id="jewelSignupVerificationModal"
    tabindex="-1"
    aria-labelledby="jewelSignupVerificationTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button"
                class="jewel-verification-close"
                data-bs-dismiss="modal"
                aria-label="Close">
                <i class="bi bi-x-lg" aria-hidden="true"></i>
            </button>

            <div class="jewel-verification-body">
                <div class="jewel-verification-icon" aria-hidden="true">
                    <i class="bi bi-envelope-fill"></i>
                </div>

                <h2 id="jewelSignupVerificationTitle">Verify Your Email</h2>
                <p class="jewel-verification-description">
                    We've sent a <strong>6-digit verification code</strong> to
                    <strong id="jewelSignupVerificationEmail">your email address</strong>.
                </p>

                <form id="jewelSignupVerificationForm">
                    @csrf
                    <input type="hidden" name="admin_id" id="otpAdminId">
                    <label class="visually-hidden" for="jewelSignupVerificationCode">
                        6-digit verification code
                    </label>
                    <input type="text"
                        id="jewelSignupVerificationCode"
                        name="otp"
                        inputmode="numeric"
                        autocomplete="one-time-code"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        placeholder="Enter OTP"
                        aria-describedby="jewelSignupVerificationMessage"
                        required>

                    <button type="submit" id="verifyBtn" class="jewel-verification-submit">
                        Verify &amp; Create Account
                    </button>
                </form>

                <p class="jewel-verification-resend">
                    Didn't receive the code?
                    <button type="button" id="jewelSignupResendOtp">Resend OTP</button>
                </p>
                <p id="jewelSignupVerificationMessage"
                    class="jewel-verification-message"
                    role="status"
                    aria-live="polite"></p>
            </div>
        </div>
    </div>
</div>
<!-- ==============new-model================= -->


<!-- Login Modal -->
<div class="modal fade jewel-signup-modal"
    id="jewelLoginModal"
    tabindex="-1"
    aria-labelledby="jewelLoginModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- Close Button -->
            <button type="button"
                class="btn-close jewel-signup-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>

            <section class="jewel-signup-page">
                <div class="container-fluid p-0">
                    <div class="row g-0 jewel-signup-row">

                        <!-- Left Image -->
                        <div class="col-lg-6 jewel-signup-image">
                            <img
                                src="{{ asset('front_assets/img/sign-up.jpg') }}"
                                alt="Jewelry Dashboard"
                                class="jewel-signup-main-image">
                        </div>

                        <!-- Right Login Section -->
                        <div class="col-lg-6 jewel-signup-right">

                            <div class="jewel-signup-decoration jewel-signup-decoration-top">
                                <img src="{{ asset('front_assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-decoration jewel-signup-decoration-bottom">
                                <img src="{{ asset('front_assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-content">

                                <!-- Logo -->
                                <a href="{{ url('/') }}" class="jewel-signup-logo">
                                    <img
                                        src="{{ asset('front_assets/img/logo.png') }}"
                                        alt="Jewelerp Logo">
                                </a>

                                <h4 class="jewel-signup-title"
                                    id="jewelLoginModalLabel">
                                    Welcome Back
                                </h4>

                                <p class="jewel-para">
                                    Login to access your dashboard
                                </p>

                                <!-- Login Form -->
                                <form id="loginForm" class="jewel-signup-form">
                                    @csrf

                                    <div id="loginErrors" class="alert alert-danger" style="display:none;"></div>

                                    <!-- Email -->
                                    <div class="jewel-signup-field">
                                        <i class="bi bi-person-fill"></i>
                                        <input
                                            type="text"
                                            name="email"
                                            placeholder="Email"
                                            autocomplete="username"
                                            required>
                                    </div>

                                    <!-- Password -->
                                    <div class="jewel-signup-field">
                                        <i class="bi bi-lock-fill"></i>
                                        <input
                                            type="password"
                                            name="password"
                                            id="loginPassword"
                                            placeholder="Password***"
                                            autocomplete="current-password"
                                            required>

                                        <button type="button"
                                            class="jewel-password-toggle"
                                            onclick="toggleLoginPassword('loginPassword', this)"
                                            aria-label="Show password">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>

                                    <!-- Signup Link -->
                                    <p class="jewel-signup-login">
                                        Don’t have an account?
                                        <a href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#jewelSignupModal">Sign Up</a>
                                    </p>

                                    <!-- Forgot Password -->
                                    <p class="jewel-signup-login jewel-forgot-password">
                                        <a href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#jewelForgotModal">
                                            Forgot Password
                                        </a>
                                    </p>

                                    <!-- Submit -->
                                    <button type="submit" id="loginBtn" class="jewel-signup-button">
                                        Log In
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>




<!-- Set New Password Modal -->
<div class="modal fade jewel-new-password-modal"
    id="jewelNewPasswordModal"
    tabindex="-1"
    aria-labelledby="jewelNewPasswordModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <!-- Close Button -->
            <button type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                style="position:absolute; top:15px; right:15px; z-index:1060;">
            </button>

            <section class="jewel-signup-page jewel-new-password-page">
                <div class="container-fluid p-0">
                    <div class="row g-0 jewel-signup-row">

                        <!-- Left Image -->
                        <div class="col-lg-6 jewel-signup-image">
                            <img
                                src="{{ asset('front_assets/img/sign-up.jpg') }}"
                                alt="Jewelry Dashboard"
                                class="jewel-signup-main-image">
                        </div>

                        <!-- Right Signup Section -->
                        <div class="col-lg-6 jewel-signup-right">

                            <div class="jewel-signup-decoration jewel-signup-decoration-top">
                                <img src="{{ asset('front_assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-decoration jewel-signup-decoration-bottom">
                                <img src="{{ asset('front_assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-content">

                                <!-- Logo -->
                                <a href="{{ url('/') }}" class="jewel-signup-logo">
                                    <img
                                        src="{{ asset('front_assets/img/logo.png') }}"
                                        alt="Jewelerp Logo">
                                </a>

                                <div class="jewel-forgot-form-content">

                                    <h4 class="jewel-forgot-title"
                                        id="jewelNewPasswordModalLabel">
                                        Set new password
                                    </h4>

                                    <p class="jewel-forgot-description">
                                        Enter your new password below and
                                        <br class="d-none d-sm-block">
                                        check the hint while setting it.
                                    </p>

                                    <form class="jewel-forgot-form"
                                        id="jewelResetPasswordForm"
                                        action="{{ url('/reset-password') }}"
                                        method="POST">
                                        @csrf

                                        <input type="hidden" name="email" id="resetPasswordEmail">
                                        <input type="hidden" name="token" id="resetPasswordToken">

                                        <div id="resetPasswordErrors" class="alert alert-danger" style="display:none;"></div>

                                        <div class="jewel-forgot-email jewel-new-password-field">
                                            <label for="newPassword">Set new password</label>
                                            <input
                                                type="password"
                                                id="newPassword"
                                                name="password"
                                                placeholder="Input password here"
                                                autocomplete="new-password"
                                                required>

                                            <button
                                                type="button"
                                                class="jewel-new-password-toggle"
                                                aria-label="Show new password"
                                                aria-pressed="false"
                                                onclick="toggleNewPasswordVisibility('newPassword', this)">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </div>
                                        <div class="jewel-password-hints">
                                            <span class="jewel-password-hint">Hint: minimum 6 characters</span>

                                            <a href="#jewelForgotModal"
                                                class="jewel-password-forgot-link"
                                                data-bs-toggle="modal"
                                                data-bs-target="#jewelForgotModal">
                                                Forgot password?
                                            </a>
                                        </div>

                                        <div class="jewel-forgot-email jewel-new-password-field">
                                            <label for="confirmNewPassword">Confirm password</label>
                                            <input
                                                type="password"
                                                id="confirmNewPassword"
                                                name="password_confirmation"
                                                autocomplete="new-password"
                                                required>

                                            <button
                                                type="button"
                                                class="jewel-new-password-toggle"
                                                aria-label="Show confirmation password"
                                                aria-pressed="false"
                                                onclick="toggleNewPasswordVisibility('confirmNewPassword', this)">
                                                <i class="bi bi-eye-slash-fill"></i>
                                            </button>
                                        </div>

                                        <button type="submit" id="resetPasswordBtn" class="jewel-forgot-button">
                                            Submit
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<!-- Forgot Password Bootstrap Modal -->
<div class="modal fade jewel-signup-modal"
    id="jewelForgotModal"
    tabindex="-1"
    aria-labelledby="jewelForgotModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- Close Button -->
            <button type="button"
                class="btn-close jewel-signup-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>

            <section class="jewel-signup-page">
                <div class="container-fluid p-0">
                    <div class="row g-0 jewel-signup-row">

                        <!-- Left Image -->
                        <div class="col-lg-6 jewel-signup-image">
                            <img
                                src="{{ asset('front_assets/img/sign-up.jpg') }}"
                                alt="Jewelry Dashboard"
                                class="jewel-signup-main-image">
                        </div>

                        <!-- Right Forgot Password Section -->
                        <div class="col-lg-6 jewel-signup-right">

                            <div class="jewel-signup-decoration jewel-signup-decoration-top">
                                <img src="{{ asset('front_assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-decoration jewel-signup-decoration-bottom">
                                <img src="{{ asset('front_assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-content">

                                <!-- Logo -->
                                <a href="{{ url('/') }}" class="jewel-signup-logo">
                                    <img
                                        src="{{ asset('front_assets/img/logo.png') }}"
                                        alt="Jewelerp Logo">
                                </a>

                                <div class="jewel-forgot-form-content">

                                    <h4 class="jewel-forgot-title"
                                        id="jewelForgotModalLabel">
                                        Forgot Password
                                    </h4>

                                    <p class="jewel-forgot-description">
                                        Oops. It happens to the best of us. Input your<br class="d-none d-sm-block">
                                        email address to fix the issue.
                                    </p>

                                    <form class="jewel-forgot-form" id="jewelForgotForm">
                                        @csrf

                                        <div id="forgotPasswordErrors" class="alert alert-danger" style="display:none; font-size:14px; padding:8px 12px; margin-bottom:12px;"></div>
                                        <div id="forgotPasswordSuccess" class="alert alert-success" style="display:none; font-size:14px; padding:8px 12px; margin-bottom:12px;"></div>

                                        <div class="jewel-forgot-email">
                                            <label for="forgotEmail">Email</label>
                                            <input
                                                type="email"
                                                id="forgotEmail"
                                                name="email"
                                                placeholder="Input here"
                                                autocomplete="email"
                                                required>
                                        </div>

                                        <button type="button"
                                            id="sendForgotOtpBtn"
                                            class="jewel-forgot-button">
                                            Submit
                                        </button>

                                        <h5 class="jewel-forgot-verify-title">
                                            Verify
                                        </h5>
                                        <div class="jewel-forgot-otp"
                                            role="group"
                                            aria-label="Verification code">

                                            @for ($digit = 1; $digit <= 6; $digit++)
                                                <input
                                                type="text"
                                                name="forgot_otp[]"
                                                inputmode="numeric"
                                                maxlength="1"
                                                autocomplete="off"
                                                aria-label="Verification code digit {{ $digit }}"
                                                class="jewel-common-otp"
                                                oninput="jewelMoveOtp(this)"
                                                onkeydown="jewelOtpBackspace(event, this)">
                                                @endfor

                                        </div>
                                        <button type="button"
                                            id="verifyForgotOtpBtn"
                                            class="jewel-forgot-button jewel-forgot-verify-button">
                                            Submit
                                        </button>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    /* Combined JavaScript for all modals */

    function toggleSignupPassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    }

    function toggleLoginPassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
            button.setAttribute('aria-label', 'Hide password');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
            button.setAttribute('aria-label', 'Show password');
        }
    }

    function toggleNewPasswordVisibility(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');
        const isPasswordHidden = input.type === 'password';

        input.type = isPasswordHidden ? 'text' : 'password';
        icon.classList.toggle('bi-eye-fill', !isPasswordHidden);
        icon.classList.toggle('bi-eye-slash-fill', isPasswordHidden);
        button.setAttribute('aria-pressed', String(isPasswordHidden));
        button.setAttribute(
            'aria-label',
            `${isPasswordHidden ? 'Hide' : 'Show'} ${inputId === 'newPassword' ? 'new' : 'confirmation'} password`
        );
    }

    /* Open modals automatically on direct route visits */
    document.addEventListener('DOMContentLoaded', function() {
        if (!window.bootstrap) return;

        // Signup modal
        const signupModal = document.getElementById('jewelSignupModal');
        if (signupModal && @json(request()->routeIs('signup'))) {
            new bootstrap.Modal(signupModal).show();
        }

        // Login modal
        const loginModal = document.getElementById('jewelLoginModal');
        if (loginModal && @json(request()->routeIs('login'))) {
            bootstrap.Modal.getOrCreateInstance(loginModal).show();
        }

        // Forgot password modal - only open on forgotpassword route
        const forgotModal = document.getElementById('jewelForgotModal');
        if (forgotModal && @json(request()->routeIs('forgotpassword'))) {
            bootstrap.Modal.getOrCreateInstance(forgotModal).show();
        }


        // ================new-model======================
        const verificationCode = document.getElementById('jewelSignupVerificationCode');
        if (verificationCode) {
            verificationCode.addEventListener('input', function() {
                verificationCode.value = verificationCode.value.replace(/[^0-9]/g, '').slice(0, 6);
            });
        }
        // ============================new-model===================

        // Handle modal switching
        document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                const targetModalId = this.getAttribute('data-bs-target');
                const currentModal = this.closest('.modal');

                if (currentModal && currentModal.id !== targetModalId.replace('#', '')) {
                    e.preventDefault();
                    const currentModalInstance = bootstrap.Modal.getInstance(currentModal);
                    if (currentModalInstance) {
                        currentModalInstance.hide();
                    }

                    // Wait for current modal to close before opening new one
                    setTimeout(function() {
                        const targetModal = document.querySelector(targetModalId);
                        if (targetModal) {
                            const targetModalInstance = bootstrap.Modal.getOrCreateInstance(targetModal);
                            targetModalInstance.show();
                        }
                    }, 300);
                }
            });
        });
    });

</script>


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
