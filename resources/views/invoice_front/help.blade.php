@extends('invoice_front.includes.app')

@section('content')

<section class="jewel-terms-banner">
    <div class="jewel-terms-circle"></div>
    <div class="jewel-terms-glow"></div>

    <div class="container jewel-terms-container">

        <!-- Breadcrumb -->
        <nav class="jewel-terms-breadcrumb" aria-label="breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span>/</span>
            <!-- <a href="#">Help &amp; Policies</a>
            <span>/</span> -->
            <span class="active">Help &amp; Center</span>
        </nav>

        <!-- Banner Content -->
        <div class="jewel-terms-content">

            <div class="jewel-terms-icon">
                <i class="bi bi-shield-check"></i>
            </div>

            <span class="jewel-terms-label">Support resources</span>

            <h2>Help &amp; Center</h2>

            <p>
                Practical guidance to help you set up, manage, and get more from your jewelerp workspace. </p>

        </div>
    </div>
</section>

<section class="jewel-help-page">
    <div class="container jewel-help-container">
        <div class="row">

            <!-- Left Sidebar -->
            <div class="col-lg-3 col-xl-3">
                <aside class="jewel-help-sidebar">

                    <h5 class="jewel-help-sidebar-title">
                        On this page
                    </h5>

                    <div class="jewel-help-sidebar-line"></div>

                    <nav class="jewel-help-navigation">
                        <a href="#getting-started" class="jewel-help-nav-link">
                            <span>01</span>
                            <p>Getting started
</p>
                        </a>
  <a href="#using-jewelryerp" class="jewel-help-nav-link">
                            <span>02</span>
                            <p>Using JewelryERP
</p>
                        </a>
                          <a href="#faq" class="jewel-help-nav-link">
                            <span>03</span>
                            <p>Frequently asked questions
</p>
                        </a>
                          <a href="#technical-support" class="jewel-help-nav-link">
                            <span>04</span>
                            <p>Technical support</p>
                        </a>

                    </nav>

                    <div class="jewel-help-sidebar-line jewel-help-bottom-line"></div>

                    <!-- <a href="#" class="jewel-help-back-link">
                        <i class="fas fa-arrow-left"></i>
                        <span>All help &amp; policies</span>
                    </a> -->

                </aside>
            </div>

            <!-- Right Content -->
            <div class="col-lg-9 col-xl-9">
                <main class="jewel-help-main">

                    <!-- Page Header -->
                    <div class="jewel-help-header">
                        <span>Help resources</span>
                        <span>4 SECTIONS</span>
                    </div>

                    <div class="jewel-help-header-line"></div>

                    <!-- Information Alert -->
                    <!-- <div class="jewel-help-alert">
                        <i class="far fa-question-circle"></i>

                        <p>
                            Guidance may vary depending on your JewelryERP plan,
                            permissions, and workspace configuration.
                        </p>
                    </div> -->

                    <!-- Section 01 -->
                    <section id="getting-started"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">01</div>

                        <div class="jewel-help-section-content">
                            <h2>Getting started</h2>

                            <p class="jewel-help-description">
                                Start by confirming your business profile, user access, and core workspace settings. Your account administrator can manage team permissions and business information.
                            </p>


                            <div class="row jewel-help-bullet-row">

                                <div class="col-md-6">
                                    <ul class="jewel-help-bullet-list">
                                        <li>Review business and tax settings</li>
                                        
                                        <li>Confirm roles and access permissions</li>
                                    </ul>
                                </div>

  <div class="col-md-6">
                                    <ul class="jewel-help-bullet-list">
                                        <li>Invite authorised team members</li>
                                        <li>Prepare product and inventory information</li>
                                    </ul>
                                </div>

                            </div>





                        </div>
                    </section>
                    <section id="using-jewelryerp"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">02</div>

                        <div class="jewel-help-section-content">
                            <h2>Using JewelryERP</h2>

                            <p class="jewel-help-description">Jewelerp brings key jewellery business workflows into one
                                connected workspace. Use the navigation in your account to access the features included in your plan.
                            </p>


                            <div class="row jewel-help-bullet-row">

                                <div class="col-md-6">
                                    <ul class="jewel-help-bullet-list">
                                        <li>Manage products and inventory
                                        </li>
                                        <li>Review reports and business performance
                                    </ul>
                                </div>

  <div class="col-md-6">
                                    <ul class="jewel-help-bullet-list">
                                        <li>Track purchasing and sales activity
                                        </li>
                                        <li>Maintain customer and supplier records

                                    </ul>
                                </div>

                            </div>





                        </div>
                    </section>



                    <section id="faq"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">03</div>

                        <div class="jewel-help-section-content">
                            <h2>Frequently asked questions</h2>

                            <p class="jewel-help-description">For account-specific questions, check with your workspace
                                administrator first. They can confirm your access level and the workflows configured for your business.</p>

                            <div class="row jewel-help-bullet-row">

                                <div class="col-md-6">
                                    <ul class="jewel-help-bullet-list">
                                        <li>Why can’t I access a feature?</li>
                                        <li>Where can I review billing details?</li>
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <ul class="jewel-help-bullet-list">
                                        <li>How do I update company information?
                                        </li>
                                        <li>How do I report a technical issue?

                                    </ul>
                                </div>

                            </div>




                        </div>
                    </section>
                    <section id="technical-support"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">04</div>

                        <div class="jewel-help-section-content">
                            <h2>Technical support</h2>

                            <p class="jewel-help-description">When requesting support, describe what you were trying to do, what happened, and any steps that reproduce the issue. Screenshots can be helpful when they do not contain sensitive information.</p>
                            <p class="jewel-help-description">Never share your password, full payment credentials, or other confidential authentication information in a support request.</p>
                        </div>
                    </section>

                </main>
            </div>

        </div>
    </div>
</section>
<section class="jewel-help-section">
    <div class="container jewel-help-container">

        <div class="jewel-help-heading">
            <span class="jewel-help-eyebrow">CONTINUE READING</span>
            <h2>Related help &amp; policies</h2>
        </div>

        <div class="row g-0 jewel-help-grid">

            <!-- Privacy Policy -->
            <div class="col-12 col-md-4 jewel-help-column">
                <a href="{{ url('/privacy-policy') }}"
                   class="jewel-help-card">
                    <i class="bi bi-shield-check jewel-help-icon"></i>

                    <div class="jewel-help-card-bottom">
                        <span>Privacy Policy</span>
                    </div>
                </a>
            </div>

            <!-- Refund & Cancellation Policy -->
            <div class="col-12 col-md-4 jewel-help-column">
                <a href="{{ url('/refund-and-cancellation') }}"
                   class="jewel-help-card">
                    <i class="bi bi-wallet2 jewel-help-icon"></i>

                    <div class="jewel-help-card-bottom">
                        <span>Refund &amp;<br> Cancellation Policy</span>
                    </div>
                </a>
            </div>

            <!-- Terms & Conditions -->
            <div class="col-12 col-md-4 jewel-help-column">
                <a href="{{ url('/terms-conditions') }}"
                   class="jewel-help-card">
                    <i class="bi bi-file-earmark-text jewel-help-icon"></i>

                    <div class="jewel-help-card-bottom">
                        <span>Terms &amp;<br> Conditions</span>
                        <!-- <i class="bi bi-arrow-right jewel-help-arrow"></i> -->
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>


<section class="jewel-support-banner">
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