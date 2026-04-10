@extends('layouts.admin')

@section('title', 'Tambah Data Rak | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Tambah Data Rak</h5>
                    <small class="text-muted float-end">Input informasi rak baru</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.rak.store') }}" method="POST">
                        @csrf
                        
                        {{-- Memanggil partial form --}}
                        @include('admin.rak._form')

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                                <a href="{{ route('admin.rak.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection