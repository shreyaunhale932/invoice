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
            <span class="active">Terms &amp; Conditions</span>
        </nav>

        <!-- Banner Content -->
        <div class="jewel-terms-content">

            <div class="jewel-terms-icon">
                <i class="bi bi-file-earmark-text"></i>
            </div>

            <span class="jewel-terms-label">SERVICE TERMS</span>

            <h2>Terms &amp; Conditions</h2>

            <p>
                A clear overview of the responsibilities and conditions
                associated with using Jewelerp.
            </p>

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
                        <a href="#definitions" class="jewel-help-nav-link">
                            <span>01</span>
                            <p>Definitions</p>
                        </a>

                      <a href="#general-usage-rules" class="jewel-help-nav-link">
                            <span>02</span>
                            <p>General Usage Rules</p>
                        </a>

                        <a href="#use-of-content" class="jewel-help-nav-link">
                            <span>03</span>
                            <p>Use of Content</p>
                        </a>

                        <a href="#acceptable-website-use" class="jewel-help-nav-link">
                            <span>04</span>
                            <p>Acceptable Website Use</p>
                        </a>
                        <a href="#indemnity" class="jewel-help-nav-link">
                            <span>05</span>
                            <p>Indemnity</p>
                        </a>
                        <a href="#limitation-of-liability" class="jewel-help-nav-link">
                            <span>06</span>
                            <p>Limitation of Liability</p>
                        </a>
                        <a href="#disclaimer" class="jewel-help-nav-link">
                            <span>07</span>
                            <p>Disclaimer</p>
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
                        <span>Terms overview</span>
                        <span>7 SECTIONS</span>
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
                    <section id="definitions"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">01</div>

                        <div class="jewel-help-section-content">
                            <h2>Definitions</h2>

                            <p class="jewel-help-description"> Company", "We", "Us", "Our" refer to Sirsonite Solutions Pvt. Ltd.(Jewelerp)  

                            </p>
                            <p class="jewel-help-description">"User", "You", "Your" refers to any individual visiting or using this website.

                            </p>
                            <p class="jewel-help-description">By accessing or using our website (www.jewelerp.in), you agree to be legally bound by these Terms. If you do not agree, please discontinue use

                            </p>
                            <p class="jewel-help-description"> Sirsonite Solutions Pvt. Ltd.(Jewelerp)   reserves the right to update or modify these Terms at any time without prior notice. Continued use of the site constitutes your acceptance of the updated Terms.

                            </p>
                        </div>


                    </section>



                    <!-- Section 02 -->
                    <section id="general-usage-rules"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">02</div>

                        <div class="jewel-help-section-content">
                            <h2> General Usage Rules

                            </h2>

                            <p class="jewel-help-description">We offer software services only. Any hardware (e.g., system, printer, barcode scanner, etc.) must be purchased separately by the customer.

                            </p>
                            <p class="jewel-help-description">Only licensed operating systems (e.g., Windows, Microsoft Office) and antivirus software should be used.

                            </p>
                            <p class="jewel-help-description"> Software updates are provided free of charge during the active license period.

                            </p>
                            <p class="jewel-help-description">All support, training, and services are delivered online. The customer must ensure proper internet connectivity and remote access tools (e.g., AnyDesk, TeamViewer).

                            </p>
                            <p class="jewel-help-description"> Data backup is solely your responsibility. We are not liable for data loss due to system crashes, theft, viruses, or other technical issues.

                            </p>
                            <p class="jewel-help-description"> Fresh software may be reinstalled under an active license only; no guarantee for lost data.

                            </p>
                            <p class="jewel-help-description">Any additional features, customization, or changes requested will be chargeable and mutually agreed upon.

                            </p>
                            <p class="jewel-help-description">The software interface design and layout are fixed and not subject to modification.

                            </p>
                            <p class="jewel-help-description">Use of the software is restricted to the licensed number of systems. Unauthorized use may result in termination of the license.

                            </p>
                            <p class="jewel-help-description">The software license is non-returnable, non-refundable, and non-transferable.

                            </p>
                            <p class="jewel-help-description">Annual Maintenance Charges (AMC) apply after the first year at 15% of the software cost and include support, training, and services.

                            </p>
                            <p class="jewel-help-description"> All dues must be cleared within 30 days. Non-payment may result in license termination, after which reactivation will require a new license purchase.

                            </p>
                            <p class="jewel-help-description"> Any misconduct, abuse, or threats towards our team will lead to strict action.

                            </p>
                            <p class="jewel-help-description"> Sirsonite Solutions Pvt. Ltd.(Jewelerp)  reserves the right to update or modify the software without prior notice.

                            </p>
                            <p class="jewel-help-description"> We follow all applicable laws and policies. Any illegal activity by the user will result in immediate termination without liability on our part.

                            </p>

                        </div>


                    </section>




                    <!-- Section 03 -->
                    <section id="use-of-content"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">03</div>

                        <div class="jewel-help-section-content">
                            <h2> Use of Content
                            </h2>

                            <p class="jewel-help-description">All content on this site (logos, graphics, names, code, etc.) is owned by or licensed to Sirsonite Solutions Pvt. Ltd.(Jewelerp)  You may not copy, modify, reproduce, or distribute any content for commercial or public use without our written permission.

                            <p>

                        </div>


                    </section>



                    <section id="acceptable-website-use"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">04

                        </div>

                        <div class="jewel-help-section-content">
                            <h2> Acceptable Website Use

                            </h2>
                            <h4>A. Security
                            </h4>
                            <p class="jewel-help-description">Users must not:

                            <p>


                            <div class="row jewel-help-bullet-row">



                                <div class="col-md-6">
                                    <ul class="jewel-help-bullet-list">
                                        <li>Access unauthorized data or accounts
                                        </li>
                                        <li>Attempt to breach security or scan system vulnerabilities

                                        </li><li>Send unsolicited marketing emails

                                        </li>
                                        <li>Disrupt site services (e.g., upload viruses, perform DDoS attacks)

                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <p class="jewel-help-description">Such actions may lead to civil/criminal liability and legal action.

                            </p>
                            <h4>B. General Conduct
                            </h4>
                            <p class="jewel-help-description">Users must not upload or distribute content that:



                            <p>


                            <div class="row jewel-help-bullet-row">



                                <div class="col-md-6">
                                    <ul class="jewel-help-bullet-list">
                                        <li>Violates laws or third-party rights

                                        </li>
 <li>Is defamatory, obscene, threatening, or hateful</li>


                                    </ul>
                                    
                                </div>
 
                            </div>
                        </div>


                    </section>

                    <section id="indemnity"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">05

                        </div>

                        <div class="jewel-help-section-content">
                            <h2> Indemnity
                            </h2>

                            <p class="jewel-help-description">By using this website, you agree to take full responsibility for your actions. If you break any rules, misuse the site, or do something that causes a problem, and someone blames or takes action against Sirsonite Solutions Pvt. Ltd.(jewelerp), its employees, or partners because of what you did, you promise to protect us. This means you will handle the situation, cover any costs or losses, and make sure we don't get into trouble because of your mistake.


                            <p>

                        </div>


                    </section>


                    <section id="limitation-of-liability"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">06

                        </div>

                        <div class="jewel-help-section-content">
                            <h2> Limitation of Liability

                            </h2>

                            <p class="jewel-help-description">We shall not be liable for any direct, indirect, incidental, or consequential damages arising from:


                            <p>
                            <div class="row jewel-help-bullet-row">



                                <div class="col-md-6">
                                    <ul class="jewel-help-bullet-list">
                                        <li>Use or inability to use our services


                                        </li>
                                        <li>Unauthorized access or data alteration</li>
                                         <li>Loss of data, profits, or business opportunities
                                        </li>


                                        </p>


                                    </ul>
                                </div>   
                                                            
                                        <p class="jewel-help-description">Even if we've been advised of the possibility of such damages, our total liability shall not exceed the amount paid by you for the services.

                            </div>


                    </section>

                    <section id="disclaimer"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">07

                        </div>

                        <div class="jewel-help-section-content">
                            <h2> Disclaimer
                            </h2>

                            <p class="jewel-help-description">Sirsonite Solutions Pvt. Ltd.(Jewelerp)  and associated entities are not liable for any damages (including loss of data or business interruption) arising from your use of the website or its materials.


                            <p>

                        </div>


                    </section>

                    <section id="getting-started"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">

                        </div>

                        <div class="jewel-help-section-content">
                            <h2>Thank You



                            </h2>

                            <p class="jewel-help-description">We appreciate your cooperation and look forward to providing you with the best service.


                            <p>

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
                <a href="{{ url('/help') }}"
                   class="jewel-help-card">
                    <i class="bi bi-shield-check jewel-help-icon"></i>

                    <div class="jewel-help-card-bottom">
                        <span>Help Center</span>
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
                <a href="{{ url('/privacy-policy') }}"
                   class="jewel-help-card">
                    <i class="bi bi-file-earmark-text jewel-help-icon"></i>

                    <div class="jewel-help-card-bottom">
                       <span>Privacy Policy</span>
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
    @include('invoice_front.includes.ai-tools')
@endsection