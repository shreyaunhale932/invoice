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
                    Transparent job work
                </div>

                <h1 class="jewel-billing-title">
                    Keep every gram and every job accountable from issue to receipt.
                </h1>

                <p class="jewel-billing-description">
                    Create clear karigar workflows for metal issue, production stages, labour charges, wastage and final receipt reconciliation. </p>

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
                    <span>Karigar & Job Work</span>
                </div>

                <div class="jewel-billing-image-wrap">

                    <img
                        src="{{ asset('front_assets/img/solutions/karigar.jpg') }}"
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
                Replace uncertainty with control in karigar &amp;
               
                
                job work.
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
                        Metal outside your premises
                    </h4>

                    <p>
                        Issued gold is difficult to monitor across
                        multiple karigars and jobs.
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
                        Uncertain production status
                    </h4>

                    <p>
                        Teams spend time calling for updates on
                        pending designs and deliveries.
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
                        Manual weight settlement
                    </h4>

                    <p>
                        Issue, receipt, wastage and balance
                        calculations are prone to mistakes.
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

        <div class="jn-key-features-heading jn-reveal">

            <span class="jn-key-features-eyebrow">
                KEY FEATURES
            </span>

            <h1>
                Everything your team needs for karigar &amp;
                
                
                job work.
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
                            d="M12 4V20"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M6 7H18"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M4 7L7 13H1L4 7Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linejoin="round" />

                        <path
                            d="M20 7L23 13H17L20 7Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linejoin="round" />

                        <path
                            d="M3 16H9"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                        <path
                            d="M15 16H21"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Metal issue register
                    </h4>

                    <p>
                        Track purity, fine weight and purpose
                        for every issue.
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
                            y="4"
                            width="7"
                            height="7"
                            rx="1"
                            stroke="currentColor"
                            stroke-width="1.7" />

                        <rect
                            x="13"
                            y="13"
                            width="7"
                            height="7"
                            rx="1"
                            stroke="currentColor"
                            stroke-width="1.7" />

                        <path
                            d="M11 7.5H13"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                        <path
                            d="M16.5 11V13"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Job status tracking
                    </h4>

                    <p>
                        See pending, in-progress and
                        completed work at a glance.
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
                        Weight reconciliation
                    </h4>

                    <p>
                        Balance finished goods, scrap, loss
                        and metal due.
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
                            d="M6 3H18V21H6V3Z"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linejoin="round" />

                        <path
                            d="M9 7H15"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                        <path
                            d="M9 10H15"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                        <path
                            d="M9 13H15"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                        <path
                            d="M9 16H13"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round" />

                    </svg>

                </div>

                <div class="jn-feature-content">

                    <h4>
                        Labour costing
                    </h4>

                    <p>
                        Calculate job charges by piece,
                        weight or agreed method.
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

        <div class="jn-how-timeline" aria-label="Job work workflow">

            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">1</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Create job
                    </h3>

                    <p class="jn-how-step-description">
                        Add design, quantity, due date and karigar details.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">2</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Issue metal
                    </h3>

                    <p class="jn-how-step-description">
                        Record gross, purity and fine-weight movement.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">3</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Track production
                    </h3>

                    <p class="jn-how-step-description">
                        Update stages and monitor due work.
                    </p>
                </div>

            </article>


            <article class="jn-how-step jn-reveal-up">

                <div class="jn-how-number">4</div>

                <div>
                    <h3 class="jn-how-step-title">
                        Receive &amp; settle
                    </h3>

                    <p class="jn-how-step-description">
                        Reconcile goods, scrap, loss and labour.
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
                            <span>Complete metal accountability</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Accurate labour costs</span>
                        </div>

                    </div>


                    <!-- Column 02 -->
                    <div class="col-md-6 col-12">

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Fewer overdue jobs</span>
                        </div>

                        <div class="business-benefit-item">
                            <i class="bi bi-check2"></i>
                            <span>Faster karigar settlement</span>
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
            <h1>Product interface The right information, ready when your team needs it.</h1>
            <p>
                A focused karigar workboard workspace keeps transactions, exceptions and results easy to understand.
            </p>
        </div>

        <!-- Dashboard Image -->
        <div class="dashboard-image-wrapper">
            <img
                src="{{ asset('front_assets/img/solutions/karigar.jpg') }}"
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
                    <i class="bi bi-briefcase"></i>
                </div>

                <div class="jewel-related-content">

                    <h3>
                        Purchase Management
                    </h3>

                    <p>
                        Record vendor purchases, metal receipts and inward stock
                        with full traceability.
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