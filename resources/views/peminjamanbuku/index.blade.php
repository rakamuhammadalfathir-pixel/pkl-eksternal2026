<!DOCTYPE html>
<html lang="en" /* 1. UBAH: Gunakan class layout-without-menu */ class="light-style layout-without-menu" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free" >
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Antrean Peminjaman Buku</title>

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
        /* 2. TAMBAHKAN: CSS Penyesuaian agar tidak ada sisa ruang sidebar */
        body {
            padding-top: 70px !important;
        }
        .layout-page {
            padding-left: 0 !important;
        }
        .card {
            border-radius: 12px;
            overflow: hidden;
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold m-0"><i class="bx bx-cart fs-3 me-2"></i>Antrean Peminjaman</h4>
                    <a href="{{ route('katalog.index') }}" class="btn btn-outline-primary rounded-pill btn-sm">
                        <i class="bx bx-plus me-1"></i> Tambah Buku Lagi
                    </a>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header border-bottom bg-white py-3">
                        <h5 class="m-0 fw-bold text-primary">Daftar Buku Terpilih</h5>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 100px;">Buku</th>
                                    <th>Detail Buku</th>
                                    <th>Pengarang</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse($peminjamanbuku as $id => $details)
                                <tr>
                                    <td>
                                        <img src="{{ $details['foto'] ? asset('storage/buku/' . $details['foto']) : asset('assets/img/elements/18.jpg') }}" 
                                             alt="Cover" class="rounded shadow-sm" width="60" height="80" style="object-fit: cover;">
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block fs-6 text-dark">{{ $details['judul'] }}</span>
                                        <small class="text-muted">ID: {{ $id }}</small>
                                    </td>
                                    <td>{{ $details['pengarang'] }}</td>
                                    <td class="text-center">
                                        <form id="formDelete-{{ $id }}" action="{{ route('peminjamanbuku.remove') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="button" onclick="confirmDelete('{{ $id }}', '{{ $details['judul'] }}')" class="btn btn-icon btn-outline-danger btn-sm">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="mb-3">
                                            <i class="bx bx-shopping-bag text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                                        </div>
                                        <h5 class="text-muted">Antrean Anda masih kosong</h5>
                                        <a href="{{ route('katalog.index') }}" class="btn btn-primary mt-2">Jelajahi Katalog</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if(count($peminjamanbuku) > 0)
                    <div class="card-footer bg-light border-top p-4 d-flex justify-content-between align-items-center">
                        <form action="{{ route('peminjamanbuku.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-label-secondary">
                                <i class="bx bx-trash-alt me-1"></i> Kosongkan
                            </button>
                        </form>
                        <button type="button" onclick="confirmCheckout()" class="btn btn-primary btn-lg px-5">
                            <i class="bx bx-check-double me-2"></i> Ajukan Pinjaman Sekarang
                        </button>
                    </div>
                    @endif
                </div>
            </div>

            <form id="formCheckout" action="{{ route('peminjaman.bulk_store') }}" method="POST" style="display: none;">
                @csrf
            </form>

            @include('layouts.partials.footer')
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function confirmCheckout() {
        Swal.fire({
            title: 'Proses Peminjaman?',
            text: "Pastikan daftar buku sudah sesuai. Petugas akan memverifikasi pengajuan Anda.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Pinjam!',
            cancelButtonText: 'Batal',
            customClass: { confirmButton: 'btn btn-primary me-3', cancelButton: 'btn btn-outline-secondary' },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formCheckout').submit();
            }
        });
    }

    function confirmDelete(id, judul) {
        Swal.fire({
            title: 'Hapus Buku?',
            text: "Buku '" + judul + "' akan dikeluarkan dari antrean.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            customClass: { confirmButton: 'btn btn-danger me-3', cancelButton: 'btn btn-outline-secondary' },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formDelete-' + id).submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", showConfirmButton: false, timer: 2000 });
    @endif
    </script>
  </body>
</html>