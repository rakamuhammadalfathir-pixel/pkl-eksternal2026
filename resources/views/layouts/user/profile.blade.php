<!DOCTYPE html>
<html lang="en" class="light-style layout-without-menu" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('/assets/') }}/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title') | MyLibrary</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    
    <style>
        body { 
            background-color: #f5f5f9; 
            padding-top: 80px !important; 
        }
        
        .card {
            border-radius: 15px;
        }

        /* Efek hover pada input */
        .form-control:focus {
            border-color: #696cff;
            box-shadow: 0 0 0 0.2rem rgba(105, 108, 255, 0.1);
        }

        /* Mengatur avatar agar tetap bundar dan rapi */
        #uploadedAvatar {
            object-fit: cover;
            background-color: #fff;
            z-index: 1;
        }

        .mt-n5 {
            margin-top: -5rem !important;
        }

        /* Animasi saat tombol ditekan */
        .btn-primary {
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(105, 108, 255, 0.4) !important;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }

        .form-control-lg {
            font-size: 0.95rem;
        }
    </style>

    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/js/config.js') }}"></script>
    @yield('page-style')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
        <div class="layout-container">
            <div class="layout-page">
                @include('layouts.partials.navbar-landing')

                <div class="content-wrapper">
                    @yield('content')

                    @include('layouts.partials.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    
    @yield('page-script')
</body>
</html>