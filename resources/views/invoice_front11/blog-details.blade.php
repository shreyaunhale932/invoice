@extends('invoice_front.includes.app')
@section('content')

<section class="jewel-blog-banner">

    <div class="jewel-banner-pattern"></div>

    <!-- Decorative Elements -->
    <div class="jewel-banner-shape shape-one"></div>
    <div class="jewel-banner-shape shape-two"></div>

    <div class="jewel-banner-icon icon-one">
        <i class="bi bi-gem"></i>
    </div>

    <div class="jewel-banner-icon icon-two">
        <i class="bi bi-box-seam"></i>
    </div>

    <div class="jewel-banner-icon icon-three">
        <i class="bi bi-graph-up-arrow"></i>
    </div>

    <div class="jewel-banner-icon icon-four">
        <i class="bi bi-stars"></i>
    </div>

    <div class="container position-relative">
        <div class="jewel-banner-content text-center">

            <span class="jewel-banner-label">
                <i class="bi bi-gem"></i>
                JEWELERP INSIGHTS
            </span>

            <h1>
               Blog
                
            </h1>

            <div class="jewel-banner-line"></div>

        </div>
    </div>

</section>

<section class="jewel-blog-section">
    <div class="container">
        <div class="row g-4 align-items-start">

            <!-- Left: Featured Blog -->
            <div class="col-lg-7 col-md-12">
                <div class="jewel-blog-featured">

                    <!-- Featured Image -->
                    <a href="{{ url('/blog-details') }}"
                        class="jewel-blog-image-link">
                        <img
                            src="{{ asset('front_assets/img/artical.png') }}"
                            alt="SEO Is Changing"
                            class="jewel-blog-featured-img">
                    </a>

                    <!-- Blog Content -->
                    <div class="jewel-blog-content">

                        <h5 class="jewel-blog-title">
                            How Jewellery ERP
                            Software Can Transform
                            Your Business Operations
                        </h5>

                        <!-- Meta -->
                        <div class="jewel-blog-meta">
                            <span>
                                <i class="bi bi-calendar-check-fill"></i>
                                13 Oct 2026
                            </span>

                            <span>
                                <i class="bi bi-person-fill"></i>
                                admin
                            </span>
                        </div>

                        <p class="jewel-blog-description">
                            Discover how modern jewellery businesses can simplify inventory, billing, customer management and reporting with an integrated ERP system.
                        </p>

                        <h6>Inventory clarity from counter to vault</h6>
                        <p class="jewel-blog-description">
                            Discover how modern jewellery businesses can simplify inventory, billing, customer management and reporting with an integrated ERP system.
                        </p>
                        <ul>
                            <li>
                                Track items by tag, weight, purity and location
                            </li>
                            <li>Monitor stock movement between branches and counters</li>
                            <li>Identify fast-moving and ageing designs</li>
                            <li>Reduce duplicate entries and manual reconciliation</li>
                        </ul>
                        <h6>Faster, more accurate billing</h6>
                        <p class="jewel-blog-description">
                            Modern jewellery billing involves precise calculations across metal rates, stone value, making charges, discounts and tax. Structured workflows reduce repetitive entry and help every invoice follow the same business rules. </p>
                        <h6>Customer intelligence that supports relationships</h6>
                        <p class="jewel-blog-description">
                            A connected customer record can bring purchase history, preferences and interactions together. Teams gain the context to offer more relevant service, follow up thoughtfully and create long-term relationships without depending on individual memory. </p>
                    </div>
                    
                </div>
            </div>

            <!-- Right: Latest Posts -->
            <div class="col-lg-5 col-md-15">
                <div class="jewel-latest-posts">

                    <div class="jewel-sidebar-heading">
                        <h3>Latest Posts</h3>
                        <span></span>
                    </div>

                    <!-- Post 1 -->
                    <a href="{{ url('/blog-details') }}"
                        class="jewel-latest-item">

                        <div class="jewel-latest-img">
                            <img
                                src="{{ asset('front_assets/img/p1.png') }}"
                                alt="SEO Is Changing">
                        </div>

                        <div class="jewel-latest-content">
                            <h4>
                                5 Ways Jewellery ERP Software Helps You Manage Inventory Better.
                            </h4>

                            <span>
                                <i class="bi bi-calendar-fill"></i>
                                13 Oct 2026
                            </span>
                        </div>
                    </a>

                    <!-- Post 2 -->
                    <a href="{{ url('/blog-details') }}"
                        class="jewel-latest-item">

                        <div class="jewel-latest-img">
                            <img
                                src="{{ asset('front_assets/img/p2.png') }}"
                                alt="ChatGPT vs Gemini">
                        </div>

                        <div class="jewel-latest-content">
                            <h4>
                                How Jewellery ERP Software Can Transform Your Business Operations.
                            </h4>

                            <span>
                                <i class="bi bi-calendar-fill"></i>
                                25 Jun 2026
                            </span>
                        </div>
                    </a>

                    <!-- Post 3 -->
                    <a href="{{ url('/blog-details') }}"
                        class="jewel-latest-item">

                        <div class="jewel-latest-img">
                            <img
                                src="{{ asset('front_assets/img/p3.png') }}"
                                alt="WordPress vs Shopify">
                        </div>

                        <div class="jewel-latest-content">
                            <h4>
                                A Complete Guide to Jewellery Billing and GST Management.
                            </h4>

                            <span>
                                <i class="bi bi-calendar-fill"></i>
                                12 Jun 2026
                            </span>
                        </div>
                    </a>

                    <!-- Post 4 -->
                    <a href="{{ url('/blog-details') }}"
                        class="jewel-latest-item">

                        <div class="jewel-latest-img">
                            <img
                                src="{{ asset('front_assets/img/p1.png') }}"
                                alt="Google AI Overviews">
                        </div>

                        <div class="jewel-latest-content">
                            <h4>
                                5 Ways Jewellery ERP Software Helps You Manage Inventory Better.
                            </h4>

                            <span>
                                <i class="bi bi-calendar-fill"></i>
                                04 Jun 2026
                            </span>
                        </div>
                    </a>

                    <!-- Post 5 -->
                    <a href="{{ url('/blog-details') }}"
                        class="jewel-latest-item">

                        <div class="jewel-latest-img">
                            <img
                                src="{{ asset('front_assets/img/p2.png') }}"
                                alt="Business Website Features">
                        </div>

                        <div class="jewel-latest-content">
                            <h4>
                                How Jewellery ERP Software Can Transform Your Business Operations.
                            </h4>

                            <span>
                                <i class="bi bi-calendar-fill"></i>
                                29 May 2026
                            </span>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</section>
@include('invoice_front.includes.ai-tools')
@endsection