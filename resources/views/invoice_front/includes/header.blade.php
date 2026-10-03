<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N6CW287C');</script>
    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C4QM92C4F0"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-C4QM92C4F0');
    </script>

    <!-- Google Search Console Tag -->
    <meta name="google-site-verification" content="aImL4VfsnEbx_ydFj2X-yhz_TpQxsgsGkZhq7HAELTA" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', $title ?? 'Jewellery ERP Software in India | Billing, Inventory & Purchase Management')</title>

    @if(View::hasSection('meta_description') || isset($meta_description))
    <meta name="description" content="@yield('meta_description', $meta_description ?? '')">
    @elseif(View::hasSection('description') || isset($description))
    <meta name="description" content="@yield('description', $description ?? '')">
    @endif

    @if(View::hasSection('meta_keywords') || isset($meta_keywords))
    <meta name="keywords" content="@yield('meta_keywords', $meta_keywords ?? '')">
    @elseif(View::hasSection('keywords') || isset($keywords))
    <meta name="keywords" content="@yield('keywords', $keywords ?? '')">
    @endif

    @if(View::hasSection('canonical') || isset($canonical))
    <link rel="canonical" href="@yield('canonical', $canonical ?? '')">
    @endif

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front_assets/img/fabicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('front_assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N6CW287C"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
