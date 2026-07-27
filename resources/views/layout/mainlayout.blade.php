<!DOCTYPE html>
@if (!Route::is(['index-two', 'index-three', 'index-four', 'index-five']))
    <html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
        data-sidebar-image="none">
@endif
@if (Route::is(['index-two', 'index-three', 'index-four', 'index-five']))
    <html lang="en">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="jewelERP provides clean Admin Templates for managing Sales, Payment, Invoice, Accounts and Expenses in HTML, Bootstrap 5, ReactJs, Angular, VueJs and Laravel.">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    {{-- <meta name="twitter:site" content="@dreamstechnologies">
    <meta name="twitter:title" content="Finance & Accounting Admin Website Templates | jewelERP">
    <meta name="twitter:description"
        content="jewelERP is a Sales, Invoices & Accounts Admin template for Accountant or Companies/Offices with various features for all your needs. Try Demo and Buy Now.">
    <meta name="twitter:image" content="/assets/img/jewelERP.jpg">
    <meta name="twitter:image:alt" content="jewelERP">

    <!-- Facebook -->
    <meta property="og:url" content="/">
    <meta property="og:title" content="Finance & Accounting Admin Website Templates | jewelERP">
    <meta property="og:description"
        content="jewelERP is a Sales, Invoices & Accounts Admin template for Accountant or Companies/Offices with various features for all your needs. Try Demo and Buy Now.">
    <meta property="og:image" content="/assets/img/jewelERP.jpg">
    <meta property="og:image:secure_url" content="/assets/img/jewelERP.jpg">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600"> --}}
    <title>JewelERP</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.png') }}">

    @include('layout.partials.head')

    <!-- Custom Redesign Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/new-dashboard.css') }}">

    <!-- Google Fonts Outfit and Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', 'Outfit', sans-serif !important;
        }
        .logo-text-main {
            font-family: 'Outfit', sans-serif !important;
        }
    </style>
</head>
@if (
    !Route::is([
        'chat',
        'mail-pay-invoice',
        'cashreceipt-1',
        'cashreceipt-2',
        'cashreceipt-3',
        'cashreceipt-4',
        'invoice-five',
        'invoice-four-a',
        'invoice-three',
        'invoice-two',
        'invoice-one-a', 'sell.invoice.view',
        'error-404',
    ]))

    <body>
@endif
@if (Route::is(['chat']))

    <body class="chat-page">
@endif
@if (Route::is(['mail-pay-invoice']))

    <body class="invoice-center-pay">
@endif
@if (Route::is([
        'cashreceipt-1',
        'cashreceipt-2',
        'cashreceipt-3',
        'cashreceipt-4',
        'invoice-five',
        'invoice-four-a',
        'invoice-three',
        'invoice-two',
        'invoice-one-a', 'sell.invoice.view',
    ]))

    <body class="no-stickybar">
@endif
@if (Route::is(['error-404']))

    <body class="error-page">
@endif
<!-- Main Wrapper -->
@if (
    !Route::is([
        'index-five',
        'mail-pay-invoice',
        'cashreceipt-1',
        'cashreceipt-2',
        'cashreceipt-3',
        'cashreceipt-4',
        'invoice-four-a',
        'invoice-one-a', 'sell.invoice.view',
        'invoice-three',
        'invoice-two',
        'forgot-password',
        'lock-screen',
        'login',
        'register',
    ]))
    <div class="main-wrapper">
@endif
@if (Route::is(['invoice-four-a']))
    <div class="main-wrapper invoice-four">
@endif
@if (Route::is(['invoice-one-a']))
    <div class="main-wrapper invoice-one">
@endif
@if (Route::is(['sell.invoice.view']))
    <div class="main-wrapper invoice-one">
@endif
@if (Route::is(['invoice-three']))
    <div class="main-wrapper invoice-three">
@endif
@if (Route::is(['invoice-two']))
    <div class="main-wrapper invoice-two">
@endif
@if (Route::is(['index-five']))
    <div class="main-wrapper container">
@endif
@if (Route::is(['forgot-password', 'lock-screen', 'login', 'register']))
    <div class="main-wrapper login-body">
@endif
@if (
    !Route::is([
        'signature-preview-invoice',
        'mail-pay-invoice',
        'pay-online',
        'login',
        'register',
        'saas-login',
        'invoice-subscription',
        'saas-register',
        'forgot-password',
        'lock-screen',
        'error-404',
        'invoice-one-a', 'sell.invoice.view',
        'invoice-two',
        'invoice-three',
        'invoice-four-a',
        'invoice-five',
        'cashreceipt-1',
        'cashreceipt-2',
        'cashreceipt-3',
        'cashreceipt-4',
    ]))
    @include('layout.partials.newheader')
@endif
@if (Route::is(['index-three']))
    <div class="container">
@endif
@if (
    !Route::is([
        'signature-preview-invoice',
        'mail-pay-invoice',
        'pay-online',
        'login',
        'register',
        'saas-login',
        'invoice-subscription',
        'saas-register',
        'forgot-password',
        'lock-screen',
        'error-404',
        'invoice-one-a', 'sell.invoice.view',
        'invoice-two',
        'invoice-three',
        'invoice-four-a',
        'invoice-five',
        'cashreceipt-1',
        'cashreceipt-2',
        'cashreceipt-3',
        'cashreceipt-4',
    ]))
    @include('layout.partials.newsidebar')
@endif
@if (Route::is(['index-four']))
    @include('layout.partials.two-col-sidebar')
@endif
@yield('content')
@if (Route::is(['index-three']))
    </div>
@endif
@component('components.add-modal-popup')
@endcomponent
@component('components.edit-modal-popup')
@endcomponent
@component('components.modal-popup')
@endcomponent
@if (!Route::is(['mail-pay-invoice', 'cashreceipt-1', 'cashreceipt-2', 'cashreceipt-3', 'cashreceipt-4']))
    </div>
@endif
<!-- /Main Wrapper -->
@if (
    !Route::is([
        'index-two',
        'index-three',
        'index-four',
        'index-five',
        'signature-preview-invoice',
        'mail-pay-invoice',
        'pay-online',
        'login',
        'register',
        'saas-login',
        'invoice-subscription',
        'saas-register',
        'forgot-password',
        'lock-screen',
        'error-404',
        'invoice-one-a', 'sell.invoice.view',
        'invoice-two',
        'invoice-three',
        'invoice-four-a',
        'invoice-five',
        'cashreceipt-1',
        'cashreceipt-2',
        'cashreceipt-3',
        'cashreceipt-4',
    ]))
    @include('layout.partials.theme-settings')
@endif

@include('layout.partials.footer-scripts')
@yield('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar Toggle Logic
        var toggleBtn = document.getElementById('toggle_btn_new');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                document.body.classList.toggle('mini-sidebar');
            });
        }

        // Dark Mode Theme Toggle Logic
        var themeBtn = document.getElementById('theme_toggle_btn');
        var themeIcon = document.getElementById('theme_icon');

        // Check saved theme
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            if(themeIcon) {
                themeIcon.classList.replace('fe-moon', 'fe-sun');
            }
        }

        if (themeBtn) {
            themeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                document.body.classList.toggle('dark-mode');

                if (document.body.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                    if(themeIcon) themeIcon.classList.replace('fe-moon', 'fe-sun');
                } else {
                    localStorage.setItem('theme', 'light');
                    if(themeIcon) themeIcon.classList.replace('fe-sun', 'fe-moon');
                }
            });
        }
    });
</script>
</body>

</html>
