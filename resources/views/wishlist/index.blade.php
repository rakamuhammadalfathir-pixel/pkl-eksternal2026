@extends('layouts.user.wishlist')

@section('title', 'Wishlist Saya')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="text-center mb-5">
        <h3 class="fw-bold mb-2"><i class="bx bxs-heart text-danger me-2"></i>Wishlist Saya</h3>
        <p class="text-muted">Daftar buku yang ingin Anda baca nanti</p>
    </div>
    
    <div class="row">
        @forelse($wishlist as $item)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-0 card-wishlist">
                    <div class="text-center p-3 position-relative">
                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST" class="position-absolute top-0 end-0 m-2">
                            @csrf
                            <button type="submit" class="btn btn-icon btn-light btn-sm rounded-circle text-danger shadow-sm" title="Hapus">
                                <i class="bx bx-x fs-4"></i>
                            </button>
                        </form>

                        <img src="{{ $item->foto ? asset('storage/buku/' . $item->foto) : asset('assets/img/elements/18.jpg') }}" class="img-fluid rounded shadow-sm" style="height: 220px; width: 100%; object-fit: cover;" alt="{{ $item->judul }}"/>
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-label-primary px-2">{{ $item->kategori->nama_kategori ?? 'Umum' }}</span>
                        </div>
                        <h6 class="card-title mb-1 fw-bold text-dark">{{ Str::limit($item->judul, 40) }}</h6>
                        <small class="text-muted d-block mb-3">
                            <i class="bx bx-user-circle me-1"></i>{{ $item->pengarang }}
                        </small>
                        
                        <div class="mt-auto">
                            <a href="{{ route('katalog.show', $item->id) }}" class="btn btn-primary btn-sm w-100">
                                <i class="bx bx-show me-1"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="misc-wrapper">
                    <h2 class="mb-2 mx-2 text-muted">Belum ada buku...</h2>
                    <p class="mb-4 mx-2 text-muted small">Jelajahi perpustakaan dan tambahkan buku favoritmu di sini!</p>
                    <a href="{{ route('katalog.index') }}" class="btn btn-primary px-4">Cari Buku Sekarang</a>
                    <div class="mt-4">
                        <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" width="300" class="img-fluid" alt="empty-state">
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection