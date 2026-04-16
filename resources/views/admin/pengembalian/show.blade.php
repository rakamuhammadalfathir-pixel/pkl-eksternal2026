@extends('layouts.admin')

@section('title', 'Detail Pengembalian | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0"><i class="bx bx-detail me-2"></i>Detail Pengembalian</h5>
                </div>
                <div class="card-body">
                    {{-- 1. Informasi Peminjaman --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kode Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $pengembalian->peminjaman->kode_transaksi }}" readonly />
                        </div>
                    </div>

                    {{-- 2. Tanggal Kembali Real --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Kembali Real</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" 
                                value="{{ \Carbon\Carbon::parse($pengembalian->tgl_kembali_aktual)->format('d F Y') }}" readonly />
                        </div>
                    </div>

                    {{-- 3. Total Denda (Nominal Positif) --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Total Denda</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" 
                                    value="{{ number_format(abs($pengembalian->denda), 0, ',', '.') }}" readonly />
                            </div>
                        </div>
                    </div>

                    {{-- 4. Status Denda (Logika yang diperbaiki) --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">STATUS DENDA</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            {{-- 1. Cek jika denda sudah lunas --}}
                            @if($pengembalian->status_denda == 'Lunas')
                                <span class="badge bg-label-success px-3">
                                    <i class="bx bx-check-circle me-1"></i> LUNAS
                                </span>

                            {{-- 2. Jika denda > 0 (masih ada denda) --}}
                            @elseif(abs($pengembalian->denda) > 0)
                                <span class="badge bg-label-danger px-3">
                                    <i class="bx bx-info-circle me-1"></i> BELUM BAYAR
                                </span>

                            {{-- 3. Jika denda 0 --}}
                            @else
                                <span class="badge bg-label-secondary px-3">
                                    <i class="bx bx-minus-circle me-1"></i> TIDAK ADA DENDA
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- 5. Tanggal Bayar Denda --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Waktu Pembayaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" 
                                value="{{ $pengembalian->tanggal_bayar ? \Carbon\Carbon::parse($pengembalian->tanggal_bayar)->format('d F Y - H:i') : 'Belum melakukan pembayaran' }}" 
                                readonly />
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- Tombol Aksi --}}
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection