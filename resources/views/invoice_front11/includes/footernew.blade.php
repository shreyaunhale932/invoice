<footer class="jewel-footer">
    <div class="container-fluid jewel-footer-container">

        <div class="row jewel-footer-main align-items-start g-5">

            {{-- Company Information --}}
            <div class="col-lg-3 col-md-6 jewel-footer-brand">
                <a href="{{ route('invoice-front') }}" class="jewel-footer-logo">
                    <img
                        src="{{ asset('public/assets/img/logo.png') }}"
                        alt="Jewelero.in"
                        class="jewel-footer-logo-img"
                    >
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
    <a href="{{ url('terms-conditions') }}" >
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
      <li>Jewelerp software in Hyderabad</li>
       <li>Jewelerp software in Jaipur</li>
      <li>Jewelerp software in Haryana</li>
</li>    
   
</li>
</ul>
            </div>


            {{-- Support --}}
           
            {{-- Contact --}}
           

        {{-- Copyright --}}
        <div class="jewel-footer-bottom">
            <p>
               © 2026 All Rights Reserved by Jewelerp.
                <a href="https://sirsonite.com" target="_blank" rel="noopener noreferrer" >
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
            aria-label="WhatsApp"
        >

            <i class="fa-brands fa-whatsapp"></i>

        </a>


        <!-- FREE CHAT -->

        <button
            type="button"
            class="jewel-chat-open"
            id="jewelOpenChat"
            aria-label="Open Free Chat"
        >

           

            <i class="fa-solid fa-comments"></i>

        </button>


        <!-- BACK TO TOP -->

        <button
            type="button"
            class="jewel-back-top"
            id="jewelBackTop"
            aria-label="Back to top"
        >

            <i class="fa-solid fa-arrow-up"></i>

        </button>


    </div>


    <!-- =====================================================
         chatboat
    ====================================================== -->

    <div
        class="jewel-chat-overlay"
        id="jewelChatOverlay"
    ></div>


    <!-- =====================================================
         RIGHT ALIGNED CHATBOX
    ====================================================== -->

    <div
        class="jewel-chat-box"
        id="jewelChatBox"
        aria-hidden="true"
    >


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
                aria-label="Close chat"
            >

                <i class="fa-solid fa-xmark"></i>

            </button>


        </div>


        <!-- =================================================
             CHAT BODY
        ================================================== -->

        <div
            class="jewel-chat-body"
            id="jewelChatBody"
        >


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
                    data-question="Tell me about your services"
                >
                    Services
                </button>


                <button
                    type="button"
                    data-question="I want to contact your team"
                >
                    Contact Team
                </button>


                <button
                    type="button"
                    data-question="Tell me about JewelERP"
                >
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
                autocomplete="off"
            >


            <button
                type="button"
                class="jewel-chat-send"
                id="jewelSendChat"
                aria-label="Send message"
            >

                <i class="fa-solid fa-paper-plane"></i>

            </button>


        </div>


      


    </div>

</div>


<!-- ===========chatboat-end=============  -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const topBtn = document.querySelector(".zri-top-btn");

    if (!topBtn) return;

    const updateTopButton = function () {
        topBtn.classList.toggle("show", window.scrollY > 200);
    };

    window.addEventListener("scroll", updateTopButton, { passive: true });
    updateTopButton();

    // Scroll smoothly to the top
    topBtn.addEventListener("click", function () {
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
        <div class="modal-content payment-success-modal">    <div class="payment-success-modal">

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
    </div></div>

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
                                src="{{ asset('public/assets/img/sign-up.jpg') }}"
                                alt="Jewelry Dashboard"
                                class="jewel-signup-main-image"
                            >
                        </div>

                        <!-- Right Signup Section -->
                        <div class="col-lg-6 jewel-signup-right">

                            <div class="jewel-signup-decoration jewel-signup-decoration-top">
                                <img src="{{ asset('public/assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-decoration jewel-signup-decoration-bottom">
                                <img src="{{ asset('public/assets/img/icons/3.svg') }}" alt="">
                            </div>

<div class="jewel-signup-content">

                                <!-- Logo -->
                                <a href="{{ url('/') }}" class="jewel-signup-logo">
                                    <img
                                        src="{{ asset('public/assets/img/logo.png') }}"
                                        alt="Jewelerp Logo"
                                    >
                                </a>

                                <h4 class="jewel-signup-title"
                                    id="jewelSignupModalLabel">Sign Up</h4>

                                <!-- Signup Form -->
                                <form class="jewel-signup-form" id="jewelSignupForm">

                                    @csrf

                                    <div class="row g-2">
                                        <!-- Full Name -->
                                        <div class="col-12 col-md-6">
                                            <div class="jewel-signup-field">
                                                <i class="bi bi-person-fill" aria-hidden="true"></i>
                                                <input type="text"
                                                       name="First name"
                                                       placeholder="First Name"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="jewel-signup-field">
                                                <i class="bi bi-person-fill" aria-hidden="true"></i>
                                                <input type="text"
                                                       name="Last name"
                                                       placeholder="Last Name"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="jewel-signup-field">
                                                <i class="bi bi-building-fill" aria-hidden="true"></i>
                                                <input type="text"
                                                       name="company"
                                                       placeholder="Company Name *"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="jewel-signup-field">
                                                <i class="bi bi-person-badge-fill" aria-hidden="true"></i>
                                                <input type="text"
                                                       name="Username"
                                                       placeholder="Username "
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Email -->
                                    <div class="jewel-signup-field jewel-signup-email-field">
                                        <i class="bi bi-envelope-fill" aria-hidden="true"></i>
                                        <input type="email"
                                               name="email"
                                               placeholder="Email Address"
                                               required>
                                        <!-- <button type="button" class="jewel-email-verify">
                                            Verify
                                        </button> -->
                                    </div>

                                    <!--
                                   <div class="jewel-signup-otp"
     role="group"
     aria-label="Verification code">

    @for ($digit = 1; $digit <= 5; $digit++)
        <input
            type="text"
            name="otp[]"
            inputmode="numeric"
            maxlength="1"
            autocomplete="off"
            aria-label="Verification code digit {{ $digit }}"
            class="jewel-common-otp"
            onpaste="jewelPasteOtp(event, this)"
            oninput="jewelMoveOtp(this)"
            onkeydown="jewelOtpBackspace(event, this)"
        >
    @endfor

</div> -->

                                    <div class="row g-2">
                                        <div class="col-12 col-md-6">
                                            <div class="jewel-signup-field">
                                                <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                                                <input type="tel"
                                                       name="phone"
                                                       placeholder="Phone Number"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="jewel-signup-field">
                                                <i class="bi bi-buildings" aria-hidden="true"></i>
                                                <input type="text"
                                                       name="City"
                                                       placeholder="City"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="jewel-signup-field">
                                                <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                                                <select name="State" required>
                                                    <option value="" disabled selected>Select State</option>
                                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                    <option value="Assam">Assam</option>
                                                    <option value="Bihar">Bihar</option>
                                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                                    <option value="Goa">Goa</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                    <option value="Jharkhand">Jharkhand</option>
                                                  
                                                 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="jewel-signup-field">
                                                <i class="bi bi-mailbox2" aria-hidden="true"></i>
                                                <input type="text"
                                                       name="Pincode"
                                                       placeholder="Pincode"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            
                                            <div class=" jewel-signup-field jewel-signup-email-field">
                                                <i class="bi bi-house-door-fill" aria-hidden="true"></i>
                                                <input type="text"
                                                       name="Address"
                                                       placeholder="Address"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 ">
                                            <div class="jewel-signup-field">
                                                <i class="bi bi-lock-fill"></i>
                                                <input
                                                    type="password"
                                                    name="password"
                                                    id="signupPassword"
                                                    placeholder="Password*"
                                                    required
                                                >
                                                <button type="button"
                                                        class="jewel-password-toggle"
                                                        onclick="toggleSignupPassword('signupPassword', this)">
                                                    <i class="bi bi-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="jewel-signup-field">
                                                <i class="bi bi-lock-fill"></i>
                                                <input
                                                    type="password"
                                                    name="password_confirmation"
                                                    id="confirmSignupPassword"
                                                    placeholder="Confirm Password*"
                                                    required
                                                >
                                                <button type="button"
                                                        class="jewel-password-toggle"
                                                        onclick="toggleSignupPassword('confirmSignupPassword', this)">
                                                    <i class="bi bi-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="jewel-signup-button">
                                        Sign Up
                                    </button>

                                </form>

                                <p class="jewel-signup-login">
                                    Already have an account?
                                    <a href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#jewelLoginModal">Login</a>
                                </p>

                                <!-- <p class="jewel-signup-login jewel-forgot-password">
                                    <a href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#jewelForgotModal">
                                        Forgot Password
                                    </a>
                                </p> -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<!-- Email Verification Modal -->
<div class="modal fade jewel-email-otp-modal"
     id="jewelEmailOtpModal"
     tabindex="-1"
     aria-labelledby="jewelEmailOtpModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button"
                    class="btn-close jewel-email-otp-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            <div class="modal-body">
                <div class="jewel-email-otp-icon" aria-hidden="true">
                    <i class="bi bi-envelope-paper-fill"></i>
                </div>
                <h2 id="jewelEmailOtpModalLabel">Verify Your Email</h2>
                <p>
                    Enter the 6-digit verification code for
                    <strong id="jewelOtpEmail"></strong>.
                </p>
                <form id="jewelEmailOtpForm">
                    <label class="visually-hidden" for="jewelEmailOtpInput">6-digit verification code</label>
                    <input class="form-control jewel-email-otp-input"
                           id="jewelEmailOtpInput"
                           type="text"
                           inputmode="numeric"
                           autocomplete="one-time-code"
                           pattern="[0-9]{6}"
                           maxlength="6"
                           placeholder="Enter OTP"
                           aria-describedby="jewelEmailOtpMessage"
                           required>
                    <button class="btn btn-primary jewel-email-otp-submit" type="submit">
                        Verify &amp; Create Account
                    </button>
                    <p class="jewel-email-otp-message"
                       id="jewelEmailOtpMessage"
                       role="status"
                       aria-live="polite"></p>
                </form>
                <p class="jewel-email-otp-resend">
                    Didn’t receive the code?
                    <button type="button" id="jewelResendOtp">Resend OTP</button>
                </p>
            </div>
        </div>
    </div>
</div>


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
                                src="{{ asset('public/assets/img/sign-up.jpg') }}"
                                alt="Jewelry Dashboard"
                                class="jewel-signup-main-image"
                            >
                        </div>

                        <!-- Right Login Section -->
                        <div class="col-lg-6 jewel-signup-right">

                            <div class="jewel-signup-decoration jewel-signup-decoration-top">
                                <img src="{{ asset('public/assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-decoration jewel-signup-decoration-bottom">
                                <img src="{{ asset('public/assets/img/icons/3.svg') }}" alt="">
                            </div>

<div class="jewel-signup-content">

                                <!-- Logo -->
                                <a href="{{ url('/') }}" class="jewel-signup-logo">
                                    <img
                                        src="{{ asset('public/assets/img/logo.png') }}"
                                        alt="Jewelerp Logo"
                                    >
                                </a>

                                <h4 class="jewel-signup-title"
                                    id="jewelLoginModalLabel">
                                    Welcome Back
                                </h4>

                                <p class="jewel-para">
                                    Login to access your dashboard
                                </p>

                                <!-- Login Form -->
                                <form class="jewel-signup-form">
                                    @csrf

                                    <!-- Username -->
                                    <div class="jewel-signup-field">
                                        <i class="bi bi-person-fill"></i>
                                        <input
                                            type="text"
                                            name="username"
                                            placeholder="Username"
                                            autocomplete="username"
                                            required
                                        >
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
                                            required
                                        >

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
                                    <!-- <p class="jewel-signup-login jewel-forgot-password">
                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#jewelForgotModal">
                                            Forgot Password
                                        </a>
                                    </p> -->

                                    <!-- Submit -->
                                   <a href="{{ route('invoice-front') }}" class="jewel-signup-button">
    Log In
</a>
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
                                src="{{ asset('public/assets/img/sign-up.jpg') }}"
                                alt="Jewelry Dashboard"
                                class="jewel-signup-main-image">
                        </div>

                        <!-- Right Signup Section -->
                        <div class="col-lg-6 jewel-signup-right">

                            <div class="jewel-signup-decoration jewel-signup-decoration-top">
                                <img src="{{ asset('public/assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-decoration jewel-signup-decoration-bottom">
                                <img src="{{ asset('public/assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-content">

                                <!-- Logo -->
                                <a href="{{ url('/') }}" class="jewel-signup-logo">
                                    <img
                                        src="{{ asset('public/assets/img/logo.png') }}"
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
                                          action="{{ url('/reset-password') }}"
                                          method="POST">
                                        @csrf

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
    <span class="jewel-password-hint">Hint here</span>

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

                                        <button type="submit" class="jewel-forgot-button">
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
                                src="{{ asset('public/assets/img/sign-up.jpg') }}"
                                alt="Jewelry Dashboard"
                                class="jewel-signup-main-image"
                            >
                        </div>

                        <!-- Right Forgot Password Section -->
                        <div class="col-lg-6 jewel-signup-right">

                            <div class="jewel-signup-decoration jewel-signup-decoration-top">
                                <img src="{{ asset('public/assets/img/icons/3.svg') }}" alt="">
                            </div>

                            <div class="jewel-signup-decoration jewel-signup-decoration-bottom">
                                <img src="{{ asset('public/assets/img/icons/3.svg') }}" alt="">
                            </div>

<div class="jewel-signup-content">

                                <!-- Logo -->
                                <a href="{{ url('/') }}" class="jewel-signup-logo">
                                    <img
                                        src="{{ asset('public/assets/img/logo.png') }}"
                                        alt="Jewelerp Logo"
                                    >
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

                                    <form class="jewel-forgot-form">
                                        @csrf

                                        <div class="jewel-forgot-email">
                                            <label for="forgotEmail">Email</label>
                                            <input
                                                type="email"
                                                id="forgotEmail"
                                                name="email"
                                                placeholder="Input here"
                                                autocomplete="email"
                                                required
                                            >
                                        </div>

                                        <button type="submit"
                                                class="jewel-forgot-button">
                                            Submit
                                        </button>

                                        <h5 class="jewel-forgot-verify-title">
                                            Verify
                                        </h5>
<div class="jewel-forgot-otp"
     role="group"
     aria-label="Verification code">

    @for ($digit = 1; $digit <= 5; $digit++)
        <input
            type="text"
            name="forgot_otp[]"
            inputmode="numeric"
            maxlength="1"
            autocomplete="off"
            aria-label="Verification code digit {{ $digit }}"
            class="jewel-common-otp"
            onpaste="jewelPasteOtp(event, this)"
            oninput="jewelMoveOtp(this)"
            onkeydown="jewelOtpBackspace(event, this)"
        >
    @endfor

</div>
                                        <button type="button"
                                                class="jewel-forgot-button jewel-forgot-verify-button"  data-bs-toggle="modal"
        data-bs-target="#jewelNewPasswordModal">
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
document.addEventListener('DOMContentLoaded', function () {
    if (!window.bootstrap) return;

    const signupForm = document.getElementById('jewelSignupForm');
    const signupModal = document.getElementById('jewelSignupModal');
    const emailOtpModal = document.getElementById('jewelEmailOtpModal');
    const emailOtpInput = document.getElementById('jewelEmailOtpInput');
    const emailOtpMessage = document.getElementById('jewelEmailOtpMessage');

    if (signupForm && signupModal && emailOtpModal) {
        signupForm.addEventListener('submit', function (event) {
            event.preventDefault();

            if (!signupForm.reportValidity()) return;

            const email = signupForm.querySelector('input[name="email"]').value;
            document.getElementById('jewelOtpEmail').textContent = email;
            emailOtpInput.value = '';
            emailOtpMessage.textContent = '';

            signupModal.addEventListener('hidden.bs.modal', function () {
                bootstrap.Modal.getOrCreateInstance(emailOtpModal).show();
            }, { once: true });

            bootstrap.Modal.getOrCreateInstance(signupModal).hide();
        });

        emailOtpInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 6);
        });

        document.getElementById('jewelEmailOtpForm').addEventListener('submit', function (event) {
            event.preventDefault();
            emailOtpMessage.textContent = '';
        });

        document.getElementById('jewelResendOtp').addEventListener('click', function () {
            emailOtpMessage.textContent = '';
        });

        emailOtpModal.addEventListener('shown.bs.modal', function () {
            emailOtpInput.focus();
        });

        emailOtpModal.addEventListener('hidden.bs.modal', function () {
            if (document.querySelector('.modal.show')) return;

            document.body.classList.remove('modal-open');
            document.querySelectorAll('.modal-backdrop').forEach(function (backdrop) {
                backdrop.remove();
            });
        });
    }

    // Signup modal
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

    // Handle modal switching
    document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            const targetModalId = this.getAttribute('data-bs-target');
            const currentModal = this.closest('.modal');

            if (currentModal && currentModal.id !== targetModalId.replace('#', '')) {
                e.preventDefault();
                e.stopPropagation();

                const targetModal = document.querySelector(targetModalId);
                if (!targetModal) {
                    return;
                }

                currentModal.addEventListener('hidden.bs.modal', function() {
                    bootstrap.Modal.getOrCreateInstance(targetModal).show();
                }, { once: true });

                bootstrap.Modal.getOrCreateInstance(currentModal).hide();
            }
        });
    });
});
</script>


<!-- Custom JavaScript -->
<script src="{{ asset('public/assets/script/script.js') }}?v={{ filemtime(public_path('assets/script/script.js')) }}" ></script>
<script src="{{ asset('public/assets/script/animation.js') }}" ></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
