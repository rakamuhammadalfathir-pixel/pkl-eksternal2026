<!DOCTYPE html>
<html lang="en" /* 1. UBAH: Ganti layout-menu-fixed menjadi layout-without-menu */ class="light-style layout-without-menu" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free" >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Katalog Buku</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/js/config.js') }}"></script>

    <style>
        /* 2. TAMBAHKAN: CSS agar konten tidak tertutup navbar fixed */
        body {
            padding-top: 80px !important;
        }
        .layout-page {
            padding-left: 0 !important; /* Hapus ruang kosong bekas sidebar */
        }
        .card {
            border-radius: 12px;
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        
        {{-- @include('layouts.partials.sidebar') --}}

        <div class="layout-page">
          
          @include('layouts.partials.navbar-landing')

          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                
                <div class="row">
                    {{-- 4. FILTER KATALOG (Tetap di sini sebagai filter konten) --}}
                    <div class="col-lg-3 mb-4">
                        <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                            <div class="card-header bg-white fw-bold border-bottom">Filter Katalog</div>
                            <div class="card-body pt-4">
                                <form action="{{ route('katalog.index') }}" method="GET">
                                    @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif

                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Kategori</h6>
                                        @foreach($kategoris as $kat)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="kategori" value="{{ $kat->id }}"
                                                    id="kat{{ $kat->id }}"
                                                    {{ request('kategori') == $kat->id ? 'checked' : '' }}
                                                    onchange="this.form.submit()">
                                                <label class="form-check-label" for="kat{{ $kat->id }}">{{ $kat->nama_kategori }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Lokasi Rak</h6>
                                        <select name="rak" class="form-select" onchange="this.form.submit()">
                                            <option value="">Semua Rak</option>
                                            @foreach($raks as $rak)
                                                <option value="{{ $rak->id }}" {{ request('rak') == $rak->id ? 'selected' : '' }}>
                                                    {{ $rak->nama_rak }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <a href="{{ route('katalog.index') }}" class="btn btn-outline-primary w-100">Reset Filter</a>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- 5. GRID BUKU --}}
                    <div class="col-lg-9">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold"><span class="text-muted fw-light">Koleksi</span> Perpustakaan</h4>
                            <form action="{{ route('katalog.index') }}" method="GET" class="d-flex gap-2">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                                    <input type="text" name="search" class="form-control" placeholder="Cari judul..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </form>
                        </div>

                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @forelse($buku as $item)
                                <div class="col">
                                    <div class="card h-100 shadow-sm border-0">
                                        <div class="p-2"> 
                                            <img src="{{ $item->foto ? asset('storage/buku/'.$item->foto) : asset('assets/img/elements/18.jpg') }}" 
                                                class="card-img-top rounded" 
                                                alt="{{ $item->judul }}" 
                                                style="height: 280px; object-fit: cover;">
                                        </div>
                                        <div class="card-body">
                                            <span class="badge bg-label-primary mb-2">{{ $item->kategori->nama_kategori }}</span>
                                            <h5 class="card-title mb-1 fw-bold text-truncate" title="{{ $item->judul }}">{{ $item->judul }}</h5>
                                            <p class="text-muted small mb-3">By {{ $item->pengarang }}</p>
                                            <a href="{{ route('catalog.show', $item->id) }}" class="btn btn-primary btn-sm w-100">
                                                <i class="bx bx-show me-1"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <img src="{{ asset('assets/img/illustrations/empty.png') }}" alt="empty" width="150" class="mb-3">
                                    <h5>Buku tidak ditemukan</h5>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.partials.footer')
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
    <script src="{{ asset('/assets/js/main.js') }}"></script>
</body>
</html>