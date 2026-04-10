@extends('layouts.user')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pengaturan Akun /</span> Akun
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Detail Profil</h5>
                
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-primary alert-dismissible" role="alert">
                                <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ auth()->user()->avatar ? asset('uploads/avatars/' . auth()->user()->avatar) : asset('assets/img/avatars/1.png') }}" 
                                 alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Unggah foto baru</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="avatar" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                </label>
                                <p class="text-muted mb-0">Diizinkan JPG, GIF atau PNG. Maksimal 2MB</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-0" />

                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama</label>
                                <input class="form-control" type="text" name="name" value="{{ auth()->user()->name }}" autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">E-mail</label>
                                <input class="form-control" type="email" name="email" value="{{ auth()->user()->email }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" name="telepon" value="{{ auth()->user()->telepon }}" />
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3">{{ auth()->user()->alamat }}</textarea>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Kata Sandi Baru</label>
                                <input class="form-control" type="password" name="password" placeholder="············" />
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah sandi</small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                                <input class="form-control" type="password" name="password_confirmation" placeholder="············" autocomplete="new-password"/>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script>
    // Preview gambar saat dipilih
    document.getElementById('upload').onchange = evt => {
        const [file] = document.getElementById('upload').files
        if (file) {
            document.getElementById('uploadedAvatar').src = URL.createObjectURL(file)
        }
    }
</script>
@endsection