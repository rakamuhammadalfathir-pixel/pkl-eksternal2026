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

    <title>Detail Buku</title>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <div class="mb-4">
                <a href="{{ route('katalog.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bx bx-chevron-left"></i> Kembali ke Katalog
                </a>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="bg-light rounded p-3 text-center">
                                <img src="{{ $buku->foto ? asset('storage/buku/' . $buku->foto) : asset('assets/img/elements/18.jpg') }}"  alt="{{ $buku->judul }}"  class="img-fluid rounded shadow-sm" style="max-height: 450px; object-fit: cover;"  />
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="ps-md-3">
                                <div class="mb-2">
                                    <span class="badge bg-label-primary px-3 py-2 fs-6">{{ $buku->kategori->nama_kategori }}</span>
                                </div>
                                <h2 class="fw-bold mb-1">{{ $buku->judul }}</h2>
                                <p class="text-muted fs-5 mb-4">Ditulis oleh <span class="text-primary">{{ $buku->pengarang }}</span></p>

                                <hr class="my-4" />

                                <div class="row g-3">
                                    <div class="col-6 col-md-4">
                                        <small class="text-muted d-block text-uppercase">Penerbit</small>
                                        <span class="fw-semibold">{{ $buku->penerbit }}</span>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <small class="text-muted d-block text-uppercase">Tahun Terbit</small>
                                        <span class="fw-semibold">{{ $buku->tahun }}</span>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <small class="text-muted d-block text-uppercase">Lokasi Rak</small>
                                        <span class="badge bg-label-info">{{ $buku->rak->nama_rak }}</span>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <small class="text-muted d-block text-uppercase">Status Stok</small>
                                        @if($buku->stok > 0)
                                            <span class="text-success fw-bold"><i class="bx bx-check-circle me-1"></i>Tersedia ({{ $buku->stok }})</span>
                                        @else
                                            <span class="text-danger fw-bold"><i class="bx bx-x-circle me-1"></i>Kosong</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-5 d-grid d-md-flex gap-3">
                                    @if($buku->stok > 0)
                                        <form action="{{ route('peminjamanbuku.add') }}" method="POST" id="formPinjam">
                                            @csrf
                                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">                                          
                                            <button type="button" class="btn btn-primary btn-lg px-5" onclick="confirmLoan()">
                                                <i class="bx bx-cart-add me-2"></i> Tambah ke Daftar Pinjam
                                            </button>
                                        </form>
                                    @endif  
                                    @auth
                                        <form action="{{ route('wishlist.toggle', $buku->id) }}" method="POST">
                                            @csrf
                                            @php
                                                $isWishlisted = auth()->user()->wishlist->contains($buku->id);
                                            @endphp
                                            <button type="submit" class="btn {{ $isWishlisted ? 'btn-danger' : 'btn-outline-danger' }} btn-lg px-4">
                                                <i class="bx {{ $isWishlisted ? 'bxs-heart' : 'bx-heart' }} me-2"></i>
                                                {{ $isWishlisted ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline-danger btn-lg px-4">
                                            <i class="bx bx-heart me-2"></i> Tambah ke Wishlist
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <script>
    function confirmLoan() {
        Swal.fire({
            title: 'Konfirmasi Pinjaman',
            text: "Apakah kamu yakin ingin meminjam buku '{{ $buku->judul }}'?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#696cff', // Warna ungu primary Sneat
            cancelButtonColor: '#8592a3', // Warna secondary Sneat
            confirmButtonText: 'Ya, Pinjam Sekarang!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-primary me-3',
                cancelButton: 'btn btn-outline-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user klik Ya, form akan di-submit otomatis
                document.getElementById('formPinjam').submit();
            }
        });
    }
    </script>
  </body>
</html>
