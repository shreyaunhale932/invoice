
@extends('invoice_front.includes.app')

@section('content')
<!-- 
<section class="jewellery-hero" data-reveal>
    <div class="container-fluid px-0">
        <div class="row g-0 align-items-stretch">

            {{-- Left content --}}
            <div class="col-12 col-lg-7 jewellery-hero-content">
                <div class="jewellery-hero-inner">

                    <h1>
                        All-in-One for Your<br class="desktop-break">
                        Entire <span>Jewellery</span><br class="desktop-break">
                        <span>Business</span>
                    </h1>

                    <p>
                        AI-driven and omnichannel—take your
                        purchase, inventory &amp; sales to one
                        dashboard.
                    </p>

                    <div class="jewellery-hero-buttons">
                        <a href="#jewelSignupModal"
                           class="btn jewellery-btn-primary"
                           data-bs-toggle="modal"
                           data-bs-target="#jewelSignupModal">
                            Sign Up For Free*
                        </a>

                        <a href="#demo" class="btn jewellery-btn-outline">
                            <span class="play-icon">&#9655;</span>
                            Watch Demo
                        </a>
                    </div>

                </div>
            </div>

            {{-- Right image --}}
            <div class="col-12 col-lg-5 jewellery-hero-image">
                <img
                    src="{{ asset('front_assets/img/index-banner.jpg') }}"
                    alt="Jewellery display with necklace, rings and business dashboard"
                >
            </div>

        </div>
    </div>
</section> --><div id="carouselExampleIndicators"
     class="carousel slide mt-3"
     data-bs-ride="carousel"
     data-bs-interval="3000">

    <div class="carousel-indicators">
        <button type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide-to="0"
                class="active"
                aria-current="true"
                aria-label="Slide 1"></button>

        <button type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide-to="1"
                aria-label="Slide 2"></button>

        <button type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide-to="2"
                aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <picture>
                <source media="(max-width: 767px)"
                        srcset="{{ asset('front_assets/img/index-m-banner1.jpg') }}">

                <img src="{{ asset('front_assets/img/banner1.jpg') }}"
                     class="d-block w-100 jewel-banner-img"
                     alt="Jewelry Banner 1">
            </picture>

            <a href="#jewelSignupModal"
               class="jewel-banner-cta"
               data-bs-toggle="modal"
               data-bs-target="#jewelSignupModal">
                <span>Sign Up for Free*</span>
                <span class="jewel-banner-cta-icon">
                    <i class="bi bi-arrow-up-right"></i>
                </span>
            </a>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <picture>
                <source media="(max-width: 767px)"
                        srcset="{{ asset('front_assets/img/index-m-vanner2.jpg') }}">

                <img src="{{ asset('front_assets/img/banner2.jpg') }}"
                     class="d-block w-100 jewel-banner-img"
                     alt="Jewelry Banner 2">
            </picture>

            <a href="#jewelSignupModal"
               class="jewel-banner-cta"
               data-bs-toggle="modal"
               data-bs-target="#jewelSignupModal">
                <span>Sign Up for Free*</span>
                <span class="jewel-banner-cta-icon">
                    <i class="bi bi-arrow-up-right"></i>
                </span>
            </a>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <picture>
                <source media="(max-width: 767px)"
                        srcset="{{ asset('front_assets/img/index-m-banner3.jpg') }}">

                <img src="{{ asset('front_assets/img/index-banner3.jpg') }}"
                     class="d-block w-100 jewel-banner-img"
                     alt="Jewelry Banner 3">
            </picture>

            <a href="#jewelSignupModal"
               class="jewel-banner-cta"
               data-bs-toggle="modal"
               data-bs-target="#jewelSignupModal">
                <span>Sign Up for Free*</span>
                <span class="jewel-banner-cta-icon">
                    <i class="bi bi-arrow-up-right"></i>
                </span>
            </a>
        </div>

    </div>

    <button class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon"
              aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
        <span class="carousel-control-next-icon"
              aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

</div>









    <!-- Business Section -->
    <section class="business-section" data-reveal>

        <div class="container-fluid p-0">
            <div class="row g-0 business-row">

                <!-- Left Image Column -->
                <div class="col-12 col-md-5 business-image-col">
                    <div class="business-image">
                        <img
                                               src="{{ asset('front_assets/img/a day.jpg') }}"

                            alt="Jewellery business management dashboard"
                        >
                    </div>
                </div>

                <!-- Right Content Column -->
                <div class="col-12 col-md-7 business-content-col">

                    <div class="business-content">

                        <h1 class="business-title">
                            We Understand Your<br class="desktop-break">
                            Business
                        </h1>

                        <p class="business-description">
                            Running a jewellery business comes with unique
                            challenges – from tracking precious metals and
                            gemstones to managing complex invoicing with
                            making charges and purity calculations. We've
                            built a solution that understands these
                            intricacies and makes your daily operations
                            seamless.
                        </p>

                    </div>

                    <!-- Decorative Shape -->
                    

<div class="business-decoration" aria-hidden="true">
    <img
                src="{{ asset('front_assets/img/icons/shape1.svg') }}"
        alt=""
        class="business-decoration-img"
    >
</div>


                </div>

            </div>
        </div>

    </section>

    <!-- Bootstrap JS -->
    <!-- <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script> -->


<section id="solutions" class="features-section" data-reveal>

    <!-- Decorative Shape -->
 
<!-- Decorative SVG Image -->
<div class="features-decoration" aria-hidden="true">
    <img
        src="{{ asset('front_assets/img/icons/blueshap.svg') }}"
        alt=""
        class="features-decoration-img"
    >
</div>


    <div class="container-fluid">

        <!-- Section Heading -->
        <div class="features-header text-center">
            <h1 class="features-title">
                Everything You Need to
                Manage <span>Your Business</span>
            </h1>

            <p class="features-subtitle">
                Powerful features designed specifically for the unique
                needs of jewellery businesses
            </p>
        </div>

        <!-- Features -->
        <div class="features-grid">

           @foreach ($cmsSolutions as $solution)
              <a href="{{ $solution->url }}" class="feature-card">
                  <h3>{{ $solution->title }}</h3>
                  <p>{{ $solution->home_description ?? $solution->description }}</p>
                  @if ($solution->tagline)
                      <span class="feature-badge">{{ $solution->tagline }}</span>
                  @endif
              </a>
           @endforeach

            <!-- CTA Card -->
            <div class="feature-card feature-cta">
                <h3>One Platform for the Complete Jewellery Business</h3>

                <p>
                    All modules work together, sharing live data across
                    every function.
                </p>

                <a href="{{ url('/pricing') }}" class="feature-cta-link">
                    Explore JewelERP
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>


        </div>

    </div>

</section>



<section class="jewelerp-life-section" data-reveal>
    <div class="container-fluid">

        <!-- Section Heading -->
        <div class="jewelerp-life-heading">
            <h1>
                A Day in the Life with
                <span>JewelERP</span>
            </h1>

            <p>
                See how Kumar Jewellers transformed their operations with
                <br class="desktop-break">
                our platform
            </p>
        </div>

        <!-- Main Content -->
        <div class="row g-0 jewelerp-life-row align-items-center">

            <!-- Left Image -->
            <div class="col-12 col-md-6 jewelerp-life-image-col">
                <div class="jewelerp-life-image">
                    <img
                        src="{{ asset('front_assets/img/Untitled design (33) 2.jpg') }}"
                        alt="Elegant gold and blue gemstone jewellery"
                    >
                </div>
            </div>

            <!-- Right Feature Cards -->
            <div class="col-12 col-md-6 jewelerp-life-cards-col">

                <div class="jewelerp-life-cards">

                    <!-- Card 1 -->
                    <article class="life-card life-card-one" data-number="1">
                        <div class="life-card-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="life-card-glow"></div>
                        <h4>Review Inventory</h4>
                        <p>
                            Start your day by checking gold and silver stock
                            levels, reviewing pending orders, and receiving
                            instant low-stock alerts. Stay ahead with real-time
                            inventory updates.
                        </p>
                    </article>

                    <!-- Card 2 -->
                    <article class="life-card life-card-two" data-number="2">
                        <div class="life-card-icon">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <div class="life-card-glow"></div>
                        <h4>Customer Push</h4>
                        <p>
                            Create professional invoices in seconds with
                            automatic calculations for making charges, stone
                            costs, and GST. Error-free billing that impresses
                            customers every time.
                        </p>
                    </article>

                    <!-- Card 3 -->
                    <article class="life-card life-card-three" data-number="3">
                        <div class="life-card-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div class="life-card-glow"></div>
                        <h4>End-of-Day Reports</h4>
                        <p>
                            Review comprehensive daily sales reports, track
                            stock changes, and analyze profit margins.
                            Complete visibility into your business performance
                            at a glance.
                        </p>
                    </article>

                </div>

            </div>
        </div>
    </div>

    <!-- Decorative SVG image -->
<!-- <div class="life-decoration life-decoration-middle" aria-hidden="true">
    <img
        src="{{ asset('front_assets/img/icons/3.svg') }}"
        alt=""
        class="life-decoration-img"
    >
