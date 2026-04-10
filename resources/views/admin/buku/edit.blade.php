@extends('layouts.admin')

@section('title', 'Edit Data Buku: ' . $buku->judul)

@section('content')
<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Data Buku</h5>
                <small class="text-muted float-end">Perbarui Informasi Buku</small>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    {{-- Panggil file form.blade.php kamu di sini --}}
                    @include('admin.buku._form')

                    <div class="row justify-content-end mt-2">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update Data Buku</button>
                            <a href="{{ route('admin.buku.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
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