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
</section> -->
<div id="carouselExampleIndicators"
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
                    srcset="{{ $banners->mob_img1 ? asset($banners->mob_img1) : asset('front_assets/img/mob2.png') }}">

                <img src="{{ $banners->image1 ? asset($banners->image1) : asset('front_assets/img/11.jpg') }}"
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
                    srcset="{{ $banners->mob_img2 ? asset($banners->mob_img2) : asset('front_assets/img/index-m-vanner2.jpg') }}">

                <img src="{{ $banners->image2 ? asset($banners->image2) : asset('front_assets/img/banner2.jpg') }}"
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
                    srcset="{{ $banners->mob_img3 ? asset($banners->mob_img3) : asset('front_assets/img/mob3.png') }}">

                <img src="{{ $banners->image3 ? asset($banners->image3) : asset('front_assets/img/banner3.png') }}"
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

</div><br>






<!-- Business Section -->
<!-- Business Section -->
<section class="business-section" data-reveal>

    <div class="container-fluid p-0">
        <div class="row g-0 business-row">

            <!-- Left Image Column -->
            <div class="col-12 col-md-5 business-image-col">
                <div class="business-image">
                    <img
                        src="{{ asset('front_assets/img/image copy.png') }}"

                        alt="Jewellery business management dashboard">
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
                        class="business-decoration-img">
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
            class="features-decoration-img">
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

            @forelse ($cmsSolutions as $solution)
                <a href="{{ $solution->url }}" class="feature-card">
                    <h3>{{ $solution->title }}</h3>
                    <p>{{ $solution->home_description ?? $solution->description }}</p>
                    @if ($solution->tagline)
                        <span class="feature-badge">{{ $solution->tagline }}</span>
                    @endif
                </a>
            @empty
                <a href="{{ url('/invoice-and-solution') }}" class="feature-card">
                    <div class="feature-icon"><i class="bi bi-receipt-cutoff"></i></div>
                    <h3>Invoice &amp; Sell Management</h3>
                    <p class="paragraph">Create jewellery-specific invoices with making charges, stone values, GST and fast POS billing.</p>
                    <span class="feature-badge">1,280+ invoices/day</span>
                </a>
                <a href="{{ url('/invoice-and-solution') }}" class="feature-card">
                    <div class="feature-icon"><i class="bi bi-bag-check"></i></div>
                    <h3>Purchase Management</h3>
                    <p>Record vendor purchases, metal receipts and inward stock with full traceability.</p>
                    <span class="feature-badge">Full vendor tracking</span>
                </a>
                <a href="{{ url('/invoice-and-solution') }}" class="feature-card">
                    <div class="feature-icon"><i class="bi bi-person-gear"></i></div>
                    <h3>Karigar &amp; Job Work</h3>
                    <p>Issue raw gold to karigars, track job work progress, and record receipts with weight reconciliation.</p>
                    <span class="feature-badge">Gold issue &amp; receipt</span>
                </a>
                <a href="{{ url('/invoice-and-solution') }}" class="feature-card">
                    <div class="feature-icon"><i class="bi bi-upc-scan"></i></div>
                    <h3>Barcode &amp; RFID Tagging</h3>
                    <p>Tag every jewellery piece with barcode or RFID for instant identification and stock accuracy.</p>
                    <span class="feature-badge">Instant item ID</span>
                </a>
                <a href="{{ url('/invoice-and-solution') }}" class="feature-card">
                    <div class="feature-icon"><i class="bi bi-gear"></i></div>
                    <h3>Discount &amp; Scheme Management</h3>
                    <p>Configure seasonal offers, loyalty discounts and jewellery scheme plans for customers.</p>
                    <span class="feature-badge">Smart pricing rules</span>
                </a>
                <a href="{{ url('/invoice-and-solution') }}" class="feature-card">
                    <div class="feature-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <h3>Real-Time MIS Reports</h3>
                    <p>Access live sales, inventory, profitability and business performance reports at any time.</p>
                    <span class="feature-badge">Live data, always</span>
                </a>
                <a href="{{ url('/invoice-and-solution') }}" class="feature-card">
                    <div class="feature-icon"><i class="bi bi-diagram-3"></i></div>
                    <h3>Multi-Branch Management</h3>
                    <p>Run multiple store locations from one dashboard with centralized inventory and reporting.</p>
                    <span class="feature-badge">All branches, one view</span>
                </a>
                <a href="{{ url('/invoice-and-solution') }}" class="feature-card">
                    <div class="feature-icon"><i class="bi bi-arrow-left-right"></i></div>
                    <h3>Old Gold Exchange</h3>
                    <p>Evaluate, weigh and process old gold or jewellery exchange with accurate valuations.</p>
                    <span class="feature-badge">Exchange &amp; valuation</span>
                </a>
                <a href="{{ url('/invoice-and-solution') }}" class="feature-card">
                    <div class="feature-icon"><i class="bi bi-grid"></i></div>
                    <h3>Inventory Management</h3>
                    <p>Track jewellery stock by weight, purity, category and location across your entire business.</p>
                    <span class="feature-badge">100% stock accuracy</span>
                </a>
            @endforelse

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

                our platform
            </p>
        </div>

        <!-- Main Content -->
        <div class="row g-0 jewelerp-life-row align-items-center">

            <!-- Left Image -->
            <div class="col-12 col-md-6 jewelerp-life-image-col">
                <div class="jewelerp-life-image">
                    <img
                        src="{{ asset('front_assets/img/image copy 2.png') }}"
                        alt="Elegant gold and blue gemstone jewellery">
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
                src="{{ $banners->dashboard_image ? asset($banners->dashboard_image) : asset('front_assets/img/dashbord.png') }}"
                alt="JewelERP business management dashboard"
                class="dashboard-image">
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

                    <h3>{{ $banners->benefit_h1 ?: 'Save Time' }}</h3>
                    <span class="benefit-line"></span>

                    <p>{{ $banners->benefit_t1 ?: 'Automate repetitive tasks and reduce invoice creation time from 10 minutes to just 2 minutes. Focus on growing your business, not paperwork.' }}</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="benefit-card h-100">
                    <div class="benefit-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <h3>{{ $banners->benefit_h2 ?: 'Reduce Manual Errors' }}</h3>
                    <span class="benefit-line"></span>

                    <p>{{ $banners->benefit_t2 ?: 'Eliminate calculation mistakes with automated GST, making charges, and stone cost calculations. 100% accuracy guaranteed.' }}</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="benefit-card h-100">
                    <div class="benefit-icon">
                        <i class="bi bi-folder2-open"></i>
                    </div>

                    <h3>{{ $banners->benefit_h3 ?: 'Stay Organized' }}</h3>
                    <span class="benefit-line"></span>

                    <p>{{ $banners->benefit_t3 ?: 'Keep all your invoices, inventory records, and customer data in one secure, searchable place. Never lose track of important information.' }}</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="benefit-card h-100">
                    <div class="benefit-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                    <h3>{{ $banners->benefit_h4 ?: 'Improve Daily Operations' }}</h3>
                    <span class="benefit-line"></span>

                    <p>{{ $banners->benefit_t4 ?: 'Get real-time insights into sales, stock levels, and profitability. Make data-driven decisions to grow your jewellery business.' }}</p>
                </div>
            </div>

        </div>

        <!-- Statistics Pill -->
        <div class="benefits-stats">

            <div class="benefit-stat">
                <h5>{{ $banners->benefit_stat1_value ?: '5 hours' }}</h5>
                <p>{{ $banners->benefit_stat1_label ?: 'Saved per week' }}</p>
            </div>

            <div class="benefit-stat">
                <h5>{{ $banners->benefit_stat2_value ?: '100%' }}</h5>
                <p>{{ $banners->benefit_stat2_label ?: 'Calculation accuracy' }}</p>
            </div>

            <div class="benefit-stat">
                <h5>{{ $banners->benefit_stat3_value ?: '24/7' }}</h5>
                <p>{{ $banners->benefit_stat3_label ?: 'Access anywhere' }}</p>
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

        @php
            $displayTestimonials = $testimonials->isNotEmpty()
                ? $testimonials
                : collect([
                    (object) [
                        'content' => 'Jewelerp has completely transformed how we manage our business. The automated invoice system saves us hours every day, and the inventory tracking is incredibly accurate. Our customers love the professional invoices!',
                        'rating' => 5,
                        'name' => 'Srinivas Chary',
                        'short_detail' => 'Nikaara Jewellers, Hyderabad',
                    ],
                    (object) [
                        'content' => "We were skeptical at first, but after using Jewelerp for just a month, we can't imagine going back. The real-time stock alerts have prevented stockouts, and the analytics help us make better purchasing decisions.",
                        'rating' => 5,
                        'name' => 'Rahul Deshmukh',
                        'short_detail' => 'New Era Diamonds, Mumbai',
                    ],
                ]);
        @endphp

        @if ($displayTestimonials->isNotEmpty())
            <div id="testimonialCarousel"
                class="carousel slide testimonial-carousel"
                data-bs-ride="carousel"
                data-bs-interval="3000"
                data-bs-pause="hover"
                data-bs-touch="true">
                <div class="carousel-inner">
                    @foreach ($displayTestimonials->chunk(2) as $testimonialGroup)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <div class="row g-4 testimonial-row">
                                @foreach ($testimonialGroup as $testimonial)
                                    <div class="col-12 col-lg-6">
                                        <article class="testimonial-card h-100">
                                            <div class="quote-icon">
                                                <i class="bi bi-quote"></i>
                                            </div>
                                            <p class="testimonial-text">{{ $testimonial->content }}</p>
                                            <div class="testimonial-stars"
                                                role="img"
                                                aria-label="Rated {{ $testimonial->rating }} out of 5">
                                                @for ($star = 1; $star <= 5; $star++)
                                                    <i class="bi bi-star{{ $star <= $testimonial->rating ? '-fill' : '' }}"></i>
                                                @endfor
                                            </div>
                                            <div class="testimonial-author">
                                                <div class="author-avatar">{{ strtoupper(substr($testimonial->name, 0, 1)) }}</div>
                                                <div class="author-details">
                                                    <h3>{{ $testimonial->name }}</h3>
                                                    <p>{{ $testimonial->short_detail }}</p>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-center text-muted">No testimonials to display yet.</p>
        @endif
    </div>
</section>
<!-- FAQ Section -->
<section class="jewel-faq-section" data-reveal>
    <div class="container-fluid jewel-faq-container">
        <h1 class="jewel-faq-title" data-reveal>
            Frequently
            asked questions (FAQ)
        </h1>

        @php
            $displayFaqs = $faqs->isNotEmpty()
                ? $faqs
                : collect([
                    (object) [
                        'id' => 'default-1',
                        'question' => 'What is JEWELERP?',
                        'answer' => 'JEWELERP is a specialised enterprise resource planning software designed specifically for the jewellery industry. It helps jewellers, wholesalers, manufacturers, multi-branch businesses, and money lenders streamline their operations, manage inventory, billing, customer relationships, and compliance efficiently.',
                    ],
                    (object) [
                        'id' => 'default-2',
                        'question' => 'Who can use JEWELERP?',
                        'answer' => 'JEWELERP offers different versions to serve a variety of jewellery businesses, including retail jewellers, wholesalers, manufacturers, multi-branch owners, and money lenders dealing with gold loans. Each version is tailored to meet the specific needs of that segment.',
                    ],
                    (object) [
                        'id' => 'default-3',
                        'question' => 'Is JEWELERP suitable for small businesses?',
                        'answer' => 'Yes! JEWELERP is scalable and can be customised to fit the requirements of small, medium, and large jewellery businesses. Whether you operate a single showroom or multiple branches, we have a version that fits your needs.',
                    ],
                    (object) [
                        'id' => 'default-4',
                        'question' => 'Does JEWELERP support GST compliance?',
                        'answer' => 'Absolutely. Our software is designed to handle GST billing, filing, and reporting seamlessly, ensuring your business stays compliant with the latest tax regulations.',
                    ],
                ]);
        @endphp

        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-12">
                <div class="accordion jewel-faq-accordion" id="jewelFaqAccordion">
                    @forelse ($displayFaqs as $faq)
                        <div class="accordion-item jewel-faq-item">
                            <h3 class="accordion-header" id="faq-heading-{{ $faq->id }}">
                                <button class="accordion-button @if (!$loop->first) collapsed @endif" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}"
                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                    aria-controls="faq-{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h3>
                            <div id="faq-{{ $faq->id }}"
                                class="accordion-collapse collapse @if ($loop->first) show @endif"
                                data-bs-parent="#jewelFaqAccordion">
                                <div class="accordion-body">{{ $faq->answer }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">FAQs will be available soon.</p>
                    @endforelse
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