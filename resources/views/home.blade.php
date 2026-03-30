<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

    <title>E-Perpustakaan | Digital Library</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />

    <style>
        /* Materio Aesthetic Overrides */
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f4f5fa; 
        }

        /* PERBAIKAN: Jarak agar tidak terhalang navbar */
        .content-wrapper { 
            padding-top: 100px !important; 
        }
        
        /* Navbar ala Materio (Blur Effect) */
        .layout-navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.8) !important;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        /* Hero Section ala Materio */
        .hero-section {
            background: linear-gradient(135deg, #9055fd 0%, #696cff 100%);
            border-radius: 1.5rem; 
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(105, 108, 255, 0.3);
            margin-bottom: 3rem;
        }

        /* Category Card ala Materio */
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
            box-shadow: 0 10px 20px rgba(105, 108, 255, 0.2);
        }
        .category-card:hover h6, 
        .category-card:hover small, 
        .category-card:hover i {
            color: #fff !important;
        }

        /* Book Card ala Materio */
        .book-card {
            border: none;
            border-radius: 1rem;
            transition: all 0.3s ease-in-out;
            background: #fff;
            box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
        }
        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important;
        }
        .book-img-container img {
            border-radius: 0.8rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-white {
            background-color: #ffffff !important;
            color: #696cff !important; /* Warna ungu primary Materio */
            border: none;
        }

        .btn-white:hover {
            background-color: #f0f0f0 !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        /* Pastikan icon di dalam tombol putih juga berwarna ungu */
        .btn-white i {
            color: #696cff !important;
        }

        /* Utility */
        .btn-rounded { border-radius: 50px; }
        .text-heading { color: #566a7f; }
        .layout-page { padding: 0 !important; }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-navbar-full">
        <div class="layout-container">
            
            <div class="layout-page">
                @include('layouts.partials.navbar-landing')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        
                        <div class="hero-section">
                            <div class="row align-items-center">
                                <div class="col-md-7 p-5 ps-md-5">
                                    <h1 class="display-5 fw-bold text-white mb-3">
                                        Tingkatkan Pengetahuan <br> Tanpa Batas 📚
                                    </h1>
                                    <p class="fs-5 text-white mb-4 opacity-75">
                                        Akses ribuan koleksi buku digital dan fisik dengan mudah. <br>
                                        Pinjam kapan saja, baca di mana saja bersama E-Perpus.
                                    </p>
                                    <div class="d-flex gap-3">
                                        <a href="#katalog" class="btn btn-lg btn-rounded text-white fw-bold shadow-lg px-4 border border-white" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px);">
                                            <i class="bx bx-book-open me-2 text-white"></i> Mulai Membaca
                                        </a>
                                        @guest
                                        <a href="{{ route('register') }}" class="btn btn-lg btn-rounded text-white fw-bold shadow-lg px-4 border border-white" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px);">
                                            Daftar Anggota
                                        </a>
                                        @endguest
                                    </div>
                                </div>
                                <div class="col-md-5 text-center d-none d-md-block">
                                    <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="320" alt="Hero Illustration" class="img-fluid p-4">
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-bold m-0 text-heading">Eksplorasi Kategori</h4>
                                <div class="flex-grow-1 mx-3 border-bottom opacity-25"></div>
                            </div>
                            <div class="row g-4">
                                @foreach($kategori as $cat)
                                <div class="col-6 col-md-4 col-lg-2">
                                    <a href="{{ route('katalog.index', ['kategori' => $cat->id]) }}" class="text-decoration-none">
                                        <div class="card category-card text-center p-4 h-100 border-0">
                                            <div class="avatar avatar-lg mx-auto mb-3">
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    <i class="bx bx-grid-alt"></i>
                                                </span>
                                            </div>
                                            <h6 class="fw-bold mb-1 text-dark">{{ $cat->nama_kategori }}</h6>
                                            <small class="text-muted">{{ $cat->buku_count ?? 0 }} Koleksi</small>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div id="katalog">
                            <div class="d-flex justify-content-between align-items-end mb-4">
                                <div>
                                    <h3 class="fw-bold text-dark mb-1">Buku Terbaru</h3>
                                    <p class="text-muted mb-0">Rekomendasi bacaan untuk Anda</p>
                                </div>
                                <a href="#" class="btn btn-label-primary btn-rounded px-4">
                                    Lihat Semua <i class="bx bx-right-arrow-alt ms-1"></i>
                                </a>
                            </div>

                            <div class="row g-4">
                                @forelse($buku as $item)
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="card h-100 book-card">
                                        <div class="p-3 book-img-container">
                                            <img src="{{ $item->foto ? asset('storage/buku/'.$item->foto) : asset('assets/img/elements/18.jpg') }}"  class="w-100 rounded" alt="{{ $item->judul }}"  style="height: 300px; object-fit: cover;">
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <small class="text-primary fw-bold text-uppercase" style="font-size: 0.7rem;">
                                                    {{ $item->kategori->nama_kategori ?? 'Umum' }}
                                                </small>
                                                <span class="badge rounded-pill bg-{{ $item->stok > 0 ? 'success' : 'danger' }} small">
                                                    {{ $item->stok > 0 ? 'Ada' : 'Habis' }}
                                                </span>
                                            </div>
                                            <h5 class="card-title mb-2 fw-bold text-dark text-truncate" title="{{ $item->judul }}">{{ $item->judul }}</h5>
                                            <p class="text-muted small mb-4"><i class="bx bx-pencil me-1"></i> {{ $item->pengarang }}</p>
                                            
                                            @auth
                                                <a href="{{ route('catalog.show', $item->id) }}" class="btn btn-primary w-100 btn-rounded shadow-sm">
                                                    Pinjam Sekarang
                                                </a>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100 btn-rounded">
                                                    Login untuk Pinjam
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12 text-center py-5">
                                    <h5 class="text-muted">Belum ada koleksi buku tersedia.</h5>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    
                    @include('layouts.partials.footer')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
</body>
</html>