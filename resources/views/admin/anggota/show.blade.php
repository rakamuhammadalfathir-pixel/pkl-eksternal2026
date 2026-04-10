@extends('layouts.admin')

@section('title', 'Detail Anggota')

@section('content')

<div class="row">
    <div class="col-xxl">
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between border-bottom mb-3">
                <h5 class="mb-0">Informasi Lengkap Anggota</h5>
                <small class="text-muted float-end">ID: #{{ $anggota->id }}</small>
            </div>
            <div class="card-body">
                {{-- Memanggil form inputan --}}
                @include('admin.anggota._form', ['readonly' => true])

                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-label-secondary">
                        <i class="bx bx-chevron-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection