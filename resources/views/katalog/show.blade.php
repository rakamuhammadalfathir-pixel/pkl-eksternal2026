@extends('layouts.user.katalog')

@section('title', 'Detail Buku | ' . $buku->judul)

@section('page-style')
<style>
    .book-detail-card { border-radius: 15px; overflow: hidden; }
    .img-container { 
        background: #f8f9fa; 
        border-radius: 12px; 
        padding: 20px; 
        display: flex; 
        justify-content: center; 
    }
</style>
@endsection

@section('content')
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
                    <img src="{{ $buku->foto ? asset('storage/buku/' . $buku->foto) : asset('assets/img/elements/buku.jpg') }}" alt="{{ $buku->judul }}" class="img-fluid rounded shadow" style="max-height: 500px; width: 100%; object-fit: cover;" />
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
                            <span class="fw-bold d-block">{{ $buku->penerbit }}</span>
                        </div>
                        <div class="col-6 col-sm-4">
                            <small class="text-muted d-block text-uppercase small">Tahun</small>
                            <span class="fw-bold d-block">{{ $buku->tahun }}</span>
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
                            <form action="{{ route('wishlist.toggle', $buku->id) }}" method="POST" id="formWishlist">
                                @csrf
                                @php $isWishlisted = auth()->user()->wishlist->contains($buku->id); @endphp
                                <button type="button" class="btn {{ $isWishlisted ? 'btn-danger' : 'btn-outline-danger' }} btn-lg px-4" 
                                        onclick="confirmWishlist('{{ $isWishlisted ? 'hapus' : 'tambah' }}')">
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
@endsection

@section('page-script')
<script>
    // Fungsi Konfirmasi Pinjam
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
            if (result.isConfirmed) { 
                document.getElementById('formPinjam').submit(); 
            }
        });
    }

    // Fungsi Konfirmasi Wishlist
    function confirmWishlist(action) {
        const titleText = action === 'tambah' ? 'Simpan ke Wishlist?' : 'Hapus dari Wishlist?';
        const confirmBtn = action === 'tambah' ? 'Ya, Simpan!' : 'Ya, Hapus!';
        
        Swal.fire({
            title: titleText,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: confirmBtn,
            cancelButtonText: 'Batal',
            customClass: { 
                confirmButton: action === 'tambah' ? 'btn btn-primary me-3' : 'btn btn-danger me-3', 
                cancelButton: 'btn btn-outline-secondary' 
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) { 
                document.getElementById('formWishlist').submit(); 
            }
        });
    }
</script>
@endsection