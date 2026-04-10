<!DOCTYPE html>
<html lang="id" class="light-style layout-without-menu" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - e-perpus</title>
    
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" 
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
    
    <style>
        body { padding-top: 80px !important; background-color: #f5f5f9; }
        .layout-page { padding-left: 0 !important; }
        .card { border-radius: 12px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.05) !important; }
    </style>
    @yield('page-style')
</head>
<body>
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
        <div class="layout-container">
            <div class="layout-page">
                @include('layouts.partials.navbar-landing')
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    @include('layouts.partials.footer')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('page-script')
</body>
</html>