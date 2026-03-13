<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>E-Perpustakaan</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('/assets/vendor/js/helpers.js') }}" ></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/assets/js/config.js') }}" ></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('layouts.partials.sidebar')
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('layouts.partials.navbar')
          <!-- / Navbar -->   
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <section class="bg-primary text-white py-5" style="border-radius: 0 0 2rem 2rem;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h1 class="display-4 fw-bold mb-3 text-white">
                                Tingkatkan Pengetahuan Tanpa Batas 📚
                            </h1>
                            <p class="lead mb-4 text-white">
                                Akses ribuan koleksi buku digital dan fisik dengan mudah. 
                                Pinjam kapan saja, baca di mana saja bersama E-Perpustakaan.
                            </p>
                            <div class="d-flex gap-2">
                                <a href="#katalog" class="btn btn-warning btn-lg px-4">
                                    <i class="bx bx-book-reader me-2"></i>Mulai Membaca
                                </a>
                                @guest
                                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                                    Daftar Anggota
                                </a>
                                @endguest
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-block text-center">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                                alt="Perpustakaan Digital" class="img-fluid" style="max-height: 350px;">
                        </div>
                    </div>
                </div>
            </section>

            {{-- Kategori Buku (Lingkaran) --}}
            <section class="py-5">
                <div class="container">
                    <h4 class="fw-bold mb-4">Eksplorasi Kategori</h4>
                    <div class="row g-4">
                        {{-- Gunakan data kategori dari controller --}}
                        @foreach($kategori as $cat)
                            <div class="col-6 col-md-4 col-lg-2">
                                <a href="{{ route('katalog.index', ['kategori' => $cat->id]) }}" class="text-decoration-none">
                                    <div class="card border-0 shadow-sm text-center h-100 py-3">
                                        <div class="card-body">
                                            <div class="avatar mx-auto mb-3" style="width: 70px; height: 70px;">
                                                <span class="avatar-initial rounded-circle bg-label-primary fs-2">
                                                    <i class="bx bx-category"></i>
                                                </span>
                                            </div>
                                            <h6 class="card-title mb-1 text-dark">{{ $cat->nama_kategori }}</h6>
                                            <small class="text-muted">{{ $cat->buku_count ?? 0 }} Koleksi</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Katalog Buku Terbaru (Card Grid) --}}
            <section id="katalog" class="py-5 bg-light">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold mb-0">Buku Terbaru</h2>
                        <a href="#" class="btn btn-primary">
                            Lihat Semua <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    </div>
                    
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                      @forelse($buku as $item)
                          <div class="col">
                              <div class="card h-100 shadow-sm border-0">
                                  {{-- Bagian Gambar dengan Padding seperti Katalog --}}
                                  <div class="p-3 pb-0 position-relative"> 
                                      <img src="{{ $item->foto ? asset('storage/buku/'.$item->foto) : asset('assets/img/elements/18.jpg') }}" 
                                          class="card-img-top rounded shadow-sm" 
                                          alt="{{ $item->judul }}" 
                                          style="height: 250px; object-fit: cover;">
                                      
                                      {{-- Badge Status (Tersedia/Kosong) --}}
                                      <div class="position-absolute top-0 end-0 p-4">
                                          <span class="badge bg-{{ $item->stok > 0 ? 'success' : 'danger' }} shadow">
                                              {{ $item->stok > 0 ? 'TERSEDIA' : 'KOSONG' }}
                                          </span>
                                      </div>
                                  </div>

                                  <div class="card-body d-flex flex-column">
                                      {{-- Label Kategori --}}
                                      <div class="mb-2">
                                          <span class="badge bg-label-primary text-uppercase">{{ $item->kategori->nama_kategori ?? 'Umum' }}</span>
                                      </div>

                                      {{-- Judul Buku --}}
                                      <h5 class="card-title mb-1 fw-bold text-truncate">{{ $item->judul }}</h5>

                                      {{-- Pengarang dengan Icon User --}}
                                      <p class="text-muted small mb-4"> 
                                          <i class="bx bx-user-circle me-1"></i>Penulis: {{ $item->pengarang }}
                                      </p>

                                      {{-- Tombol Aksi --}}
                                      <div class="mt-auto">
                                          @auth
                                              <a href="{{ route('catalog.show', $item->id) }}" class="btn btn-outline-primary btn-sm w-100">
                                                  <i class="bx bx-bookmark-plus me-1"></i> Pinjam Buku
                                              </a>
                                          @else
                                              <a href="{{ route('login') }}" class="btn btn-light btn-sm w-100">
                                                  Login untuk Pinjam
                                              </a>
                                          @endauth
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @empty
                          <div class="col-12 text-center py-5">
                              <h5 class="text-muted">Belum ada koleksi buku terbaru.</h5>
                          </div>
                      @endforelse
                  </div>
                </div>
            </section>

            {{-- Promo/Informasi Banner --}}
            {{-- <section class="py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card bg-info text-white border-0 shadow-lg">
                                <div class="card-body p-4 d-flex align-items-center">
                                    <div>
                                        <h3 class="text-white fw-bold">Jadi Anggota Pro?</h3>
                                        <p>Nikmati batas peminjaman hingga 10 buku sekaligus!</p>
                                        <a href="#" class="btn btn-light text-info fw-bold">Daftar Sekarang</a>
                                    </div>
                                    <i class="bx bx-medal ms-auto display-3 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-dark text-white border-0 shadow-lg">
                                <div class="card-body p-4 d-flex align-items-center">
                                    <div>
                                        <h3 class="text-white fw-bold">Donasi Buku</h3>
                                        <p>Punya buku tak terpakai? Donasikan untuk sesama.</p>
                                        <a href="#" class="btn btn-outline-light">Hubungi Kami</a>
                                    </div>
                                    <i class="bx bx-heart ms-auto display-3 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
            </div>
            <!-- Footer -->
            @include('layouts.partials.footer')
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}" ></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}" ></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}" ></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}" ></script>

    <script src="{{ asset('/assets/vendor/js/menu.js') }}" ></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}" ></script>

    <!-- Main JS -->
    <script src="{{ asset('/assets/js/main.js') }}" ></script>

    <!-- Page JS -->
    <script src="{{ asset('/assets/js/dashboards-analytics.js') }}" ></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
