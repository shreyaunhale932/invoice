<!DOCTYPE html>

<html lang="en">

<head>

    <!-- =========================
         Google Tag Manager
    ========================== -->
    <script>
        (function(w,d,s,l,i){
            w[l]=w[l]||[];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event:'gtm.js'
            });

            var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),
                dl=l!='dataLayer'?'&l='+l:'';

            j.async=true;
            j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;

            f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N6CW287C');
    </script>
    <!-- End Google Tag Manager -->


    <!-- =========================
         Google Analytics
    ========================== -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C4QM92C4F0"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-C4QM92C4F0');
    </script>
    <!-- End Google Analytics -->


    <!-- =========================
         Google Search Console
    ========================== -->
    <meta name="google-site-verification"
          content="aImL4VfsnEbx_ydFj2X-yhz_TpQxsgsGkZhq7HAELTA">


    <!-- =========================
         Basic Meta
    ========================== -->
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">


    <!-- =========================
         SEO
    ========================== -->

    <title>@yield('title', 'JewelERP')</title>

    <meta name="description"
          content="@yield('meta_description', 'Jewellery ERP software for billing, inventory, accounting and business management.')">

    <meta name="keywords"
          content="@yield('meta_keywords', 'jewellery ERP software, jewellery billing software, jewellery inventory software')">

    <link rel="canonical"
          href="@yield('canonical_url', url()->current())">


    <!-- =========================
         Favicon
    ========================== -->

    <link rel="shortcut icon"
          type="image/x-icon"
          href="{{ asset('front_assets/img/fabicon.png') }}">


    <!-- =========================
         Bootstrap CSS
    ========================== -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet">


    <!-- =========================
         Bootstrap JS
    ========================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- =========================
         Custom CSS
    ========================== -->

    <link rel="stylesheet"
          href="{{ asset('front_assets/css/style.css') }}">


    <!-- =========================
         jQuery
    ========================== -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- =========================
         Chart JS
    ========================== -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- =========================
         Roboto Font
    ========================== -->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
          rel="stylesheet">


    <!-- =========================
         Font Awesome
    ========================== -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- =========================
         Poppins Font
    ========================== -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
          rel="stylesheet">


    <!-- =========================
         Inter Font
    ========================== -->

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

</head>


<body>

    <!-- =========================
         Google Tag Manager (noscript)
    ========================== -->

    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N6CW287C"
                height="0"
                width="0"
                style="display:none;visibility:hidden">
        </iframe>
    </noscript>

    <!-- End Google Tag Manager (noscript) -->
