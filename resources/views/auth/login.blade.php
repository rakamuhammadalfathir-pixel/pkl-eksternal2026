<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Masuk | E-Perpustakaan</title>

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
        
        /* Menghilangkan titik-titik dekorasi (dots) */
        .authentication-wrapper.authentication-basic::before,
        .authentication-wrapper.authentication-basic::after,
        .authentication-basic .authentication-inner::before,
        .authentication-basic .authentication-inner::after {
            content: none !important;
            display: none !important;
        }

        .btn-primary {
            box-shadow: 0 4px 14px 0 rgba(105, 108, 255, 0.39);
        }
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
                        <h4 class="mb-2 text-center">Selamat Datang! 👋</h4>
                        <p class="mb-4 text-center">Silakan masuk untuk memulai petualangan membaca</p>
                        <form id="formAuthentication" action="{{ route('login') }}" method="POST" autocomplete="off">
                            @csrf
                            
                            <input type="text" style="display:none" aria-hidden="true">
                            <input type="password" style="display:none" aria-hidden="true">
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" readonly onfocus="this.removeAttribute('readonly');" autocomplete="off"required autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Kata Sandi</label>
                                    <a href="#">
                                        <small>Lupa Sandi?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="············" readonly onfocus="this.removeAttribute('readonly');" autocomplete="new-password" required />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                                    <label class="form-check-label" for="remember-me"> Ingat Saya </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100 shadow-sm" type="submit">Masuk Sekarang</button>
                        </form>
                        <p class="text-center mt-3">
                            <span>Belum memiliki akun?</span>
                            <a href="{{ route('register') }}"><span>Daftar di sini</span></a>
                        </p>
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