</div>

    </div>

    <div class="life-decoration life-decoration-bottom" aria-hidden="true">
        <svg viewBox="0 0 80 100" xmlns="http://www.w3.org/2000/svg">
            <path
                fill="#012E8F"
                d="M80 20 C62 16 52 7 38 15
                   C24 23 30 36 42 43
                   C53 50 41 63 32 76
                   C24 88 34 98 47 91
                   C62 83 61 63 71 55
                   L80 54Z"
            />
        </svg>
    </div> -->
</section>




<section class="dashboard-section" data-reveal>
    <div class="container-fluid px-3 px-md-4">

        <!-- Section Heading -->
        <div class="dashboard-heading text-center">
            <h1>Powerful Dashboard, Simple Interface</h1>
            <p>
                Every feature you need, designed for clarity and speed
            </p>
        </div>

        <!-- Dashboard Image -->
        <div class="dashboard-image-wrapper">
            <img
                src="{{ asset('front_assets/img/dashbord.png') }}"
                alt="JewelERP business management dashboard"
                class="dashboard-image"
            >
        </div>

    </div>
</section>

<section class="benefits-section" data-reveal>
    <div class="container-fluid">

        <!-- Section Heading -->
        <div class="benefits-header text-center">
            <h1>Real Benefits, Real Results</h1>
            <p>See the impact on your business from day one</p>
        </div>

        <!-- Benefits Cards -->
        <div class="row g-4  benefits-row">

            <!-- Card 1 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="benefit-card h-100">
                    <div class="benefit-icon">
                        <i class="bi bi-clock"></i>
                    </div>

                    <h3>Save Time</h3>
                    <span class="benefit-line"></span>

                    <p>
                        Automate repetitive tasks and reduce invoice creation
                        time from 10 minutes to just 2 minutes. Focus on
                        growing your business, not paperwork.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="benefit-card h-100">
                    <div class="benefit-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <h3>Reduce Manual Errors</h3>
                    <span class="benefit-line"></span>

                    <p>
                        Eliminate calculation mistakes with automated GST,
                        making charges, and stone cost calculations.
                        100% accuracy guaranteed.
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="benefit-card h-100">
                    <div class="benefit-icon">
                        <i class="bi bi-folder2-open"></i>
                    </div>

                    <h3>Stay Organized</h3>
                    <span class="benefit-line"></span>

                    <p>
                        Keep all your invoices, inventory records, and
                        customer data in one secure, searchable place.
                        Never lose track of important information.
                    </p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="benefit-card h-100">
                    <div class="benefit-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                    <h3>Improve Daily Operations</h3>
                    <span class="benefit-line"></span>

                    <p>
                        Get real-time insights into sales, stock levels,
                        and profitability. Make data-driven decisions to
                        grow your jewellery business.
                    </p>
                </div>
            </div>

        </div>

        <!-- Statistics Pill -->
        <div class="benefits-stats">

            <div class="benefit-stat">
                <h5>5 hours</h5>
                <p>Saved per week</p>
            </div>

            <div class="benefit-stat">
                <h5>100%</h5>
                <p>Calculation accuracy</p>
            </div>

            <div class="benefit-stat">
                <h5>24/7</h5>
                <p>Access anywhere</p>
            </div>

        </div>

    </div>
</section>


