<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Detail Buku | E-Perpus</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.partials.sidebar')

            <div class="layout-page">
                @include('layouts.partials.navbar')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold mb-0"><span class="text-muted fw-light">Buku /</span> Detail Informasi</h4>
                            <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary btn-sm">
                                <i class="bx bx-arrow-back me-1"></i> Kembali
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img src="{{ $buku->foto ? Storage::url('buku/' . $buku->foto) : asset('assets/img/elements/18.jpg') }}" alt="Cover Buku" class="img-fluid rounded shadow-sm mb-3" style="width: 100%; height: 350px; object-fit: cover;">
                                        <div class="badge bg-label-primary fs-6">{{ $buku->kategori->nama_kategori }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8 col-lg-9">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center border-bottom mb-3">
                                        <h5 class="mb-0">Informasi Lengkap</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3 fw-bold">Judul Buku</div>
                                            <div class="col-sm-9 text-primary fw-bold fs-5">{{ $buku->judul }}</div>
                                        </div>
                                        <hr class="m-0 mb-3">
                                        
                                        <div class="row mb-3">
                                            <div class="col-sm-3 fw-bold">Pengarang</div>
                                            <div class="col-sm-9">{{ $buku->pengarang }}</div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-sm-3 fw-bold">Penerbit</div>
                                            <div class="col-sm-9">{{ $buku->penerbit }} ({{ $buku->tahun }})</div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3 fw-bold">Posisi Rak</div>
                                            <div class="col-sm-9"><span class="badge bg-label-info">{{ $buku->rak->nama_rak }}</span></div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3 fw-bold">Stok Tersedia</div>
                                            <div class="col-sm-9">
                                                <span class="badge {{ $buku->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $buku->stok }} Eksemplar
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3 fw-bold">Sinopsis</div>
                                            <div class="col-sm-9 text-muted italic" style="line-height: 1.6;">
                                                {{ $buku->sinopsis ?: 'Tidak ada sinopsis untuk buku ini.' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script src="{{ asset('/assets/js/main.js') }}"></script>
</body>
</html>