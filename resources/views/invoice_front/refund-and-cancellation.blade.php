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
            <span class="active">Refund & Cancellation Policy</span>
        </nav>

        <!-- Banner Content -->
        <div class="jewel-terms-content">

            <div class="jewel-terms-icon">
                <i class="bi bi-shield-check"></i>
            </div>

            <span class="jewel-terms-label">Policies made simple</span>

            <h2>Refund & Cancellation Policy</h2>

            <p>
                Straightforward terms, no confusing fine print. Here’s everything you need to know about cancelling your JewelERP plan or requesting a refund. </p>

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
                            <p>Customer Satisfaction First</p>
                        </a>

                         <a href="#getting-started" class="jewel-help-nav-link">
                            <span>02</span>
                            <p>Cancellation Policy</p>
                        </a>
                        
                       <a href="#getting-started" class="jewel-help-nav-link">
                            <span>03</span>
                            <p>Refund Policy</p>
                        </a>

                        
                    </nav>

                    <div class="jewel-help-sidebar-line jewel-help-bottom-line"></div>

                  

                </aside>
            </div>

            <!-- Right Content -->
            <div class="col-lg-9 col-xl-9">
                <main class="jewel-help-main">

                    <!-- Page Header -->
                    <div class="jewel-help-header">
                        <span>Policy overview</span>
                        <span>1 SECTIONS</span>
                    </div>

                    <div class="jewel-help-header-line"></div>

                  
                    <!-- Section 01 -->
                    <section id="getting-started"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">01</div>

                        <div class="jewel-help-section-content">
                            <h2>Customer Satisfaction First
</h2>

                            <p class="jewel-help-description">At Sirsonite Solutions Pvt. Ltd.(Jewelerp)   
                                , we prioritize your satisfaction. Before any purchase, we provide a
                                 free demo of our software to help you thoroughly understand its features and
                                  functionality.                   </p>



                            <p class="jewel-help-description"> For businesses needing customizations, all requirements are discussed in detail before finalizing the purchase. Any additional costs and delivery timelines are communicated and mutually agreed upon in advance.

</p>




                        </div>
                    </section>


                    <section id="getting-started"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">02</div>

                        <div class="jewel-help-section-content">
                            <h2>Cancellation Policy</h2>

                          
 <ul class="jewel-help-bullet-list">
                    <li>To request a cancellation, please contact us through the "Contact Us" page.

                    </li>
                    <li>Cancellation of ongoing services is only applicable after the end of the agreed contract period.

                    </li>
                    <li>Mid-term cancellations are not permitted unless explicitly stated in the agreement.

                    </li>
                </ul>


                        </div>
                    </section>


                    <section id="getting-started"
                        class="jewel-help-content-section">

                        <div class="jewel-help-number">03</div>

                        <div class="jewel-help-section-content">
                            <h2>Refund Policyy</h2>


 <p class="jewel-help-description">Once the software is installed and activated, no refunds will be issued due to the following reasons:

</p>

                            <ul class="jewel-help-bullet-list">
                    <li>A free demo is provided before purchase, allowing users to evaluate the software thoroughly.


                    </li>
                    <li>All customizations are executed based on pre-approved discussions and client consent.
tract period.

                    </li>
                    <li>Future business-specific changes or enhancements can be requested separately, but they do not qualify for a refund.

                    </li>
                </ul>
 <p class="jewel-help-description"><strong>Note:</strong>  If you have any concerns, we encourage you to reach out to our support team. We're here to help and ensure you get the most value from your software.

</p>

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
                <a href="{{ url('/privacy-policy.') }}"
                   class="jewel-help-card">
                    <i class="bi bi-wallet2 jewel-help-icon"></i>

                    <div class="jewel-help-card-bottom">
                        <span>Privacy  &amp; Policy </span>
                    </div>
                </a>
            </div>

            <!-- Terms & Conditions -->
            <div class="col-12 col-md-4 jewel-help-column">
                <a href="{{ url('/terms-conditions') }}"
                    class="jewel-help-card">
                    <i class="bi bi-file-earmark-text jewel-help-icon"></i>

                    <div class="jewel-help-card-bottom">
                        <span>Terms &amp; Conditions</span>
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