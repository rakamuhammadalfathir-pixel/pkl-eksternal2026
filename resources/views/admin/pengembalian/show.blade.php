@extends('layouts.admin')

@section('title', 'Detail Pengembalian | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Detail Pengembalian</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Peminjaman</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $pengembalian->peminjaman->kode_transaksi }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Kembali Aktual</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($pengembalian->tgl_kembali_aktual)->format('d F Y') }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Denda</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" value="{{ number_format($pengembalian->denda, 0, ',', '.') }}" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection