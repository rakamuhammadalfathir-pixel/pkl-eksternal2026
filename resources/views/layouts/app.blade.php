<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>@yield('title') | E-Perpustakaan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f5fa; }
        .content-wrapper { padding-top: 100px !important; }
        .layout-navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.8) !important;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .hero-section {
            background: linear-gradient(135deg, #9055fd 0%, #696cff 100%);
            border-radius: 1.5rem; 
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(105, 108, 255, 0.3);
            margin-bottom: 3rem;
        }
        .category-card {
            border: none !important;
            border-radius: 1rem;
            transition: all 0.3s ease;
            background: #fff;
            box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
        }
        .category-card:hover {
            transform: translateY(-5px);
            background: #696cff !important;
        }
        .category-card:hover h6, .category-card:hover small, .category-card:hover i { color: #fff !important; }
        .book-card {
            border: none;
            border-radius: 1rem;
            transition: all 0.3s ease-in-out;
            background: #fff;
            box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
        }
        .book-card:hover { transform: translateY(-8px); box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important; }
        .btn-rounded { border-radius: 50px; }
        .layout-page { padding: 0 !important; }
    </style>
    @yield('page-style')
</head>

<body>
    <div class="layout-wrapper layout-navbar-full">
        <div class="layout-container">
            <div class="layout-page">
                @include('layouts.partials.navbar-landing')

                <div class="content-wrapper">
                    @yield('content')
                    
                    @include('layouts.partials.footer')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    @yield('page-script')
</body>
</html>