@extends('layouts.admin')

@section('title', 'Detail Kategori | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Detail Kategori</h5>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama_kategori">Nama Kategori</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="nama_kategori_icon" class="input-group-text"><i class="bx bx-tag"></i></span>
                                <input type="text" id="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" readonly />
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Dibuat Pada</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext text-muted">
                                {{ $kategori->created_at->format('d F Y, H:i') }}
                            </p>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-warning">
                                <i class="bx bx-edit-alt me-1"></i> Edit Kategori
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection