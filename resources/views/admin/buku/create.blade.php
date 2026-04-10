@extends('layouts.admin')

@section('title', 'Tambah Data Buku | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Tambah Data Buku</h5>
                    <small class="text-muted float-end">Formulir Input Buku Baru</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Memanggil partial form --}}
                        @include('admin.buku._form')

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan Buku</button>
                                <a href="{{ route('admin.buku.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('upload').onchange = function() {
        let reader = new FileReader();
        reader.onload = (e) => { 
            document.getElementById('uploadedAvatar').src = e.target.result; 
        };
        reader.readAsDataURL(this.files[0]);
    };
</script>
@endpush