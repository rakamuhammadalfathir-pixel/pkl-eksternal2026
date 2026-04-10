@extends('layouts.admin')

@section('title', 'Detail Peminjaman | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Detail Peminjaman</h5>
                    <small class="text-muted float-end">Informasi lengkap transaksi</small>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kode Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $peminjaman->kode_transaksi }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Anggota</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $peminjaman->anggota->nama }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $peminjaman->buku->judul }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d F Y') }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Harus Kembali</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($peminjaman->tgl_harus_kembali)->format('d F Y') }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            @php
                                $badgeClass = 'bg-label-secondary';
                                if($peminjaman->status == 'Pinjam') $badgeClass = 'bg-label-primary';
                                elseif($peminjaman->status == 'Kembali') $badgeClass = 'bg-label-success';
                                elseif($peminjaman->status == 'Pending') $badgeClass = 'bg-label-warning';
                                elseif($peminjaman->status == 'Ditolak') $badgeClass = 'bg-label-danger';
                            @endphp
                            <span class="badge {{ $badgeClass }} p-2">{{ $peminjaman->status }}</span>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">
                                <i class="bx bx-chevron-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection