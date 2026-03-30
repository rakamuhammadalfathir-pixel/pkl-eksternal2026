<!doctype html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>E-Perpus | Dashboard</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apexcharts.css') }}" />

    @stack('page-css')

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        
        @include('layouts.partials.sidebar')
        <div class="layout-page">
          
          @include('layouts.partials.navbar')
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                
                {{-- Bagian Statistik Dashboard --}}
                <div class="row g-4 mb-4">
                    {{-- Total Koleksi --}}
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm border-start border-4 border-primary h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Total Koleksi</p>
                                        <h4 class="fw-bold mb-0 text-primary">{{ $stats['total_buku'] ?? 0 }}</h4>
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

                    {{-- Permintaan Pinjam --}}
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm border-start border-4 border-warning h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Permintaan Pinjam</p>
                                        <h4 class="fw-bold mb-0 text-warning">{{ $stats['pending_peminjaman'] ?? 0 }}</h4>
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

                    {{-- Belum Kembali --}}
                    <div class="col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm border-start border-4 border-danger h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Belum Kembali</p>
                                        <h4 class="fw-bold mb-0 text-danger">{{ $stats['terlambat'] ?? 0 }}</h4>
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
                                        <h4 class="fw-bold mb-0 text-success">{{ $stats['total_anggota'] ?? 0 }}</h4>
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
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Total Peminjaman (7 Hari Terakhir)</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="loanChart" height="250"></canvas>
                        </div>
                    </div>
                </div>

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

            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Buku Paling Sering Dipinjam</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4 text-center">
                        @foreach($popularBooks as $book)
                            <div class="col-6 col-md-2">
                                <div class="card h-100 border-0 shadow-none">
                                    <img src="{{ $book->foto ? asset('storage/buku/' . $book->foto) : asset('assets/img/elements/18.jpg') }}" class="card-img-top rounded shadow-sm mb-2" style="height: 120px; object-fit: cover;">
                                    <h6 class="card-title text-truncate mb-0" style="font-size: 0.85rem">{{ $book->judul }}</h6>
                                    <small class="text-muted">{{ $book->peminjaman_count ?? 0 }}x Peminjaman</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>  
            @yield('content')

            </div>
            @include('layouts.partials.footer')
            <div class="content-backdrop fade"></div>
        </div>
        </div>
        </div>

    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('page-js')
</body>
</html>