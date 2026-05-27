<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sirsonite Solution Pvt. Ltd. Premium Redesigned Dashboard">
    <title>Sirsonite Solution Pvt. Ltd. - Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.png') }}">

    <!-- Existing head includes -->
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

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        
        <!-- Redesigned Header -->
        @include('layout.partials.newheader')

        <!-- Redesigned Sidebar -->
        @include('layout.partials.newsidebar')

        <!-- Content Area -->
        @yield('content')

        <!-- Component Modals (Preserved from mainlayout) -->
        @component('components.add-modal-popup')
        @endcomponent
        @component('components.edit-modal-popup')
        @endcomponent
        @component('components.modal-popup')
        @endcomponent
        
    </div>
    <!-- /Main Wrapper -->

    <!-- Existing script includes -->
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
