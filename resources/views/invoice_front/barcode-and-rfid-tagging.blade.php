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
                    Instant item identification
                </div>

                <h1 class="jewel-billing-title">
                    Give every jewellery piece a fast, accurate digital identity. </h1>

                <p class="jewel-billing-description">
                    Generate jewellery labels and connect each item to its weight, purity, design, stone, price and location using barcode or RFID.
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
                    <span>Barcode & RFID Tagging</span>
                </div>

                <div class="jewel-billing-image-wrap">

                    <img
                        src="{{ asset('front_assets/img/solutions/barcode.jpg') }}"
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
                Replace uncertainty with control in barcode
              
                &amp; RFID tagging.
            </h1>

            <p>
                JewelERP brings the critical information and actions for this workflow into one connected system.
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
                        Slow item lookup
                    </h4>

                    <p>
                        Counter teams lose time searching for product
                        and pricing details.
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
                        Manual stock counting
                    </h4>

                    <p>
                        Physical verification takes days and interrupts
                        regular operations.
                    </p>

                </div>

            </div>


            <!-- CARD 03 -->
            <div class="jc-challenge-card reveal">

                <span class="jc-number">
                    03
                </span>

                <div class="jc-card-content">

                    <h4>
                        Mislabelled inventory
                    </h4>

                    <p>
                        Disconnected tags create pricing errors and
                        unreliable stock data.
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

            <span class="jn-key-features-eyebrow">
                KEY FEATURES
            </span>

            <h1>
                Everything your team needs for barcode &amp;
              
                RFID tagging.
            </h1>

        </div>


        <!-- FEATURES -->
        <div class="jn-features-box">


            <!-- FEATURE 01 -->
            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg viewBox="0 0 24 24" fill="none">

                        <path
                            d="M5 8L8 5H18L21 8V10L18 13H8L5 10V8Z"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linejoin="round" />

                        <circle
                            cx="9"
                            cy="9"
                            r="1"
                            stroke="currentColor"
                            stroke-width="1.4" />

                        <path
                            d="M8 13L5 16L8 19"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round" />

                        <path
                            d="M16 13L19 16L16 19"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Flexible tag design
                    </h4>

                    <p>
                        Configure tag content for your
                        products and printers.
                    </p>

                </div>

            </div>


            <!-- FEATURE 02 -->
            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg viewBox="0 0 24 24" fill="none">

                        <path
                            d="M8 5V19"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M11 7V17"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M14 5V19"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M17 8V16"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M5 8V16"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Barcode &amp; RFID support
                    </h4>

                    <p>
                        Choose the identification method
                        that fits each workflow.
                    </p>

                </div>

            </div>


            <!-- FEATURE 03 -->
            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg viewBox="0 0 24 24" fill="none">

                        <circle
                            cx="12"
                            cy="12"
                            r="8.5"
                            stroke="currentColor"
                            stroke-width="1.7" />

                        <path
                            d="M12 7V12L15 14"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Rapid stock count
                    </h4>

                    <p>
                        Verify items efficiently and surface
                        mismatches sooner.
                    </p>

                </div>

            </div>


            <!-- FEATURE 04 -->
            <div class="jn-feature-card jn-reveal">

                <div class="jn-feature-icon">

                    <svg viewBox="0 0 24 24" fill="none">

                        <ellipse
                            cx="12"
                            cy="5"
                            rx="7"
                            ry="3"
                            stroke="currentColor"
                            stroke-width="1.7" />

                        <path
                            d="M5 5V12C5 13.7 8.1 15 12 15C15.9 15 19 13.7 19 12V5"
                            stroke="currentColor"
                            stroke-width="1.7" />

                        <path
                            d="M5 12V19C5 20.7 8.1 22 12 22C15.9 22 19 20.7 19 19V12"
                            stroke="currentColor"
                            stroke-width="1.7" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Full item record
                    </h4>

                    <p>
                        Open design, weight, cost, price and
                        movement history instantly.
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

        <div class="jn-how-timeline" aria-label="Barcode and RFID workflow">

            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">1</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Create item
                    </h3>

                    <p class="jn-how-step-description">
                        Capture complete jewellery attributes.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">2</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Generate ID
                    </h3>

                    <p class="jn-how-step-description">
                        Assign a unique barcode or RFID identity.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">3</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Print &amp; attach
                    </h3>

                    <p class="jn-how-step-description">
                        Produce the appropriate jewellery tag.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">4</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Scan anywhere
                    </h3>

                    <p class="jn-how-step-description">
                        Use the tag for billing, transfer and audit.
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
                            <span>Faster item lookup</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Fewer tagging errors</span>
                        </div>

                    </div>


                    <!-- Column 02 -->
                    <div class="col-md-6 col-12">

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Quicker stock verification</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Traceable item movement</span>
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
            <h1>The right information, ready when your team needs it.</h1>
            <p>
                A focused tagging console workspace keeps transactions, exceptions and results easy to understand.
            </p>
        </div>

        <!-- Dashboard Image -->
        <div class="dashboard-image-wrapper">
            <img
                src="{{ asset('front_assets/img/solutions/barcode.jpg') }}"
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
                    <i class="bi bi-receipt"></i>
                </div>

                <div class="jewel-related-content">

                    <h3>
                        Invoice &amp; Sell Management
                    </h3>

                    <p>
                        Create jewellery-specific invoices with making charges,
                        stone values, GST and fast POS billing.
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
                    <i class="bi bi-diagram-3"></i>
                </div>

                <div class="jewel-related-content">

                    <h3>
                        Multi-Branch Management
                    </h3>

                    <p>
                        Run multiple store locations from one dashboard with
                        centralized inventory and reporting.
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


                    <!-- FAQ 01 -->
                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq2">

                                Can JewelERP track purchase returns?

                            </button>
                        </h3>

                        <div id="faq2"
                            class="accordion-collapse collapse"
                            data-bs-parent="#jewelFaqAccordion">

                            <div class="accordion-body">
                                Yes. JewelERP can track purchase returns along with
                                the related item, quantity, weight, vendor and
                                transaction details.
                            </div>

                        </div>
                    </div>


                    <!-- FAQ 02 -->
                    <div class="accordion-item jewel-faq-item">

                        <h3 class="accordion-header">

                            <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq3">

                                How are weight differences handled?

                            </button>

                        </h3>

                        <div id="faq3"
                            class="accordion-collapse collapse"
                            data-bs-parent="#jewelFaqAccordion">

                            <div class="accordion-body">
                                Weight differences can be recorded and verified
                                against the purchase details before the transaction
                                is approved.
                            </div>

                        </div>

                    </div>


                    <!-- FAQ 03 -->
                    <div class="accordion-item jewel-faq-item">

                        <h3 class="accordion-header">

                            <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq4">

                                Can purchase costs flow into item valuation?

                            </button>

                        </h3>

                        <div id="faq4"
                            class="accordion-collapse collapse"
                            data-bs-parent="#jewelFaqAccordion">

                            <div class="accordion-body">
                                Yes. Purchase-related costs can be included in item
                                valuation to help maintain accurate landed costs and
                                inventory values.
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