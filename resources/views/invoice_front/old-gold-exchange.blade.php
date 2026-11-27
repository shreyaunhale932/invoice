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
                    Confident exchange valuation
                </div>

                <h1 class="jewel-billing-title">
                    Make old gold exchange transparent for your team and customer.

                </h1>

                <p class="jewel-billing-description">
                    Guide testing, deductions, net fine weight, rate application and invoice adjustment through one documented exchange process.

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
                           <i class="bi bi-arrow-left-right"></i>

                    <span>Old Gold Exchange</span>
                </div>

                <div class="jewel-billing-image-wrap">

                    <img
                        src="{{ asset('front_assets/img/solutions/old-gold.jpg') }}"
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
                Replace uncertainty with control in
                old gold exchange.
            </h1>

            <p>
                JewelERP brings the critical information and actions for this workflow into one connected system.
            </p>

        </div>

        <!-- CHALLENGES -->
        <div class="jc-challenges-grid">

            <!-- CARD 01 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">01</span>

                <div class="jc-card-content">
                    <h4>Inconsistent valuation</h4>

                    <p>
                        Purity, deductions and rates may be applied
                        differently across counters.
                    </p>
                </div>

            </div>

            <!-- CARD 02 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">02</span>

                <div class="jc-card-content">
                    <h4>Limited audit trail</h4>

                    <p>
                        Manual calculations make it difficult to explain
                        the final exchange value.
                    </p>
                </div>

            </div>

            <!-- CARD 03 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">03</span>

                <div class="jc-card-content">
                    <h4>Disconnected settlement</h4>

                    <p>
                        Exchange value is not always tied cleanly to the
                        new sale and accounts.
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>
<section class="jn-key-features-section">
    <div class="jn-key-features-container">

        <!-- HEADING -->
        <div class="jn-key-features-heading jn-reveal">
            <span class="jn-key-features-eyebrow">KEY FEATURES</span>

            <h1>
                Everything your team needs for old gold
                exchange.
            </h1>
        </div>

        <!-- FEATURES -->
        <div class="jn-features-box">

            <!-- FEATURE 01 -->
            <div class="jn-feature-card jn-reveal">
                <div class="jn-feature-icon">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>

                <div class="jn-feature-content">
                    <h4>Purity-based valuation</h4>
                    <p>
                        Calculate value from tested purity and
                        net eligible weight.
                    </p>
                </div>
            </div>

            <!-- FEATURE 02 -->
            <div class="jn-feature-card jn-reveal">
                <div class="jn-feature-icon">
                    <i class="fa-solid fa-calculator"></i>
                </div>

                <div class="jn-feature-content">
                    <h4>Clear deductions</h4>
                    <p>
                        Record stones, impurities and applicable
                        processing deductions.
                    </p>
                </div>
            </div>

            <!-- FEATURE 03 -->
            <div class="jn-feature-card jn-reveal">
                <div class="jn-feature-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <div class="jn-feature-content">
                    <h4>Rate control</h4>
                    <p>
                        Apply the authorized exchange rate
                        for the transaction.
                    </p>
                </div>
            </div>

            <!-- FEATURE 04 -->
            <div class="jn-feature-card jn-reveal">
                <div class="jn-feature-icon">
                    <i class="fa-solid fa-receipt"></i>
                </div>

                <div class="jn-feature-content">
                    <h4>Invoice adjustment</h4>
                    <p>
                        Use approved exchange value directly
                        in the new sale.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="how-it-works" class="jn-how-section">
    <div class="jn-how-container">

        <!-- LEFT CONTENT -->
        <div class="jn-how-left jn-reveal-up">
            <span class="jn-how-eyebrow">HOW IT WORKS</span>

            <h1 class="jn-how-title">
                A clear workflow from start to finish.
            </h1>

            <p class="jn-how-description">
                Keep your team aligned with a structured process that
                updates connected records along the way.
            </p>
        </div>

        <!-- RIGHT TIMELINE -->
        <div class="jn-how-timeline" aria-label="Old gold exchange workflow">

            <!-- STEP 1 -->
            <article class="jn-how-step jn-reveal-up">
                <div class="jn-how-number">1</div>

                <div>
                    <h3 class="jn-how-step-title">Receive &amp; test</h3>
                    <p class="jn-how-step-description">
                        Record customer item and assessed purity.
                    </p>
                </div>
            </article>

            <!-- STEP 2 -->
            <article class="jn-how-step jn-reveal-up">
                <div class="jn-how-number">2</div>

                <div>
                    <h3 class="jn-how-step-title">Weigh &amp; deduct</h3>
                    <p class="jn-how-step-description">
                        Calculate eligible net and fine weight.
                    </p>
                </div>
            </article>

            <!-- STEP 3 -->
            <article class="jn-how-step jn-reveal-up">
                <div class="jn-how-number">3</div>

                <div>
                    <h3 class="jn-how-step-title">Value</h3>
                    <p class="jn-how-step-description">
                        Apply the approved rate and charges.
                    </p>
                </div>
            </article>

            <!-- STEP 4 -->
            <article class="jn-how-step jn-reveal-up">
                <div class="jn-how-number">4</div>

                <div>
                    <h3 class="jn-how-step-title">Settle</h3>
                    <p class="jn-how-step-description">
                        Adjust the exchange against the customer invoice.
                    </p>
                </div>
            </article>

        </div>
    </div>
</section>
<section class="business-benefits-section">
    <div class="container">
        <div class="row align-items-center">

            <!-- LEFT CONTENT -->
            <div class="col-lg-7 col-12 business-benefits-content">

                <span class="business-benefits-label">
                    BUSINESS BENEFITS
                </span>

                <h1 class="business-benefits-title">
                    Less manual effort. More
                    <br class="d-none d-xl-block">
                    confident decisions.
                </h1>

                <p class="business-benefits-description">
                    Improve the accuracy and pace of everyday work while keeping management in control.
                </p>

                <!-- BENEFITS LIST -->
                <div class="row business-benefits-list">

                    <!-- LEFT BENEFITS -->
                    <div class="col-md-6 col-12">

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Consistent valuations</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Traceable approvals</span>
                        </div>

                    </div>

                    <!-- RIGHT BENEFITS -->
                    <div class="col-md-6 col-12">

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Transparent customer explanation</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Accurate sale settlement</span>
                        </div>

                    </div>

                </div>
            </div>

            <!-- RIGHT INFORMATION CARD -->
            <div class="col-lg-5 col-12 business-benefits-card-column">

                <div class="business-benefits-card">

                    <i class="bi bi-exclamation-circle business-benefits-icon"></i>

                    <h5>
                        Built around jewellery operations
                    </h5>

                    <p>
                        JewelERP connects transaction detail with the weight, purity,
                        value, item and customer context your business depends on.
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
A focused exchange valuation workspace keeps transactions, exceptions and results easy to understand.




            </p>
        </div>

        <!-- Dashboard Image -->
        <div class="dashboard-image-wrapper">
            <img
                src="{{ asset('front_assets/img/solutions/old-gold.jpg') }}"
                alt="JewelERP business management dashboard"
                class="dashboard-image">
        </div>

    </div>
</section>

<section class="jewel-related-section">
    <div class="container-fluid">

        <!-- SECTION HEADING -->
        <div class="jewel-related-header">
            <span class="jewel-related-label">CONNECTED WORKFLOWS</span>

            <h1>Explore related JewelERP solutions</h1>

            <p>
                Each module works together so your team can move from one workflow
                to the next without losing
                <br class="d-none d-md-block">
                context.
            </p>
        </div>

        <!-- RELATED SOLUTIONS -->
        <div class="jewel-related-list">

            <!-- ITEM 1 -->
            <a href="{{ url('/invoice-and-solution') }}"
               class="jewel-related-card">

                <div class="jewel-related-icon">
                    <i class="bi bi-receipt"></i>
                </div>

                <div class="jewel-related-content">
                    <h3>Invoice &amp; Sell Management</h3>
                    <p>
                        Create jewellery-specific invoices with making charges,
                        stone values, GST and fast POS billing.
                    </p>
                </div>

                <div class="jewel-related-arrow">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </a>

            <!-- ITEM 2 -->
            <a href="{{ url('/inventory-management') }}"
               class="jewel-related-card">

                <div class="jewel-related-icon">
                    <i class="bi bi-grid"></i>
                </div>

                <div class="jewel-related-content">
                    <h3>Inventory Management</h3>
                    <p>
                        Track jewellery stock by weight, purity, category
                        and location across your entire business.
                    </p>
                </div>

                <div class="jewel-related-arrow">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </a>

            <!-- ITEM 3 -->
            <a href="{{ url('/real-time-mis-report') }}"
               class="jewel-related-card">

                <div class="jewel-related-icon">
                    <i class="bi bi-bar-chart-line"></i>
                </div>

                <div class="jewel-related-content">
                    <h3>Real-Time MIS Reports</h3>
                    <p>
                        Access live sales, inventory, profitability and
                        business performance reports at any time.
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