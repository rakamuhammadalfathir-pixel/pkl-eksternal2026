@extends('layouts.admin')

@section('title', 'Detail Buku - ' . $buku->judul)

@section('content')

<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between border-bottom">
                <h5 class="mb-0">Informasi Lengkap Buku</h5>
                <small class="text-muted float-end">Mode Lihat Data</small>
            </div>
            <div class="card-body mt-4">
                
                {{-- Judul Buku --}}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="judul">Judul Buku</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-book"></i></span>
                            <input type="text" class="form-control" value="{{ $buku->judul }}" readonly />
                        </div>
                    </div>
                </div>

                {{-- Pengarang --}}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="pengarang">Pengarang</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                            <input type="text" class="form-control" value="{{ $buku->pengarang }}" readonly />
                        </div>
                    </div>
                </div>

                {{-- Penerbit --}}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="penerbit">Penerbit</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                            <input type="text" class="form-control" value="{{ $buku->penerbit }}" readonly />
                        </div>
                    </div>
                </div>

                {{-- Tahun & Stok --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="tahun">Tahun</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                    <input type="text" class="form-control" value="{{ $buku->tahun }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label" for="stok">Stok</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-archive"></i></span>
                                    <input type="text" class="form-control" value="{{ $buku->stok }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sinopsis --}}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="sinopsis">Sinopsis</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="4" readonly>{{ $buku->sinopsis }}</textarea>
                    </div>
                </div>

                {{-- Kategori & Rak --}}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Kategori & Rak</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $buku->kategori->nama_kategori }}" readonly />
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $buku->rak->nama_rak }}" readonly />
                    </div>
                </div>

                {{-- Foto Sampul --}}
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label">Foto Sampul</label>
                    <div class="col-sm-10">
                        <div class="mt-2">
                            <img src="{{ $buku->foto ? asset('storage/'.$buku->foto) : asset('assets/img/elements/18.jpg') }}" 
                                 alt="Sampul Buku" class="d-block rounded shadow" height="200" />
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="row">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary me-2">
                            <i class="bx bx-chevron-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('admin.buku.edit', $buku->id) }}" class="btn btn-warning">
                            <i class="bx bx-edit-alt me-1"></i> Edit Data
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection