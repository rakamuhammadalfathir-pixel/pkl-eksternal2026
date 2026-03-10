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

    <title>Data Buku</title>

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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Data Buku</h4>
                <div class="mb-4 d-flex justify-content-between align-items-center">
                  <div class="d-flex gap-2">
                  <a href="{{ route('admin.buku.create') }}" class="btn btn-primary">
                    Tambah Buku
                  </a>
                  <a href="{{ route('admin.buku.export_excel') }}" class="btn btn-success">
                    <i class="bx bxs-file-export me-1"></i> Export Excel
                  </a>
                  </div>
                  
                  <div class="col-md-4">
                    <form action="{{ route('admin.buku.index') }}" method="GET">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Cari judul buku..." aria-label="Cari judul buku..." value="{{ request('search') }}" />
                            @if(request('search'))
                                <a href="{{ route('admin.buku.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-x"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                  </div>
                </div>
              <!-- Bordered Table -->
              <div class="card">
                <h5 class="card-header">Table Buku</h5>
                <div class="card-body">
                  <div class="table text-nowrap">
                    @if(session('success'))
                        <div class="alert alert-primary alert-dismissible" role="alert">
                            <h6 class="alert-heading d-flex align-items-center mb-1">
                                <i class="bx bx-check-circle me-2"></i>Berhasil!
                            </h6>
                            <span>{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <h6 class="alert-heading d-flex align-items-center mb-1">
                                <i class="bx bx-error-circle me-2"></i>Ups, Ada Kesalahan!
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th>Judul</th>
                          <th>Pengarang</th>
                          <th>Kategori</th>
                          <th>Rak</th>
                          <th class="text-center">Stok</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $no = 1; @endphp
                        @foreach($buku as $item)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->pengarang }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td>{{ $item->rak->nama_rak }}</td>
                            <td class="text-center">{{ $item->stok }}</td>
                            <td>

                            <div class="d-flex flex-row gap-2">
                                    <a href="{{ route('admin.buku.show', $item->id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bx bx-show me-1"></i> Show
                                    </a>
                                    <a href="{{ route('admin.buku.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.buku.destroy', $item->id) }}" method="POST" class="d-grid">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </form>
                              </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--/ Bordered Table -->
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
