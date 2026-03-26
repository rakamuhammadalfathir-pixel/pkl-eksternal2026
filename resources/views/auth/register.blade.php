<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Register | E-Perpustakaan</title>

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

                        <h4 class="mb-2 text-center">Petualangan dimulai! 🚀</h4>
                        <p class="mb-4 text-center">Buat akun Anda untuk akses koleksi digital</p>

                        <form id="formAuthentication" action="{{ route('register') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="username" name="name" placeholder="Masukkan nama Anda" autocomplete="off" required autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" autocomplete="off" required />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Kata Sandi</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="············" autocomplete="new-password" required />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password-confirm">Konfirmasi Kata Sandi</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="············" autocomplete="new-password" required />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100 shadow-sm">Daftar Akun</button>
                        </form>

                        <p class="text-center mt-3">
                            <span>Sudah memiliki akun?</span>
                            <a href="{{ route('login') }}"><span>Masuk saja</span></a>
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