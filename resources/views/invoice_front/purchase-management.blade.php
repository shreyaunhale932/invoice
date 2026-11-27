@extends('invoice_front.includes.app')

@section('content')


<section class="jewel-billing-hero">
    <div class="container-fluid jewel-billing-container">
        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-12 col-lg-6 jewel-billing-left">

                <a href="{{ route('invoice-front') }}#solutions" class="jewel-billing-back">
                    <i class="bi bi-chevron-left"></i>
                    <span>All solutions</span>
                </a>

                <div class="jewel-billing-eyebrow">
                    Controlled procurement
                </div>

                <h1 class="jewel-billing-title">
                    Know exactly what you purchased, received and still owe.
                </h1>

                <p class="jewel-billing-description">
                    Manage jewellery purchases from vendor order to inward entry with transparent weight, purity, cost, tax and payable tracking.
                </p>

                <!-- Buttons -->
                <div class="jewel-billing-actions">

                    <a href="contact" class="jewel-billing-primary-btn">
                        Book a Demo
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <a href="#how-it-works" class="jewel-billing-secondary-btn">
                        See how it works
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

                <!-- Benefits -->
                <div class="jewel-billing-benefits">

                    <span>
                        <i class="bi bi-check2"></i>
                        Jewellery-specific workflows
                    </span>

                    <span>
                        <i class="bi bi-check2"></i>
                        Live connected data
                    </span>

                </div>

            </div>

            <!-- Right Side Dashboard Image -->
            <div class="col-12 col-lg-6 jewel-billing-right">

                <!-- Floating Label -->
                <div class="jewel-billing-floating-label">
                    <i class="bi bi-receipt-cutoff"></i>
                    <span>Purchase Management</span>
                </div>

                <div class="jewel-billing-image-wrap">

                    <img
                        src="{{ asset('front_assets/img/solutions/purchase-management.jpg') }}"
                        alt="Jewellery billing and invoice management dashboard"
                        class="jewel-billing-image"
                        loading="eager">

                </div>

            </div>

        </div>
    </div>
</section>


<section class="jc-business-challenges">

    <div class="jc-challenges-container">

        <!-- HEADING -->
        <div class="jc-challenges-heading reveal">

            <span class="jc-eyebrow">
                BUSINESS CHALLENGES
            </span>

            <h1>
                Replace uncertainty with control in purchase and
                
                sell management.
            </h1>

            <p>
                JewelERP brings the critical information and actions for this workflow into one connected
                <br class="jc-desktop-break">
                system.
            </p>

        </div>


        <!-- CHALLENGES -->
        <div class="jc-challenges-grid">


            <!-- CARD 01 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">
                    01
                </span>

                <div class="jc-card-content">

                    <h4>
                        Unclear landed cost
                    </h4>

                    <p>
                        Metal, stones, charges and taxes are often tracked in separate sheets. </p>

                </div>

            </div>


            <!-- CARD 02 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">
                    02
                </span>

                <div class="jc-card-content">

                    <h4>
                        Receipt mismatches
                    </h4>

                    <p>
                        Ordered quantity and actual weight received can differ without a clear audit trail. </p>

                </div>

            </div>


            <!-- CARD 03 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">
                    03
                </span>

                <div class="jc-card-content">

                    <h4>
                        Vendor reconciliation delays
                    </h4>

                    <p>
                        Pending approvals, returns and balances make settlement time-consuming. </p>

                </div>

            </div>


        </div>

    </div>

</section>

<section class="jn-key-features-section">

    <div class="jn-key-features-container">

        <!-- =================================================
                 HEADING
            ================================================== -->

        <div class="jn-key-features-heading jn-reveal">

            <span class="jn-key-features-eyebrow">
                KEY FEATURES
            </span>

            <h1>
                Everything your team needs for purchase
               
                management.
            </h1>

        </div>


        <!-- =================================================
                 FEATURES
            ================================================== -->

        <div class="jn-features-box">


            <!-- =================================================
                     FEATURE 01
                ================================================== -->

            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <path
                            d="M3.5 7.5L12 3L20.5 7.5L12 12L3.5 7.5Z"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linejoin="round" />

                        <path
                            d="M3.5 7.5V16.5L12 21L20.5 16.5V7.5"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linejoin="round" />

                        <path
                            d="M12 12V21"
                            stroke="currentColor"
                            stroke-width="1.7" />

                        <path
                            d="M8 5.5L16.5 10"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Purchase inward
                    </h4>

                    <p>
                        Record item, weight, purity, stone
                        and charge details together.
                    </p>

                </div>

            </div>


            <!-- =================================================
                     FEATURE 02
                ================================================== -->

            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <rect
                            x="4"
                            y="6"
                            width="16"
                            height="14"
                            rx="2"
                            stroke="currentColor"
                            stroke-width="1.8" />

                        <path
                            d="M8 6V4.5C8 3.7 8.7 3 9.5 3H14.5C15.3 3 16 3.7 16 4.5V6"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round" />

                        <path
                            d="M4 11H20"
                            stroke="currentColor"
                            stroke-width="1.6" />

                        <path
                            d="M9 14H15"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Vendor ledgers
                    </h4>

                    <p>
                        Track invoices, returns, payments and
                        outstanding balances.
                    </p>

                </div>

            </div>


            <!-- =================================================
                     FEATURE 03
                ================================================== -->

            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <rect
                            x="5"
                            y="3"
                            width="14"
                            height="18"
                            rx="1.5"
                            stroke="currentColor"
                            stroke-width="1.7" />

                        <rect
                            x="8"
                            y="6"
                            width="8"
                            height="3"
                            rx="0.5"
                            stroke="currentColor"
                            stroke-width="1.5" />

                        <path
                            d="M8 13H8.01M12 13H12.01M16 13H16.01"
                            stroke="currentColor"
                            stroke-width="2.2"
                            stroke-linecap="round" />

                        <path
                            d="M8 16H8.01M12 16H12.01M16 16H16.01"
                            stroke="currentColor"
                            stroke-width="2.2"
                            stroke-linecap="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Cost allocation
                    </h4>

                    <p>
                        Build an accurate landed cost for
                        every received item.
                    </p>

                </div>

            </div>


            <!-- =================================================
                     FEATURE 04
                ================================================== -->

            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <path
                            d="M12 3L19 6V11.5C19 15.8 16.1 19.2 12 21C7.9 19.2 5 15.8 5 11.5V6L12 3Z"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round" />

                        <path
                            d="M9 12L11 14L15.5 9.5"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Approval controls
                    </h4>

                    <p>
                        Keep purchases reviewable before
                        they affect stock and accounts.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>



<section id="how-it-works" class="jn-how-section ">
    <div class="jn-how-container">
        <div class="jn-how-left jn-reveal-up">
            <span class="jn-how-eyebrow">HOW IT WORKS</span>
            <h1 class="jn-how-title">A clear workflow from start to finish.</h1>
            <p class="jn-how-description">Keep your team aligned with a structured process that updates connected records along the way.</p>
        </div>
        <div class="jn-how-timeline" aria-label="Purchase workflow">

            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">1</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Record purchase
                    </h3>

                    <p class="jn-how-step-description">
                        Enter vendor document and commercial terms.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">2</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Receive stock
                    </h3>

                    <p class="jn-how-step-description">
                        Capture actual pieces, weight, purity and stones.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">3</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Verify
                    </h3>

                    <p class="jn-how-step-description">
                        Compare purchase details and route exceptions for approval.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">4</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Post
                    </h3>

                    <p class="jn-how-step-description">
                        Update inventory, costing and vendor payable together.
                    </p>
                </div>

            </article>

        </div>
    </div>
</section>

<section class="business-benefits-section">

    <div class="container">

        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-lg-7 col-12 business-benefits-content">

                <span class="business-benefits-label">
                    BUSINESS BENEFITS
                </span>

                <h1 class="business-benefits-title">
                    Less manual effort. More<br class="d-none d-xl-block">
                    confident decisions.
                </h1>

                <p class="business-benefits-description">
                    Improve the accuracy and pace of everyday work while keeping
                    management in control.
                </p>


                <!-- Benefits List -->
                <div class="row business-benefits-list">

                    <!-- Column 01 -->
                    <div class="col-md-6 col-12">

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Reliable landed costs</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Traceable inward stock</span>
                        </div>

                    </div>


                    <!-- Column 02 -->
                    <div class="col-md-6 col-12">

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Faster vendor reconciliation</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Stronger purchase controls</span>
                        </div>

                    </div>

                </div>

            </div>


            <!-- Right Information Card -->
            <div class="col-lg-5 col-12 business-benefits-card-column">

                <div class="business-benefits-card">

                    <i class="bi bi-exclamation-circle business-benefits-icon"></i>

                    <h5>
                        Built around jewellery operations
                    </h5>

                    <p>
                        JewelERP connects transaction detail with the weight,
                        purity, value, item and customer context your business
                        depends on.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="dashboard-section" data-reveal>
    <div class="container-fluid px-3 px-md-4">

        <!-- Section Heading -->
        <div class="dashboard-heading text-center">
            <h6 class="small-heading">Product interface</h6>
            <h1>Product interface
                The right information, ready when your team needs it.</h1>
            <p>
                A focused purchase inward workspace keeps transactions, exceptions and results easy to understand.

            </p>
        </div>

        <!-- Dashboard Image -->
        <div class="dashboard-image-wrapper">
            <img
                src="{{ asset('front_assets/img/solutions/purchase-management.jpg') }}"
                alt="JewelERP business management dashboard"
                class="dashboard-image">
        </div>

    </div>
</section>


<section class="jewel-related-section">

    <div class="container-fluid">

        <!-- Section Heading -->
        <div class="jewel-related-header">

            <span class="jewel-related-label">
                CONNECTED WORKFLOWS
            </span>

            <h1>
                Explore related JewelERP solutions
            </h1>

            <p>
                Each module works together so your team can move from one workflow
                to the next without losing<br class="d-none d-md-block">
                context.
            </p>

        </div>


        <!-- Related Solutions -->
        <div class="jewel-related-list">


            <!-- Item 1 -->
            <a href="{{ url('/invoice-and-solution') }}"
                class="jewel-related-card">

                <div class="jewel-related-icon">
                    <i class="bi bi-grid-3x3-gap"></i>
                </div>

                <div class="jewel-related-content">

                    <h3>
                        Inventory Management
                    </h3>

                    <p>
                        Track jewellery stock by weight, purity, category and location
                        across your entire business.
                    </p>

                </div>

                <div class="jewel-related-arrow">
                    <i class="bi bi-arrow-right"></i>
                </div>

            </a>


            <!-- Item 2 -->
            <a href="{{ url('/invoice-and-solution') }}"
                class="jewel-related-card">

                <div class="jewel-related-icon">
                    <i class="bi bi-upc-scan"></i>
                </div>

                <div class="jewel-related-content">

                    <h3>
                        Barcode &amp; RFID Tagging
                    </h3>

                    <p>
                        Tag every jewellery piece with barcode or RFID for instant
                        identification and stock accuracy.
                    </p>

                </div>

                <div class="jewel-related-arrow">
                    <i class="bi bi-arrow-right"></i>
                </div>

            </a>


            <!-- Item 3 -->
            <a href="{{ url('/invoice-and-solution') }}"
                class="jewel-related-card">

                <div class="jewel-related-icon">
                    <i class="bi bi-bar-chart-line"></i>
                </div>

                <div class="jewel-related-content">

                    <h3>
                        Real-Time MIS Reports
                    </h3>

                    <p>
                        Access live sales, inventory, profitability and business
                        performance reports at any time.
                    </p>

                </div>

                <div class="jewel-related-arrow">
                    <i class="bi bi-arrow-right"></i>
                </div>

            </a>


        </div>

    </div>

</section>


<section class="jewel-faq-section" data-reveal>
    <div class="container-fluid jewel-faq-container">

        <!-- Heading -->
        <h1 class="jewel-faq-title" data-reveal>
            Frequently
            asked questions (FAQ)
        </h1>

        <div class="row g-4 align-items-start">

            <!-- FAQ Accordion -->
            <div class="col-12 col-lg-12">
                <div class="accordion jewel-faq-accordion" id="jewelFaqAccordion">

                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq1">

                                What is JEWELERP?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show"
                            data-bs-parent="#jewelFaqAccordion">
                            <div class="accordion-body">
                                JEWELERP is a specialised enterprise resource planning software designed specifically for the jewellery industry. It helps jewellers, wholesalers, manufacturers, multi-branch businesses, and money lenders streamline their operations, manage inventory, billing, customer relationships, and compliance efficiently.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq2">

                                Who can use JEWELERP?

                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse"
                            data-bs-parent="#jewelFaqAccordion">
                            <div class="accordion-body">
                                JEWELERP offers different versions to serve a variety of jewellery businesses, including retail jewellers, wholesalers, manufacturers, multi-branch owners, and money lenders dealing with gold loans. Each version is tailored to meet the specific needs of that segment. </div>
                        </div>
                    </div>

                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq3">

                                Is JEWELERP suitable for small businesses?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse"
                            data-bs-parent="#jewelFaqAccordion">
                            <div class="accordion-body">
                                Yes! JEWELERP is scalable and can be customised to fit the requirements of small, medium, and large jewellery businesses. Whether you operate a single showroom or multiple branches, we have a version that fits your needs.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq4">


                                Does JEWELERP support GST compliance? </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse"
                            data-bs-parent="#jewelFaqAccordion">
                            <div class="accordion-body">
                                Absolutely. Our software is designed to handle GST billing, filing, and reporting seamlessly, ensuring your business stays compliant with the latest tax regulations.
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Read More Link -->
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

<section class="jewel-cta-section">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-lg-8 col-md-12">
                <div class="jewel-cta-content">

                    <span class="jewel-cta-subtitle">
                        MOVE FORWARD WITH CONFIDENCE
                    </span>

                    <h1>
                        Ready to Simplify Your Jewellery
                        Business?
                    </h1>

                    <p>
                        See how JewelERP can connect your people,
                        processes and business data.
                    </p>

                </div>
            </div>

            <!-- Right Buttons -->
            <div class="col-lg-4 col-md-12">
                <div class="jewel-cta-buttons">

                    <a href="{{ url('/contact') }}"
                        class="jewel-cta-btn jewel-cta-primary">
                        Book a Demo
                        <i class="bi bi-arrow-right"></i>
                    </a>



                </div>
            </div>

        </div>
    </div>
</section>


@include('invoice_front.includes.ai-tools')



@endsection