<section class="testimonials-section" data-reveal>
    <div class="container">

        <div class="testimonial-heading">
            <span class="heading-line"></span>
            <h1>Testimonials</h1>
            <span class="heading-line"></span>
        </div>

        <div id="testimonialCarousel"
             class="carousel slide testimonial-carousel"
             data-bs-ride="carousel"
             data-bs-interval="3000"
             data-bs-pause="hover"
             data-bs-touch="true">

            <div class="carousel-inner">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row g-4 testimonial-row">

                        <div class="col-12 col-lg-6">
                            <article class="testimonial-card h-100">
                                <div class="quote-icon">
                                    <i class="bi bi-quote"></i>
                                </div>

                                <p class="testimonial-text">
                                    "Jewelerp has completely transformed how we manage our business. The automated invoice system saves us hours every day, and the inventory tracking is incredibly accurate. Our customers love the professional invoices!"
                                </p>

                                <div class="testimonial-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>

                                <div class="testimonial-author">
                                    <div class="author-avatar">RK</div>
                                    <div class="author-details">
                                        <h3>Srinivas Chary</h3>
                                        <p>Nikaara Jewellers, Hyderabad</p>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-12 col-lg-6">
                            <article class="testimonial-card h-100">
                                <div class="quote-icon">
                                    <i class="bi bi-quote"></i>
                                </div>

                                <p class="testimonial-text">
                                    "We were skeptical at first, but after using Jewelerp for just a month, we can't imagine going back. The real-time stock alerts have prevented stockouts, and the analytics help us make better purchasing decisions."
                                </p>

                                <div class="testimonial-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>

                                <div class="testimonial-author">
                                    <div class="author-avatar">PS</div>
                                    <div class="author-details">
                                        <h3>Rahul Deshmukh</h3>
                                        <p>New Era Diamonds, Mumbai</p>
                                    </div>
                                </div>
                            </article>
                        </div>

                    </div>
                </div>

                <!-- Slide 2: Add more testimonials here -->
                <div class="carousel-item">
                    <div class="row g-4 testimonial-row">

                        <div class="col-12 col-lg-6">
                            <article class="testimonial-card h-100">
                                <div class="quote-icon">
                                    <i class="bi bi-quote"></i>
                                </div>

                                <p class="testimonial-text">
                                    "Jewelerp has completely transformed how we manage our business. The automated invoice system saves us hours every day, and the inventory tracking is incredibly accurate. Our customers love the professional invoices!"
                                </p>

                                <div class="testimonial-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>

                                <div class="testimonial-author">
                                    <div class="author-avatar">RK</div>
                                    <div class="author-details">
                                        <h3>Srinivas Chary</h3>
                                        <p>Nikaara Jewellers, Hyderabad</p>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-12 col-lg-6">
                            <article class="testimonial-card h-100">
                                <div class="quote-icon">
                                    <i class="bi bi-quote"></i>
                                </div>

                                <p class="testimonial-text">
                                    "We were skeptical at first, but after using Jewelerp for just a month, we can't imagine going back. The real-time stock alerts have prevented stockouts, and the analytics help us make better purchasing decisions."
                                </p>

                                <div class="testimonial-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>

                                <div class="testimonial-author">
                                    <div class="author-avatar">PS</div>
                                    <div class="author-details">
                                        <h3>Rahul Deshmukh</h3>
                                        <p>New Era Diamonds, Mumbai</p>
                                    </div>
                                </div>
                            </article>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Carousel indicators -->
           

        </div>
    </div>
</section>
<!-- FAQ Section -->
<section class="jewel-faq-section" data-reveal>
    <div class="container-fluid jewel-faq-container">
        <h1 class="jewel-faq-title" data-reveal>
            Frequently
            asked questions (FAQ)
        </h1>

        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-12">
                <div class="accordion jewel-faq-accordion" id="jewelFaqAccordion">
                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                What is JEWELERP?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#jewelFaqAccordion">
                            <div class="accordion-body">
                                JEWELERP is a specialised enterprise resource planning software designed specifically for the jewellery industry. It helps jewellers, wholesalers, manufacturers, multi-branch businesses, and money lenders streamline their operations, manage inventory, billing, customer relationships, and compliance efficiently.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Who can use JEWELERP?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#jewelFaqAccordion">
                            <div class="accordion-body">
                                JEWELERP offers different versions to serve a variety of jewellery businesses, including retail jewellers, wholesalers, manufacturers, multi-branch owners, and money lenders dealing with gold loans. Each version is tailored to meet the specific needs of that segment.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Is JEWELERP suitable for small businesses?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#jewelFaqAccordion">
                            <div class="accordion-body">
                                Yes! JEWELERP is scalable and can be customised to fit the requirements of small, medium, and large jewellery businesses. Whether you operate a single showroom or multiple branches, we have a version that fits your needs.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Does JEWELERP support GST compliance?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#jewelFaqAccordion">
                            <div class="accordion-body">
                                Absolutely. Our software is designed to handle GST billing, filing, and reporting seamlessly, ensuring your business stays compliant with the latest tax regulations.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jewel-faq-read-more">
                    <a href="{{ url('/FAQS') }}" class="jewel-faq-read-more-link">
                        Read More FAQs
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="jewel-support-banner mt-4">
    <div class="container jewel-support-container">
        <div class="row jewel-support-row">

            <!-- Support Icon -->
            <div class="col-auto jewel-support-icon-wrap">
                <div class="jewel-support-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>

            <!-- Support Content -->
            <div class="col jewel-support-content">
                <span class="jewel-support-label">PERSONAL SUPPORT</span>

                <h2>Need Help? Our Support Team Is Here for You</h2>

                <p>
                    Have a question about JewelERP or need help finding the
                    right information? Let's talk.
                </p>

                <a href="{{ url('/contact') }}" class="jewel-support-btn">
                    <span>Contact Support</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>
@include('invoice_front.includes.ai-tools')

@endsection
