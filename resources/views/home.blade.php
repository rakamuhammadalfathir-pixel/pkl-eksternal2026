@extends('layouts.app')

@section('title', 'Digital Library')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    
    {{-- Hero Section --}}
    <div class="hero-section">
        <div class="row align-items-center">
            <div class="col-md-7 p-5 ps-md-5">
                <h1 class="display-5 fw-bold text-white mb-3">
                    Tingkatkan Pengetahuan <br> Tanpa Batas 📚
                </h1>
                <p class="fs-5 text-white mb-4 opacity-75">
                    Akses ribuan koleksi buku digital dan fisik dengan mudah. <br>
                    Pinjam kapan saja, baca di mana saja bersama E-Perpus.
                </p>
                <div class="d-flex gap-3">
                    <a href="#katalog" class="btn btn-lg btn-rounded text-white fw-bold shadow-lg px-4 border border-white" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px);">
                        <i class="bx bx-book-open me-2"></i> Mulai Membaca
                    </a>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-lg btn-rounded text-white fw-bold shadow-lg px-4 border border-white" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px);">
                        Daftar Anggota
                    </a>
                    @endguest
                </div>
            </div>
            <div class="col-md-5 text-center d-none d-md-block">
                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="320" alt="Hero Illustration" class="img-fluid p-4">
            </div>
        </div>
    </div>

    {{-- Kategori --}}
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold m-0 text-heading">Eksplorasi Kategori</h4>
            <div class="flex-grow-1 mx-3 border-bottom opacity-25"></div>
        </div>
        <div class="row g-4">
            @foreach($kategori as $cat)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('katalog.index', ['kategori' => $cat->id]) }}" class="text-decoration-none">
                    <div class="card category-card text-center p-4 h-100 border-0">
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-label-primary">
                                <i class="bx bx-grid-alt"></i>
                            </span>
                        </div>
                        <h6 class="fw-bold mb-1 text-dark">{{ $cat->nama_kategori }}</h6>
                        <small class="text-muted">{{ $cat->buku_count ?? 0 }} Koleksi</small>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Katalog --}}
    <div id="katalog">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Buku Terbaru</h3>
                <p class="text-muted mb-0">Rekomendasi bacaan untuk Anda</p>
            </div>
            <a href="{{ route('katalog.index') }}" class="btn btn-label-primary btn-rounded px-4">
                Lihat Semua <i class="bx bx-right-arrow-alt ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($buku as $item)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 book-card">
                    <div class="p-3">
                        <img src="{{ $item->foto ? asset('storage/buku/'.$item->foto) : asset('assets/img/elements/18.jpg') }}" class="w-100 rounded shadow-sm" alt="{{ $item->judul }}" style="height: 300px; object-fit: cover;">
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <small class="text-primary fw-bold text-uppercase" style="font-size: 0.7rem;">
                                {{ $item->kategori->nama_kategori ?? 'Umum' }}
                            </small>
                            <span class="badge rounded-pill bg-{{ $item->stok > 0 ? 'success' : 'danger' }} small">
                                {{ $item->stok > 0 ? 'Ada' : 'Habis' }}
                            </span>
                        </div>
                        <h5 class="card-title mb-2 fw-bold text-dark text-truncate">{{ $item->judul }}</h5>
                        <p class="text-muted small mb-4"><i class="bx bx-pencil me-1"></i> {{ $item->pengarang }}</p>
                        
                        @auth
                            <a href="{{ route('katalog.show', $item->id) }}" class="btn btn-primary w-100 btn-rounded shadow-sm">
                                Pinjam Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100 btn-rounded">
                                Login untuk Pinjam
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">Belum ada koleksi buku tersedia.</h5>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection