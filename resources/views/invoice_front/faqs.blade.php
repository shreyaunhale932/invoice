@extends('invoice_front.includes.app')

@section('content')

<section class="jewel-faq-section">
    <img class="jewel-faq-decoration jewel-faq-decoration-top"
        src="{{ asset('front_assets/img/icons/4.svg') }}"
        alt="" aria-hidden="true">
    <img class="jewel-faq-decoration jewel-faq-decoration-left"
        src="{{ asset('front_assets/img/icons/5.svg') }}"
        alt="" aria-hidden="true">

    <div class="container-fluid jewel-faq-container">

        <!-- Heading -->
        <h1 class="jewel-faq-title">
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
        (object) [
        'id' => 'default-5',
        'question' => 'Can I manage multiple branches with JEWELERP?',
        'answer' => 'Yes, the Multi-Branch version of JEWELERP allows centralised control over all your store locations, including stock transfers, sales reports, and customer management from a single dashboard.',
        ],
        (object) [
        'id' => 'default-6',
        'question' => 'How does JEWELERP help manage repairs and custom orders?',
        'answer' => 'The Retail Jewellers version includes a dedicated module to track repair and custom orders from booking to delivery, with automated reminders and progress updates to keep your customers informed.',
        ],
        (object) [
        'id' => 'default-7',
        'question' => 'Can JEWELERP handle karigar (artisan) management?',
        'answer' => 'Yes, the manufacturer\'s version includes features to assign job cards, track material usage, calculate wages, and monitor karigar productivity to optimise manufacturing workflows.',
        ],
        (object) [
        'id' => 'default-8',
        'question' => 'Does JEWELERP provide mobile access?',
        'answer' => 'We are continuously evolving our platform to support mobile and remote access. Currently, some features are accessible through mobile-friendly interfaces, with plans to enhance mobile app capabilities soon.',
        ],
        (object) [
        'id' => 'default-9',
        'question' => 'How secure is my data with JEWELERP?',
        'answer' => 'We prioritise your data security using advanced encryption, regular backups, and secure login protocols to ensure your business information is safe and confidential.',
        ],
        (object) [
        'id' => 'default-10',
        'question' => 'What kind of customer support do you offer?',
        'answer' => 'Our dedicated support team is available via phone, WhatsApp, and email to assist you with setup, troubleshooting, and ongoing queries. We also offer training sessions and detailed user manuals.',
        ],
        (object) [
        'id' => 'default-11',
        'question' => 'Can JEWELERP integrate with other software or accounting systems?',
        'answer' => 'Currently, JEWELERP is a standalone system tailored for jewellery businesses. We are working on integrations with popular accounting and financial software to further enhance your experience.',
        ],
        (object) [
        'id' => 'default-12',
        'question' => 'How do I get started with JEWELERP?',
        'answer' => 'Simply contact us via phone or WhatsApp to schedule a free demo. Our experts will understand your business needs and guide you through the implementation process.',
        ],
        (object) [
        'id' => 'default-13',
        'question' => 'Is there a trial version available?',
        'answer' => 'We offer a demo to showcase the features and benefits of JEWELERP. Contact us to learn about any trial offers or pilot programs.',
        ],
        (object) [
        'id' => 'default-14',
        'question' => 'How often is JEWELERP updated?',
        'answer' => 'We regularly update our software to incorporate new features, improve performance, and comply with regulatory changes such as GST updates.',
        ],
        (object) [
        'id' => 'default-15',
        'question' => 'Can JEWELERP help with money lending or gold loan management?',
        'answer' => 'Yes, the Money Lenders version is designed specifically for jewellery businesses that provide gold loans. It manages pawn tickets, interest calculations, and customer reminders efficiently.',
        ],
        (object) [
        'id' => 'default-16',
        'question' => 'Do you offer Annual Maintenance Contracts (AMC)?',
        'answer' => 'Yes, we provide AMC packages to ensure your JEWELERP software is always updated, secure, and running smoothly. AMC includes regular updates, technical support, and priority issue resolution. Contact us for detailed AMC plans and pricing.',
        ],
        (object) [
        'id' => 'default-17',
        'question' => 'Is customisation available for JEWELERP?',
        'answer' => 'Absolutely! We understand that every jewellery business has unique requirements. Our team can customise modules, reports, and workflows to align perfectly with your business processes. Discuss your specific needs with us to get a tailored solution.',
        ],
        ]);
        @endphp

        <div class="row g-4 align-items-start">

            <!-- FAQ Accordion -->
            <div class="col-12 col-lg-8">
                <div class="accordion jewel-faq-accordion" id="jewelFaqAccordion">
                    @forelse ($displayFaqs as $faq)
                    <div class="accordion-item jewel-faq-item">
                        <h3 class="accordion-header" id="faq-heading-{{ $faq->id }}">
                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}"
                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                aria-controls="faq-{{ $faq->id }}">
                                {{ $faq->question }}
                            </button>
                        </h3>
                        <div id="faq-{{ $faq->id }}"
                            class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                            aria-labelledby="faq-heading-{{ $faq->id }}"
                            data-bs-parent="#jewelFaqAccordion">
                            <div class="accordion-body">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">FAQs will be available soon.</p>
                    @endforelse
                </div>
            </div>






            <!-- Contact Card -->
            <div class="col-12 col-lg-4">
                <div class="jewel-faq-contact-card">

                    <div class="jewel-faq-message-icon">
                        <i class="bi bi-chat-left-fill"></i>
                    </div>

                    <h5>Do you have more questions?</h5>

                    <p>
                        End-to-end payment and financial management
                        in a single solution. Meet the right platform
                        for your business.
                    </p>
                    <a href="mailto:support@jewelerp.in" class="jewel-faq-contact-btn">
                        Shoot A Direct Mail
                    </a>

                </div>
            </div>

        </div>
    </div>
</section>
@include('invoice_front.includes.ai-tools')
@endsection