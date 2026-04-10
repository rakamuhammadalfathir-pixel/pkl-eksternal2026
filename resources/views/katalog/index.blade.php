@extends('layouts.user.katalog')

@section('title', 'Katalog Buku')

@section('content')
<div class="row">
    {{-- Sidebar Filter --}}
    <div class="col-lg-3 mb-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
            <div class="card-header bg-white fw-bold border-bottom">Filter Katalog</div>
            <div class="card-body pt-4">
                <form action="{{ route('katalog.index') }}" method="GET">
                    @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                    
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Kategori</h6>
                        @foreach($kategoris as $kat)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="kategori" value="{{ $kat->id }}" 
                                    id="kat{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                <label class="form-check-label" for="kat{{ $kat->id }}">{{ $kat->nama_kategori }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Lokasi Rak</h6>
                        <select name="rak" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Rak</option>
                            @foreach($raks as $rak)
                                <option value="{{ $rak->id }}" {{ request('rak') == $rak->id ? 'selected' : '' }}>
                                    {{ $rak->nama_rak }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ route('katalog.index') }}" class="btn btn-outline-primary w-100">Reset Filter</a>
                </form>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold"><span class="text-muted fw-light">Koleksi</span> Perpustakaan</h4>
            <form action="{{ route('katalog.index') }}" method="GET" class="d-flex gap-2">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari judul..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($buku as $item)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="p-2"> 
                            <img src="{{ $item->foto ? asset('storage/buku/'.$item->foto) : asset('assets/img/elements/18.jpg') }}" 
                                class="card-img-top rounded" style="height: 280px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <span class="badge bg-label-primary mb-2">{{ $item->kategori->nama_kategori }}</span>
                            <h5 class="card-title mb-1 fw-bold text-truncate">{{ $item->judul }}</h5>
                            <p class="text-muted small mb-3">By {{ $item->pengarang }}</p>
                            <a href="{{ route('katalog.show', $item->id) }}" class="btn btn-primary btn-sm w-100">
                                <i class="bx bx-show me-1"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h5>Buku tidak ditemukan</h5>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection