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

    <title>Katalog Buku</title>

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
                <div class="row">
                {{-- SIDEBAR FILTER --}}
                <div class="col-lg-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">Filter Katalog</div>
                        <div class="card-body">
                            <form action="{{ route('katalog.index') }}" method="GET">
                                {{-- Pertahankan pencarian jika ada --}}
                                @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif

                                {{-- Filter Kategori --}}
                                <div class="mb-4">
                                    <h6 class="fw-bold mb-2">Kategori</h6>
                                    @foreach($kategoris as $kat)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kategori" value="{{ $kat->id }}"
                                                {{ request('kategori') == $kat->id ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <label class="form-check-label">{{ $kat->nama_kategori }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Filter Rak --}}
                                <div class="mb-4">
                                    <h6 class="fw-bold mb-2">Lokasi Rak</h6>
                                    <select name="rak" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Semua Rak</option>
                                        @foreach($raks as $rak)
                                            <option value="{{ $rak->id }}" {{ request('rak') == $rak->id ? 'selected' : '' }}>
                                                {{ $rak->nama_rak }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <a href="{{ route('katalog.index') }}" class="btn btn-outline-secondary w-100 btn-sm">Reset Filter</a>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- buku GRID --}}
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Koleksi Buku</h4>
                        {{-- Pencarian Cepat --}}
                        <form action="{{ route('katalog.index') }}" method="GET" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari judul/pengarang..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="bx bx-search"></i></button>
                        </form>
                    </div>

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @forelse($buku as $item)
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="p-3 pb-0"> 
                                        <img src="{{ $item->foto ? asset('storage/buku/'.$item->foto) : asset('assets/img/elements/18.jpg') }}" 
                                            class="card-img-top rounded shadow-sm" 
                                            alt="{{ $item->judul }}" 
                                            style="height: 250px; object-fit: cover;">
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div class="mb-2">
                                            <span class="badge bg-label-primary">{{ $item->kategori->nama_kategori }}</span>
                                        </div>
                                        <h5 class="card-title mb-1 fw-bold text-truncate">{{ $item->judul }}</h5>
                                        <p class="text-muted small mb-4"> 
                                            <i class="bx bx-user-circle me-1"></i>{{ $item->pengarang }}
                                        </p>
                                        <div class="mt-auto d-flex justify-content-between align-items-center gap-2">
                                            <a href="{{ route('catalog.show', $item->id) }}" class="btn btn-primary btn-sm w-100">
                                                <i class="bx bx-show me-1"></i> Detail
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bx bx-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <h5>Buku tidak ditemukan</h5>
                            </div>
                        @endforelse
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
  </body>
</html>
