<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title') | E-Perpustakaan</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

    <style>
        .app-brand img { max-width: 80px; margin-bottom: 1rem; }
        .authentication-inner { max-width: 450px !important; }
        .authentication-wrapper.authentication-basic::before,
        .authentication-wrapper.authentication-basic::after,
        .authentication-basic .authentication-inner::before,
        .authentication-basic .authentication-inner::after {
            content: none !important;
            display: none !important;
        }
        .btn-primary { box-shadow: 0 4px 14px 0 rgba(105, 108, 255, 0.39); }
    </style>
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center flex-column">
                            <a href="/" class="app-brand-link mb-2">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                            </a>
                            <span class="app-brand-text demo text-body fw-bolder text-uppercase">E-Perpus 2026</span>
                        </div>
                        
                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>