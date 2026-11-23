{{-- Top Bar --}}
<div class="jewel-top-bar">
    <div class="container jewel-top-bar-container">
        <div class="jewel-top-bar-left">
            <a href="mailto:support@jewelerp.in" class="jewel-top-bar-link">
                <i class="bi bi-envelope"></i> support@jewelerp.in
            </a>
            <a href="tel:  +91 90217 47534" class="jewel-top-bar-link">
                <i class="bi bi-telephone"></i> +91 90217 47534
            </a>
        </div>

        <div class="jewel-top-bar-right">


            <a href="https://www.facebook.com/jewelerpin"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Facebook"
                class="jewel-top-bar-link">

                <svg viewBox="0 0 24 24" width="22" height="22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 21V13.2H16.7L17.1 10H14V8
             C14 7.1 14.4 6.5 15.7 6.5H17.2V3.6
             C16.5 3.5 15.5 3.4 14.4 3.4
             C11.7 3.4 10 5 10 8V10H7.5V13.2H10V21"
                        stroke="#FFFFFF" stroke-width="1.6"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>



            </a>

            <a href="https://www.youtube.com/@Jewelerp"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="YouTube"
                class="jewel-top-bar-link">

                <svg viewBox="0 0 24 24" width="22" height="22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="5.5" width="18" height="13" rx="3.5"
                        stroke="#FFFFFF" stroke-width="1.6" />
                    <path d="M10 9L15 12L10 15V9Z"
                        stroke="#FFFFFF" stroke-width="1.4"
                        stroke-linejoin="round" />
                </svg>

            </a>

            <a href="https://www.instagram.com/jewelerpin/"
                target="_blank"
                class="jewel-top-bar-link"
                rel="noopener noreferrer"
                aria-label="Instagram">
                <i class="bi bi-instagram"></i>
            </a>
            <!-- <a href="#" class="jewel-top-bar-link">
                
            </a> -->
            <a href="https://www.linkedin.com/company/jewelerp/"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="LinkedIn"
                class="jewel-top-bar-link">

                <svg viewBox="0 0 24 24"
                    width="22"
                    height="22"
                    fill="none"
                    stroke="#FFFFFF"
                    stroke-width="1.4"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"
                        stroke="#FFFFFF" />
                    <rect x="2" y="9" width="4" height="12"
                        stroke="#FFFFFF" />
                    <circle cx="4" cy="4" r="2"
                        stroke="#FFFFFF" />
                </svg>

            </a>

        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg sticky-top jewel-navbar">
    <div class="container nav">

        {{-- Logo --}}



        {{-- Logo --}}
        <a class="navbar-brand jewel-logo" href="{{ url('/') }}">
            <img
                src="{{ asset('front_assets/img/logo.png') }}"
                alt="Jewelero Logo"
                class="jewel-logo-img">
        </a>


        {{-- Mobile Toggle --}}
        <div class="toggle" onclick="toggleMenu()">☰</div>

        {{-- Navbar Content --}}
        <div id="menu">

            {{-- Navigation Links --}}
            <ul class="navbar-nav mx-auto jewel-nav-links">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ url('/') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pricing') ? 'active' : '' }}"
                        href="{{ url('/pricing') }}">
                        Pricing
                    </a>
                </li>

                <li class="nav-item solutions-nav-item">
                    <a class="nav-link solutions-nav-link "
                        aria-haspopup="true"
                        aria-expanded="false">
                        Our Solutions
                        <span class="solutions-arrow">⌃</span>
                    </a>

                    <div class="solutions-mega-menu">
                        <div class="container-fluid">
                            <div class="row g-0">

                                <!-- Left introduction panel -->
                                <div class="col-12 col-lg-3">
                                    <div class="solutions-intro">
                                        <span class="solutions-label">
                                            <span class="solutions-dot"></span>
                                            OUR SOLUTIONS
                                        </span>

                                        <h5>Everything Your Jewelry Business Needs to Succeed.</h5>

                                        <p>
                                            One cloud platform for jewelry retail, manufacturing, and inventory management — empowering jewelers across India. </p>

                                        <a href="{{ route('invoice-front') }}#solutions"
                                            class="solutions-explore">
                                            <span>Explore all solutions</span>
                                            <span class="solutions-explore-arrow">→</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Right solution cards -->
                                <div class="col-12 col-lg-9">
                                    <div class="row g-2 solutions-grid">
                                        @foreach ($cmsSolutions as $solution)
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <a href="{{ $solution->url }}" class="solution-card">
                                                    <span class="solution-content">
                                                        <strong>{{ $solution->title }}</strong>
                                                        <small>{{ $solution->description }}</small>
                                                    </span>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ request()->is('integration') ? 'active' : '' }}"
                        href="{{ url('/integration') }}">
                        Integration
                    </a>
                </li>


                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('videos') ? 'active' : '' }}"
                        href="{{ url('/videos') }}">
                        Videos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('Contact-us') ? 'active' : '' }}"
                        href="{{ url('/contact') }}">
                        Contact Us
                    </a>
                </li>




            </ul>

            {{-- Right Actions --}}
            <div class="jewel-nav-actions" id="navRight">
                <a href="#jewelLoginModal"
                    class="jewel-login"
                    data-bs-toggle="modal"
                    data-bs-target="#jewelLoginModal">
                    Log In
                </a>

                <a href="#jewelSignupModal"
                    class="jewel-signup"
                    data-bs-toggle="modal"
                    data-bs-target="#jewelSignupModal">
                    <span>Sign Up for Free*</span>
                    <span class="jewel-banner-cta-icon">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>
                </a>
            </div>


            <!-- 
              <a  href="#jewelSignupModal" class="jewel-banner-cta"  data-bs-toggle="modal"
                   data-bs-target="#jewelSignupModal">
                <span>Sign Up for Free*</span>
                <span class="jewel-banner-cta-icon">
                    <i class="bi bi-arrow-up-right"></i>
                </span>
            </a> -->
        </div>
    </div>
</nav>