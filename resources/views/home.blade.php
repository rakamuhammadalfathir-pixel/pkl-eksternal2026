<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>E-Perpustakaan</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }} ?v=1" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/js/config.js') }}"></script>

    <style>
        /* CSS Khusus agar Sneat menjadi Landing Page */
        .layout-page { 
            padding-left: 0 !important; 
            padding-right: 0 !important; 
        }
        .content-wrapper { 
            margin-top: 0 !important; 
        }
        .transition-all { 
            transition: all 0.3s ease-in-out; 
        }
        .category-hover:hover {
            background-color: #696cff !important;
            transform: translateY(-5px);
            border-color: #696cff !important;
        }
        .category-hover:hover h6, 
        .category-hover:hover small,
        .category-hover:hover i {
            color: #fff !important;
        }
        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 2rem rgba(0,0,0,0.15) !important;
        }
        /* Menyesuaikan navbar agar melayang rapi */
        .layout-navbar-full .layout-navbar {
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-navbar-full">
        <div class="layout-container">
            
            <div class="layout-page">
                
                @include('layouts.partials.navbar-landing')
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        
                        <div class="card bg-primary mb-5 border-0 shadow-lg overflow-hidden" style="border-radius: 2rem;">
                            <div class="d-flex align-items-center row">
                                <div class="col-sm-7">
                                    <div class="card-body p-5 text-start">
                                        <h1 class="display-4 fw-bold text-white mb-3">
                                            Tingkatkan Pengetahuan <br> Tanpa Batas 📚
                                        </h1>
                                        <p class="lead text-white mb-4 opacity-75">
                                            Akses ribuan koleksi buku digital dan fisik dengan mudah. <br>
                                            Pinjam kapan saja, baca di mana saja bersama E-Perpustakaan.
                                        </p>
                                        <div class="d-flex gap-3">
                                            <a href="#katalog" class="btn btn-warning btn-lg px-4 shadow-sm">
                                                <i class="bx bx-book-open me-2"></i>Mulai Membaca
                                            </a>
                                            @guest
                                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                                                Daftar Anggota
                                            </a>
                                            @endguest
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 text-center">
                                    <div class="card-body pb-0 px-0 px-md-4">
                                        <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" 
                                             height="320" 
                                             alt="Ilustrasi Perpustakaan" 
                                             class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5 px-2">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-bold m-0 text-primary">Eksplorasi Kategori</h4>
                                <hr class="flex-grow-1 ms-3 d-none d-md-block opacity-25">
                            </div>
                            <div class="row g-4">
                                @foreach($kategori as $cat)
                                <div class="col-6 col-md-4 col-lg-2 text-center">
                                    <a href="{{ route('katalog.index', ['kategori' => $cat->id]) }}" class="text-decoration-none">
                                        <div class="card shadow-none border h-100 py-3 category-hover transition-all">
                                            <div class="card-body p-2">
                                                <div class="avatar mx-auto mb-3" style="width: 60px; height: 60px;">
                                                    <span class="avatar-initial rounded-circle bg-label-primary fs-3">
                                                        <i class="bx bx-grid-alt"></i>
                                                    </span>
                                                </div>
                                                <h6 class="fw-bold mb-1 text-dark">{{ $cat->nama_kategori }}</h6>
                                                <small class="text-muted">{{ $cat->buku_count ?? 0 }} Koleksi</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div id="katalog" class="pt-3 px-2">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h2 class="fw-bold text-dark mb-1">Buku Terbaru</h2>
                                    <p class="text-muted">Temukan bacaan menarik minggu ini</p>
                                </div>
                                <a href="#" class="btn btn-outline-primary rounded-pill px-4">
                                    Lihat Semua <i class="bx bx-right-arrow-alt ms-1"></i>
                                </a>
                            </div>

                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                                @forelse($buku as $item)
                                <div class="col">
                                    <div class="card h-100 shadow-sm border-0 transition-all book-card">
                                        <div class="position-relative p-3">
                                            <img src="{{ $item->foto ? asset('storage/buku/'.$item->foto) : asset('assets/img/elements/18.jpg') }}" 
                                                 class="card-img-top rounded-3 shadow-sm" 
                                                 alt="{{ $item->judul }}" 
                                                 style="height: 280px; object-fit: cover;">
                                            <div class="position-absolute top-0 end-0 p-4">
                                                <span class="badge rounded-pill bg-{{ $item->stok > 0 ? 'success' : 'danger' }} shadow">
                                                    {{ $item->stok > 0 ? 'Tersedia' : 'Kosong' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <small class="text-primary fw-bold text-uppercase mb-1 d-block" style="font-size: 0.75rem;">
                                                {{ $item->kategori->nama_kategori ?? 'Umum' }}
                                            </small>
                                            <h5 class="card-title mb-2 fw-bold text-dark text-truncate" title="{{ $item->judul }}">
                                                {{ $item->judul }}
                                            </h5>
                                            <p class="text-muted small mb-4 d-flex align-items-center">
                                                <i class="bx bx-pencil me-1"></i> {{ $item->pengarang }}
                                            </p>
                                            @auth
                                                <a href="{{ route('catalog.show', $item->id) }}" class="btn btn-primary w-100 rounded-pill shadow-sm">
                                                    <i class="bx bx-bookmark-plus me-1"></i> Pinjam Buku
                                                </a>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-label-secondary w-100 rounded-pill">
                                                    Login untuk Pinjam
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12 text-center py-5">
                                    <i class="bx bx-book-content display-1 text-muted"></i>
                                    <h5 class="text-muted mt-3">Belum ada koleksi buku terbaru.</h5>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    @include('layouts.partials.footer')
                    <div class="content-backdrop fade"></div>
                </div>
                </div>
            </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>