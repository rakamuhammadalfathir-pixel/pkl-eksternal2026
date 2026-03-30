<!DOCTYPE html>
<html lang="en" /* 1. UBAH: Gunakan class layout-without-menu agar tidak ada ruang kosong sidebar */ class="light-style layout-without-menu" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free" >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Detail Buku | {{ $buku->judul }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* 2. TAMBAHKAN: CSS Penyesuaian Layout User */
        body {
            padding-top: 70px !important; /* Agar konten tidak tertutup navbar fixed */
        }
        .layout-page {
            padding-left: 0 !important;
        }
        .book-detail-card {
            border-radius: 15px;
            overflow: hidden;
        }
        .img-container {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
    </style>
    
    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/js/config.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
        <div class="layout-container">
        
        <div class="layout-page">
            @include('layouts.partials.navbar-landing')

            <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                
                <div class="mb-4">
                    <a href="{{ route('katalog.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                        <i class="bx bx-left-arrow-alt"></i> Kembali ke Katalog
                    </a>
                </div>

                <div class="card border-0 shadow-sm book-detail-card">
                    <div class="card-body p-lg-5">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="img-container shadow-sm">
                                    <img src="{{ $buku->foto ? asset('storage/buku/' . $buku->foto) : asset('assets/img/elements/18.jpg') }}" alt="{{ $buku->judul }}" class="img-fluid rounded shadow" style="max-height: 500px; width: 100%; object-fit: cover;" />
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="ps-md-4">
                                    <span class="badge bg-label-primary mb-3 px-3 py-2 fs-6">{{ $buku->kategori->nama_kategori }}</span>
                                    <h1 class="fw-bold mb-1">{{ $buku->judul }}</h1>
                                    <p class="text-muted fs-5 mb-4">Karya <span class="text-primary fw-semibold">{{ $buku->pengarang }}</span></p>

                                    <div class="row g-4 mb-4">
                                        <div class="col-6 col-sm-4">
                                            <small class="text-muted d-block text-uppercase small">Penerbit</small>
                                            <span class="fw-bold">{{ $buku->penerbit }}</span>
                                        </div>
                                        <div class="col-6 col-sm-4">
                                            <small class="text-muted d-block text-uppercase small">Tahun</small>
                                            <span class="fw-bold">{{ $buku->tahun }}</span>
                                        </div>
                                        <div class="col-6 col-sm-4">
                                            <small class="text-muted d-block text-uppercase small">Status Stok</small>
                                            @if($buku->stok > 0)
                                                <span class="text-success fw-bold d-block"><i class="bx bx-check-circle me-1"></i>Tersedia ({{ $buku->stok }})</span>
                                            @else
                                                <span class="text-danger fw-bold d-block"><i class="bx bx-x-circle me-1"></i>Habis</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <div class="p-3 bg-light rounded-3 d-inline-block border">
                                                <small class="text-muted d-block text-uppercase small mb-1">Posisi Buku di Perpustakaan</small>
                                                <span class="badge bg-primary me-2">{{ $buku->rak->nama_rak }}</span>
                                                <span class="text-dark fw-semibold"><i class="bx bx-map me-1"></i>{{ $buku->rak->lokasi ?? 'Hubungi Petugas' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4" />
                                    
                                    <h5 class="fw-bold mb-3">Sinopsis</h5>
                                    <p class="text-muted lh-lg" style="text-align: justify;">
                                        {{ $buku->sinopsis ?? 'Sinopsis tidak tersedia untuk buku ini.' }}
                                    </p>

                                    <div class="mt-5 d-flex flex-wrap gap-3">
                                        @if($buku->stok > 0)
                                            <form action="{{ route('peminjamanbuku.add') }}" method="POST" id="formPinjam">
                                                @csrf
                                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">                                          
                                                <button type="button" class="btn btn-primary btn-lg px-4" onclick="confirmLoan()">
                                                    <i class="bx bx-cart-add me-2"></i> Tambah Pinjaman
                                                </button>
                                            </form>
                                        @endif  

                                        @auth
                                            <form action="{{ route('wishlist.toggle', $buku->id) }}" method="POST">
                                                @csrf
                                                @php $isWishlisted = auth()->user()->wishlist->contains($buku->id); @endphp
                                                <button type="submit" class="btn {{ $isWishlisted ? 'btn-danger' : 'btn-outline-danger' }} btn-lg px-4">
                                                    <i class="bx {{ $isWishlisted ? 'bxs-heart' : 'bx-heart' }} me-2"></i>
                                                    {{ $isWishlisted ? 'Hapus Wishlist' : 'Simpan Wishlist' }}
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-outline-danger btn-lg px-4">
                                                <i class="bx bx-heart me-2"></i> Tambah Wishlist
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 2500, showConfirmButton: false });
            @endif
            @if(session('info'))
                Swal.fire({ icon: 'info', title: 'Informasi', text: "{{ session('info') }}", confirmButtonColor: '#696cff' });
            @endif
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Oops...', text: "{{ session('error') }}", confirmButtonColor: '#ff3e1d' });
            @endif
        });

        function confirmLoan() {
            Swal.fire({
                title: 'Konfirmasi Pinjaman',
                text: "Tambahkan '{{ $buku->judul }}' ke antrean pinjam?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tambahkan!',
                cancelButtonText: 'Batal',
                customClass: { confirmButton: 'btn btn-primary me-3', cancelButton: 'btn btn-outline-secondary' },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) { document.getElementById('formPinjam').submit(); }
            });
        }
    </script>
</body>
</html>