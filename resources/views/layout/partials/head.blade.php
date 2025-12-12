<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- bs-custom-file-input -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.3.4/bs-custom-file-input.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<!-- DataTables JS (Load After jQuery) -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons Extension -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>





    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/public/assets/css/bootstrap.min.css') }}">

    <!-- Font family -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ url('/public/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('/public/assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{ url('/public/assets/plugins/feather/feather.css') }}">

    @if (Route::is([
            'bus-ticket',
            'car-booking-invoice',
            'cashreceipt-1',
            'cashreceipt-2',
            'cashreceipt-3',
            'cashreceipt-4',
            'coffee-shop',
            'domain-hosting',
            'ecommerce',
            'fitness-center',
            'flight-booking',
            'General-invoice-1',
            'General-invoice-2',
            'General-invoice-3',
            'General-invoice-4',
            'General-invoice-5',
            'hotel-booking',
            'internet-billing',
            'invoice-five',
            'invoice-four-a',
            'invoice-four',
            'invoice-one-a',
            'invoice-one',
            'invoice-three',
            'invoice-two',
            'mail-pay-invoice',
            'medical',
            'moneyexchange',
            'movie-ticket-booking',
            'pay-online',
            'restuarent-billing',
            'signature-preview-invoice',
            'student-billing',
            'train-ticket-booking',
        ]))
        <link rel="stylesheet" href="{{ url('/public/assets/css/feather.css') }}">
    @endif

    @if (!Route::is(['index-two']))
        <!-- Datepicker CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/css/bootstrap-datetimepicker.min.css') }}">
    @endif

    @if (!Route::is(['index-two', 'companies']))
        <!-- Datatables CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/datatables/datatables.min.css') }}">
    @endif

    @if (Route::is(['companies']))
        <link rel="stylesheet" href="/public/assets/css/dataTables.bootstrap5.min.css">
    @endif

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ url('/public/assets/plugins/select2/css/select2.min.css') }}">

    @if (Route::is(['calendar']))
        <!-- Full Calander CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/fullcalendar/fullcalendar.min.css') }}">
    @endif

    @if (Route::is(['companies']))
        <!-- Mobile CSS-->
        <link rel="stylesheet" href="/public/assets/plugins/intltelinput/css/intlTelInput.css">
        <link rel="stylesheet" href="/public/assets/plugins/intltelinput/css/demo.css">
    @endif

    @if (Route::is(['add-customer', 'edit-customer', 'testimonials']))
        <!-- Mobile CSS-->
        <link rel="stylesheet" href="/public/assets/plugins/intltelinput/css/intlTelInput.css">
    @endif

    @if (Route::is(['plan-billing']))
        <!-- Owl carousel CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/css/owl.carousel.min.css') }}">
    @endif

    @if (Route::is(['lightbox', 'template-invoice']))
        <!-- Lightbox CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/lightbox/glightbox.min.css') }}">
    @endif

    @if (Route::is(['drag-drop', 'clipboard']))
        <!-- Dragula CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/dragula/css/dragula.min.css') }}">
    @endif

    @if (Route::is(['text-editor']))
        <!-- Summernote CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/summernote/summernote-bs4.min.css') }}">
    @endif

    @if (Route::is([
            'add-products',
            'all-blogs',
            'contact-details',
            'edit-products',
            'edit-units',
            'expenses',
            'pages',
            'inactive-blog',
            'email-template',
            'seo-settings',
            'saas-settings',
        ]))
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/summernote/summernote-lite.min.css') }}">
    @endif

    @if (Route::is(['icon-ionic']))
        <!-- Ionic CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/icons/ionic/ionicons.css') }}">
    @endif

    @if (Route::is(['icon-material']))
        <!-- Material CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/material/materialdesignicons.css') }}">
    @endif

    @if (Route::is(['icon-pe7']))
        <!-- Pe7 CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/icons/pe7/pe-icon-7.css') }}">
    @endif

    @if (Route::is(['icon-simpleline']))
        <!-- Simpleline CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/simpleline/simple-line-icons.css') }}">
    @endif

    @if (Route::is(['icon-themify']))
        <!-- Themify CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/icons/themify/themify.css') }}">
    @endif

    @if (Route::is(['icon-weather']))
        <!-- weathericons CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/icons/weather/weathericons.css') }}">
    @endif

    @if (Route::is(['icon-typicon']))
        <!-- typicons CSS typicon-->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/icons/typicons/typicons.css') }}">
    @endif

    @if (Route::is(['icon-flag']))
        <!-- flags CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/icons/flags/flags.css') }}">
    @endif

    @if (Route::is(['maps-vector']))
        <!-- Map CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}">
    @endif

    @if (Route::is(['chart-c3']))
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/c3-chart/c3.min.css') }}">
    @endif

    @if (Route::is(['stickynote']))
        <!-- Sticky CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/stickynote/sticky.css') }}">
    @endif

    @if (Route::is(['notification']))
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/alertify/alertify.min.css') }}">
    @endif

    @if (Route::is(['scrollbar']))
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/scrollbar/scroll.min.css') }}">
    @endif

    @if (Route::is(['rangeslider']))
        <!-- Rangeslider CSS -->
        <link rel="stylesheet" href="{{ url('/public/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }}">
    @endif

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ url('/public/assets/css/style.css') }}">

    @if (!Route::is(['index-two', 'index-three', 'index-four', 'index-five']))
        <!-- Layout JS -->
        <script src="{{ url('/public/assets/js/layout.js') }}"></script>
    @endif
