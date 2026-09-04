<footer class="footer">

    <div class="footer-container">

        <div class="footer-grid">

            <!-- LEFT -->

            <div>

                <div class="footer-logo">

                    <img src="{{ asset('front_assets\img\footer-logo.png') }}" alt="logo">

                </div>

                <p class="footer-address">

                    India’s trusted Jewellery ERP software, built to simplify Billing, Inventory, and Business Management for Jewellery Retailers, Wholesalers, and Manufacturers.

                </p>

                <div class="footer-social">

                    <a href="https://www.facebook.com/jewelerpin" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="https://www.youtube.com/@Jewelerp" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>

                    <a href="https://www.instagram.com/jewelerpin/" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="https://www.linkedin.com/company/jewelerp" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>

                </div>

            </div>

            <!-- QUICK LINKS -->

            <div>

                <h3 class="footer-title">
                    Quick Links
                </h3>

                <ul class="footer-links">

                    <li>
                        <a href="#">About Us</a>
                    </li>

                    <li>
                        <a href="#">Features</a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}">Contact</a>
                    </li>

                </ul>

            </div>

            <!-- SUPPORT -->

            <div>

                <h3 class="footer-title">
                    Support
                </h3>

                <ul class="footer-links">

                    <li>
                        <a href="#">Help Center</a>
                    </li>
                      <li>
                        <a href="{{ route('faqs') }}">FAQs</a>
                    </li>

                    <li>
                        <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                    </li>

                    <li>
                        <a href="{{ route('refund-policy') }}">Refund & Cancellation</a>
                    </li>

                     <li>
                        <a href="{{ route('terms-conditions') }}">Terms & Conditions</a>
                    </li>

                  
                </ul>

            </div>

            <!-- CONTACT -->

            <div>

                <h3 class="footer-title">
                    Contact Us
                </h3>

                <ul class="footer-contact">

                    <li>
                        <i class="fa-regular fa-envelope"></i>
                        support@jewelerp.in
                    </li>

                    <li>
                        <i class="fa-solid fa-phone"></i>
                        +91 90217 47534
                    </li>

                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        Pune, Maharashtra, India.
                    </li>

                </ul>

            </div>

        </div>

        <!-- BOTTOM -->

        <div class="footer-bottom">

            © 2026 All Rights Reserved & Powered by Sirsonite Solutions Pvt. Ltd.

        </div>

    </div>

    <!-- WhatsApp Button -->
<a href="https://wa.me/919021747534"
   class="whatsapp-btn"
   target="_blank"
   aria-label="Chat on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Back to Top Button -->
<button id="backToTop" class="back-to-top" aria-label="Back to top">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    const backToTop = document.getElementById("backToTop");

    // Show button after scrolling
    window.addEventListener("scroll", function () {
        if (window.scrollY > 300) {
            backToTop.style.display = "flex";
        } else {
            backToTop.style.display = "none";
        }
    });

    // Scroll to top
    backToTop.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
</script>

    <script src="{{ asset('front_assets/js/script.js') }}"></script>
