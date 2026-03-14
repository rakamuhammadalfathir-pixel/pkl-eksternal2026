<!DOCTYPE html>
<html
  lang="en"
  /* 1. UBAH: Ganti layout-menu-fixed menjadi layout-without-menu */
  class="light-style layout-without-menu"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Wishlist Saya</title>

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
        /* 2. TAMBAHKAN: CSS agar konten tidak tertutup navbar fixed dan lebar penuh */
        body {
            padding-top: 70px !important;
        }
        .layout-page {
            padding-left: 0 !important;
        }
    </style>

    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/js/config.js') }}"></script>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        
        <div class="layout-page">
          @include('layouts.partials.navbar-landing')

          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4 text-center">
                     Daftar Wishlist Saya
                </h4>
                
                <div class="row">
                    @forelse($wishlist as $item)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="text-center p-3">
                                    <img src="{{ $item->foto ? asset('storage/buku/' . $item->foto) : asset('assets/img/elements/18.jpg') }}" 
                                         class="img-fluid rounded" 
                                         style="height: 250px; width: 100%; object-fit: cover;" 
                                         alt="{{ $item->judul }}"/>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <span class="badge bg-label-primary">{{ $item->kategori->nama_kategori ?? 'Umum' }}</span>
                                    </div>
                                    <h5 class="card-title mb-1 fw-bold text-truncate">{{ $item->judul }}</h5>
                                    <p class="text-muted small mb-4">
                                        <i class="bx bx-user me-1"></i>{{ $item->pengarang }}
                                    </p>
                                    
                                    <div class="mt-auto d-flex gap-2">
                                        {{-- Tombol Detail/Pinjam --}}
                                        <a href="{{ route('catalog.show', $item->id) }}" class="btn btn-primary btn-sm w-100">
                                            <i class="bx bx-book-open me-1"></i> Detail
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus dari wishlist">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 mt-5">
                            <i class="bx bx-heart text-muted mb-3" style="font-size: 5rem; opacity: 0.5;"></i>
                            <h4 class="text-muted">Wishlist masih kosong</h4>
                            <p>Anda belum menambahkan buku apa pun ke daftar keinginan.</p>
                            <a href="{{ route('katalog.index') }}" class="btn btn-primary">Kembali ke Katalog</a>
                        </div>
                    @endforelse
                </div>
            </div>
            
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
  </body>
</html>