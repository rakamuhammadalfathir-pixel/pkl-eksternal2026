<!DOCTYPE html>
<html lang="en" /* 1. UBAH: Gunakan class layout-without-menu */ class="light-style layout-without-menu" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free" >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Riwayat Peminjaman</title>

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
        /* 2. TAMBAHKAN: CSS Penyesuaian Layout Full Width */
        body {
            padding-top: 70px !important;
        }
        .layout-page {
            padding-left: 0 !important;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05) !important;
            border: none;
        }
        .table thead th {
            background-color: #f8f9fa;
            text-transform: none;
            font-weight: 600;
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
                    <h4 class="fw-bold m-0"><i class="bx bx-history fs-3 me-2"></i>Riwayat Peminjaman</h4>
                    <span class="badge bg-label-info">Total {{ count($history) }} Transaksi</span>
                </div>

                <div class="card overflow-hidden">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th>Status</th>
                                    <th>Tanggal Kembali Real</th>
                                    <th>Denda</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse($history as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                <img src="{{ $item->buku->foto ? asset('storage/buku/' . $item->buku->foto) : asset('assets/img/elements/18.jpg') }}" alt="cover" class="rounded">
                                            </div>
                                            <span class="fw-bold">{{ $item->buku->judul }}</span>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tgl_harus_kembali)->format('d M Y') }}</td>
                                    <td>
                                        @if($item->status == 'Pending')
                                            <span class="badge bg-label-warning"><i class="bx bx-time-five me-1"></i>Menunggu</span>
                                        @elseif($item->status == 'Pinjam')
                                            <span class="badge bg-label-primary"><i class="bx bx-book-open me-1"></i>Dipinjam</span>
                                        @elseif($item->status == 'Kembali')
                                            <span class="badge bg-label-success"><i class="bx bx-check me-1"></i>Kembali</span>
                                        @elseif($item->status == 'Ditolak')
                                            <span class="badge bg-label-danger"><i class="bx bx-x me-1"></i>Ditolak</span>
                                        @else
                                            <span class="badge bg-label-secondary">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->pengembalian ? \Carbon\Carbon::parse($item->pengembalian->tgl_kembali_aktual)->format('d M Y') : '-' }}
                                    </td>
                                    <td>
                                        @if($item->pengembalian && $item->pengembalian->denda > 0)
                                            <span class="text-danger fw-bold">Rp {{ number_format($item->pengembalian->denda) }}</span>
                                        @elseif($item->status == 'Kembali')
                                            <span class="text-success small">Sesuai Jadwal</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == 'Pinjam')
                                            <form action="{{ route('peminjaman.kembali', $item->id) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger px-3" onclick="return confirm('Apakah Anda ingin mengembalikan buku ini?')">
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @elseif($item->status == 'Pending')
                                            <span class="text-muted small">Sedang diproses</span>
                                        @else
                                            <i class="bx bx-check-circle text-success fs-4"></i>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <p class="text-muted mb-0">Belum ada riwayat peminjaman.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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