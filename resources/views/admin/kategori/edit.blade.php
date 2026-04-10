@extends('layouts.admin')

@section('title', 'Edit Data Kategori | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Data Kategori</h5>
                    <small class="text-muted float-end">Perbarui informasi kategori</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama_kategori">Nama Kategori</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="text" name="nama_kategori" id="nama_kategori"class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Masukkan Nama Kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" />
                                </div>
                                @error('nama_kategori')
                                    <div class="text-danger mt-1" style="font-size: 0.85rem;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection