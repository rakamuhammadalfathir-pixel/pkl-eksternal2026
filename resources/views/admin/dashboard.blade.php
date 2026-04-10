@extends('layouts.admin')

@section('title', 'Dashboard')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apexcharts.css') }}" />
    <style>
        .card-stats { transition: transform 0.2s; }
        .card-stats:hover { transform: translateY(-5px); }
        .book-cover { height: 120px; object-fit: cover; }
    </style>
@endpush

@section('content')
    {{-- Section 1: Ringkasan Statistik --}}
    <div class="row g-4 mb-4">
        @php
            $cards = [
                ['title' => 'Total Koleksi', 'value' => $stats['total_buku'] ?? 0, 'color' => 'primary', 'icon' => 'bx-book-open'],
                ['title' => 'Permintaan Pinjam', 'value' => $stats['pending_peminjaman'] ?? 0, 'color' => 'warning', 'icon' => 'bx-git-pull-request'],
                ['title' => 'Belum Kembali', 'value' => $stats['terlambat'] ?? 0, 'color' => 'danger', 'icon' => 'bx-error'],
                ['title' => 'Total Anggota', 'value' => $stats['total_anggota'] ?? 0, 'color' => 'success', 'icon' => 'bx-user'],
            ];
        @endphp

        @foreach($cards as $card)
            <div class="col-sm-6 col-xl-3">
                <div class="card card-stats border-0 shadow-sm border-start border-4 border-{{ $card['color'] }} h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">
                                    {{ $card['title'] }}
                                </p>
                                <h4 class="fw-bold mb-0 text-{{ $card['color'] }}">{{ $card['value'] }}</h4>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-{{ $card['color'] }}">
                                    <i class="bx {{ $card['icon'] }} bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Section 2: Grafik & Aktivitas --}}
    <div class="row g-4">
        {{-- Grafik Peminjaman --}}
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

        {{-- Aktivitas Terbaru --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentLoans as $loan)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                                <div class="overflow-hidden">
                                    <div class="fw-bold text-primary text-truncate">{{ $loan->buku->judul }}</div>
                                    <small class="text-muted">{{ $loan->anggota->nama_anggota ?? 'Anggota Terhapus' }}</small>
                                </div>
                                <div class="text-end ms-2">
                                    <span class="badge rounded-pill {{ $loan->status == 'pinjam' ? 'bg-label-primary' : 'bg-label-success' }}">
                                        {{ ucfirst($loan->status) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-center text-muted">Tidak ada aktivitas terbaru</div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer bg-white text-center py-3">
                    <a href="{{ route('admin.peminjaman.index') }}" class="text-decoration-none fw-bold small">
                        Lihat Semua Transaksi <i class="bx bx-right-arrow-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Section 3: Buku Populer --}}
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0">Buku Paling Sering Dipinjam</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                @foreach($popularBooks as $book)
                    <div class="col-6 col-md-4 col-lg-2 text-center">
                        <div class="card h-100 border-0 shadow-none">
                            <img src="{{ $book->foto ? asset('storage/buku/' . $book->foto) : asset('assets/img/elements/18.jpg') }}" 
                                 class="card-img-top rounded shadow-sm mb-2 book-cover" 
                                 alt="{{ $book->judul }}">
                            <div class="card-body p-0">
                                <h6 class="card-title text-truncate mb-0" style="font-size: 0.85rem" title="{{ $book->judul }}">
                                    {{ $book->judul }}
                                </h6>
                                <p class="text-muted small mb-0">{{ $book->peminjaman_count ?? 0 }}x Pinjam</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Contoh inisialisasi Chart.js
            const ctx = document.getElementById('loanChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels ?? []) !!},
                    datasets: [{
                        label: 'Peminjaman',
                        data: {!! json_encode($chartData ?? []) !!},
                        borderColor: '#696cff',
                        tension: 0.4,
                        fill: true,
                        backgroundColor: 'rgba(105, 108, 255, 0.1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });
        });
    </script>
@endpush