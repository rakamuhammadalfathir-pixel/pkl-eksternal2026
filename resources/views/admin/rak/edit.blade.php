@extends('layouts.admin')

@section('title', 'Edit Data Rak | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Data Rak</h5>
                    <small class="text-muted float-end">Perbarui informasi rak</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.rak.update', $rak->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        {{-- Menggunakan form yang sama dengan halaman create --}}
                        @include('admin.rak._form')

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-refresh me-1"></i> Perbarui Data
                                </button>
                                <a href="{{ route('admin.rak.index') }}" class="btn btn-outline-secondary">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection