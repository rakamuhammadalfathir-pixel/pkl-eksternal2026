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

    <title>Admin Dashboard</title>

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
                  
            <div class="row g-4 mb-4">
              {{-- Total Buku --}}
              <div class="col-sm-6 col-xl-3">
                  <div class="card border-0 shadow-sm border-start border-4 border-primary h-100">
                      <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Total Koleksi</p>
                                  <h4 class="fw-bold mb-0 text-primary">{{ $stats['total_buku'] }}</h4>
                              </div>
                              <div class="avatar">
                                  <span class="avatar-initial rounded bg-label-primary">
                                      <i class="bx bx-book-open bx-sm"></i>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              {{-- Perlu Diproses (Peminjaman Baru) --}}
              <div class="col-sm-6 col-xl-3">
                  <div class="card border-0 shadow-sm border-start border-4 border-warning h-100">
                      <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Permintaan Pinjam</p>
                                  <h4 class="fw-bold mb-0 text-warning">{{ $stats['pending_peminjaman'] }}</h4>
                              </div>
                              <div class="avatar">
                                  <span class="avatar-initial rounded bg-label-warning">
                                      <i class="bx bx-git-pull-request bx-sm"></i>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              {{-- Buku Terlambat (Pengganti Low Stock/Danger) --}}
              <div class="col-sm-6 col-xl-3">
                  <div class="card border-0 shadow-sm border-start border-4 border-danger h-100">
                      <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Belum Kembali</p>
                                  <h4 class="fw-bold mb-0 text-danger">{{ $stats['terlambat'] }}</h4>
                              </div>
                              <div class="avatar">
                                  <span class="avatar-initial rounded bg-label-danger">
                                      <i class="bx bx-error bx-sm"></i>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              {{-- Total Anggota --}}
              <div class="col-sm-6 col-xl-3">
                  <div class="card border-0 shadow-sm border-start border-4 border-success h-100">
                      <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Total Anggota</p>
                                  <h4 class="fw-bold mb-0 text-success">{{ $stats['total_anggota'] }}</h4>
                              </div>
                              <div class="avatar">
                                  <span class="avatar-initial rounded bg-label-success">
                                      <i class="bx bx-user bx-sm"></i>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="row g-4">
              {{-- 2. Grafik Aktivitas (Mengadaptasi Chart.js kamu) --}}
              <div class="col-lg-8">
                  <div class="card border-0 shadow-sm h-100">
                      <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                          <h5 class="card-title mb-0">Tren Peminjaman (7 Hari Terakhir)</h5>
                      </div>
                      <div class="card-body">
                          <canvas id="loanChart" height="250"></canvas>
                      </div>
                  </div>
              </div>

              {{-- 3. Transaksi Terbaru (Peminjaman Terbaru) --}}
              <div class="col-lg-4">
                  <div class="card border-0 shadow-sm h-100">
                      <div class="card-header bg-white py-3">
                          <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                      </div>
                      <div class="card-body p-0">
                          <div class="list-group list-group-flush">
                              @foreach($recentLoans as $loan)
                                  <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                                      <div>
                                          <div class="fw-bold text-primary">{{ $loan->buku->judul }}</div>
                                          <small class="text-muted">{{ $loan->anggota->nama_anggota ?? 'Anggota Terhapus' }}</small>
                                      </div>
                                      <div class="text-end">
                                          <span class="badge rounded-pill {{ $loan->status == 'pinjam' ? 'bg-label-primary' : 'bg-label-success' }}">
                                              {{ ucfirst($loan->status) }}
                                          </span>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                      </div>
                      <div class="card-footer bg-white text-center py-3">
                          <a href="{{ route('admin.peminjaman.index') }}" class="text-decoration-none fw-bold">Lihat Semua Transaksi &rarr;</a>
                      </div>
                  </div>
              </div>
          </div>

          {{-- 4. Buku Paling Populer (Adaptasi dari Top Selling Products) --}}
          <div class="card border-0 shadow-sm mt-4">
              <div class="card-header bg-white py-3">
                  <h5 class="card-title mb-0">Buku Paling Sering Dipinjam</h5>
              </div>
              <div class="card-body">
                  <div class="row g-4 text-center">
                      @foreach($popularBooks as $book)
                          <div class="col-6 col-md-2">
                              <div class="card h-100 border-0 shadow-none">
                                  <img src="{{ $book->foto ? asset('storage/buku/' . $book->foto) : asset('assets/img/elements/18.jpg') }}" 
                                      class="card-img-top rounded shadow-sm mb-2" 
                                      style="height: 120px; object-fit: cover;">
                                  <h6 class="card-title text-truncate mb-0" style="font-size: 0.85rem">{{ $book->judul }}</h6>
                                  <small class="text-muted">{{ $book->peminjaman_count ?? 0 }}x dipinjam</small>
                              </div>
                          </div>
                      @endforeach
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('loanChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($loanChart->pluck('date')) !!},
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: {!! json_encode($loanChart->pluck('total')) !!},
                    borderColor: '#696cff', // Warna Primary Sneat
                    backgroundColor: 'rgba(105, 108, 255, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });
    </script>
  </body>
</html>
