@extends('layouts.admin')

@section('title', 'Detail Rak | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Detail Data Rak</h5>
                    <small class="text-muted float-end">Informasi lengkap rak buku</small>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama_rak">Nama Rak</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" value="{{ $rak->nama_rak }}" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="lokasi">Lokasi</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <textarea class="form-control" rows="3" readonly>{{ $rak->lokasi }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('admin.rak.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection