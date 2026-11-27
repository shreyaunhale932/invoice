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
                    Complete stock visibility
                </div>

                <h1 class="jewel-billing-title">
                   Know what you own, where it is and how it is performing.
                </h1>

                <p class="jewel-billing-description">
                    Track every jewellery item from inward to sale with the attributes, location, movement and ageing insight your teams need.
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
                     <i class="bi bi-grid"></i>
                    <span>Inventory Management</span>
                </div>

                <div class="jewel-billing-image-wrap">

                    <img
                        src="{{ asset('front_assets/img/solutions/inventory managemnet.jpg') }}"
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
                Replace uncertainty with control in inventory management.
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
                        Unclear stock position

                    </h4>

                    <p>
                       Teams cannot quickly confirm item-level availability across locations.
                    </p>

                </div>

            </div>


            <!-- CARD 02 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">
                    02
                </span>

                <div class="jc-card-content">

                    <h4>
                       Slow-moving capital
                    </h4>

                    <p>
Ageing designs remain unnoticed while working capital stays locked.                    </p>

                </div>

            </div>


            <!-- CARD 03 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">
                    03
                </span>

                <div class="jc-card-content">

                    <h4>
                       Difficult reconciliation

                    </h4>

                    <p>
Pieces, gross weight and fine weight do not always align during audit.

                    </p>

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

        <div
            class="jn-key-features-heading jn-reveal">

            <span
                class="jn-key-features-eyebrow">
                KEY FEATURES
            </span>


            <h1>

Everything your team needs for inventory 
             

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

            <div
                class="jn-feature-card jn-reveal">

                <div
                    class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <rect
                            x="6"
                            y="3"
                            width="12"
                            height="18"
                            rx="1.5"
                            stroke="currentColor"
                            stroke-width="1.8" />

                        <rect
                            x="9"
                            y="6"
                            width="6"
                            height="3"
                            rx="0.5"
                            stroke="currentColor"
                            stroke-width="1.5" />

                        <circle
                            cx="9"
                            cy="13"
                            r="0.8"
                            fill="currentColor" />

                        <circle
                            cx="12"
                            cy="13"
                            r="0.8"
                            fill="currentColor" />

                        <circle
                            cx="15"
                            cy="13"
                            r="0.8"
                            fill="currentColor" />

                        <circle
                            cx="9"
                            cy="16.5"
                            r="0.8"
                            fill="currentColor" />

                        <circle
                            cx="12"
                            cy="16.5"
                            r="0.8"
                            fill="currentColor" />

                        <circle
                            cx="15"
                            cy="16.5"
                            r="0.8"
                            fill="currentColor" />

                    </svg>

                </div>


                <div
                    class="jn-feature-content">

                    <h4>
Item-level inventory
                    </h4>

                    <p>
                       Track piece, weight, purity, stones, category and design.


                    </p>

                </div>

            </div>


            <!-- =================================================
                     FEATURE 02
                ================================================== -->

            <div
                class="jn-feature-card jn-reveal">

                <div
                    class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <path
                            d="M5 19V5"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round" />

                        <path
                            d="M5 19H20"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round" />

                        <path
                            d="M9 15V11"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round" />

                        <path
                            d="M13 15V8"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round" />

                        <path
                            d="M17 15V5"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round" />

                    </svg>

                </div>


                <div
                    class="jn-feature-content">

                    <h4>
                        Movement history

                    </h4>

                    <p>
                       Follow each item through inward, transfer, issue and sale.


                    </p>

                </div>

            </div>


            <!-- =================================================
                     FEATURE 03
                ================================================== -->

            <div
                class="jn-feature-card jn-reveal">

                <div
                    class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <path
                            d="M7 3.5H17V20.5L15 19L13 20.5L11 19L9 20.5L7 19V3.5Z"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linejoin="round" />

                        <path
                            d="M9.5 8H14.5"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                        <path
                            d="M9.5 11H14.5"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                        <path
                            d="M9.5 14H13"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                    </svg>

                </div>


                <div
                    class="jn-feature-content">

                    <h4>
                      Ageing analysis

                    </h4>

                    <p>
                       Identify slow stock by age, category, branch or supplier.


                    </p>

                </div>

            </div>


            <!-- =================================================
                     FEATURE 04
                ================================================== -->

            <div
                class="jn-feature-card jn-reveal">

                <div
                    class="jn-feature-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none">

                        <circle
                            cx="10"
                            cy="8"
                            r="4"
                            stroke="currentColor"
                            stroke-width="1.8" />

                        <path
                            d="M3.5 20C3.5 16.5 6.4 14 10 14C13.6 14 16.5 16.5 16.5 20"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round" />

                        <path
                            d="M16 4.5C18.7 4.7 20.5 6.3 20.5 8.5C20.5 10.3 19.3 11.8 17.5 12.3"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M17.5 14C20 14.6 21.5 16.5 21.5 19"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                    </svg>

                </div>


                <div
                    class="jn-feature-content">

                    <h4>
Physical verification
                    </h4>

                    <p>
                        Compare counted stock with system records efficiently.


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
            <h1 class="jn-how-title">A clear workflow from start to finish.
</h1>
            <p class="jn-how-description">
                Keep your team aligned with a structured process that updates connected records along the way.

</p>
        </div>
        <div class="jn-how-timeline" aria-label="Sales workflow">
            <article class="jn-how-step jn-reveal-up">
                <div class="jn-how-number">1</div>
                <div>
                    <h3 class="jn-how-step-title">Capture item
</h3>
                    <p class="jn-how-step-description">Create the complete jewellery stock record.

p>
                </div>
            </article>
            <article class="jn-how-step jn-reveal-up">
                <div class="jn-how-number">2</div>
                <div>
                    <h3 class="jn-how-step-title">Identify</h3>
                    <p class="jn-how-step-description">Assign a barcode or RFID tag.

</p>
                </div>
            </article>
            <article class="jn-how-step jn-reveal-up">
                <div class="jn-how-number">3</div>
                <div>
                    <h3 class="jn-how-step-title">Track movement
</h3>
                    <p class="jn-how-step-description">Update location through every stock workflow.

</p>
                </div>
            </article>
            <article class="jn-how-step jn-reveal-up">
                <div class="jn-how-number">4</div>
                <div>
                    <h3 class="jn-how-step-title">Review & act


</h3>
                    <p class="jn-how-step-description">Use ageing and availability insight to optimize stock.

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
                   Less manual effort.
<br class="d-none d-xl-block">
                   More confident decisions.
                </h1>

                <p class="business-benefits-description">
                   Improve the accuracy and pace of everyday work while keeping management in control.


                </p>

                <!-- Benefits List -->
                <div class="row business-benefits-list">

                    <div class="col-md-6 col-12">
                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Higher stock accuracy
</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Faster item availability checks

</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Lower working-capital lockup
</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Stronger loss prevention
</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Information Card -->
            <div class="col-lg-5 col-12 business-benefits-card-column">
                <div class="business-benefits-card">

                    <i class="bi bi-exclamation-circle business-benefits-icon"></i>

                    <h5>Built around jewellery operations
</h5>

                    <p>
                        JewelERP connects transaction detail with the weight, purity, value, item and customer context your business depends on.


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
            <h6 class="small-heading">Product interface
</h6>
            <h1>The right information, ready when your team needs it.
</h1>
            <p>
A focused inventory overview workspace keeps transactions, exceptions and results easy to understand.



            </p>
        </div>

        <!-- Dashboard Image -->
        <div class="dashboard-image-wrapper">
            <img
                src="{{ asset('front_assets/img/solutions/inventory managemnet.jpg') }}"
                alt="JewelERP business management dashboard"
                class="dashboard-image">
        </div>

    </div>
</section>


<section class="jewel-related-section">
    <div class="container-fluit">

        <!-- Section Heading -->
        <div class="jewel-related-header">
            <span class="jewel-related-label">CONNECTED WORKFLOWS</span>

            <h1>Explore related JewelERP solutions</h1>

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
                    <i class="bi bi-upc-scan"></i>
                </div>

                <div class="jewel-related-content">
                    <h3>Barcode &amp; RFID Tagging</h3>
                    <p>
                        Tag every jewellery piece with barcode or RFID for instant
                        identification and stock accuracy.
                    </p>
                </div>

                <div class="jewel-related-arrow">
                    <i class="bi bi-arrow-right"></i>
                </div>

            </a>

            <!-- Item 2 -->
              <a href="{{ url('/multi-branch-management') }}"
                class="jewel-related-card">

                <div class="jewel-related-icon">
                          <i class="fa-solid fa-code-branch"></i>

                </div>

                <div class="jewel-related-content">
                    <h3> Multi-Branch Management</h3>
                    <p>
                        Run multiple store locations from one dashboard with centralized inventory and reporting.
                    </p>
                </div>

                <div class="jewel-related-arrow">
                        <i class="bi bi-arrow-right"></i>
                </div>

            </a>

            <!-- Item 3 -->
            <a href="{{ url('/real-time-mis-report') }}"
                class="jewel-related-card">

                <div class="jewel-related-icon">
                                    <i class="fa-solid fa-chart-column"></i>


                </div>

                <div class="jewel-related-content">
                    <h3>Real-Time MIS Reports</h3>
                    <p>
            Access live sales, inventory, profitability and business performance reports at any time.
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