@extends('layouts.user.profile')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Pengaturan Akun</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                    <li class="breadcrumb-item active">Profil</li>
                </ol>
            </nav>
        </div>
        <div class="text-muted">
            Terakhir diperbarui: <span class="fw-medium">{{ auth()->user()->updated_at->diffForHumans() }}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-header-bg" style="height: 120px;"></div>
                
                <div class="card-body pt-0">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="d-flex align-items-end mt-n5 mb-4 gap-4">
                            <div class="avatar-preview-wrapper position-relative">
                                <img src="{{ auth()->user()->avatar ? asset('uploads/avatars/' . auth()->user()->avatar) : asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="rounded-circle border border-5 border-white shadow" height="140" width="140" id="uploadedAvatar" />
                                <label for="upload" class="btn btn-sm btn-icon btn-primary rounded-circle position-absolute bottom-0 end-0 mb-2 me-2 shadow">
                                    <i class="bx bx-camera"></i>
                                    <input type="file" id="upload" name="avatar" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                </label>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-1 fw-bold">{{ auth()->user()->name }}</h5>
                                <p class="text-muted mb-0">Disarankan: JPG atau PNG (Maks. 2MB)</p>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center border-0 shadow-sm mb-4" role="alert">
                                <i class="bx bx-check-circle me-2 fs-4"></i>
                                <div>{{ session('success') }}</div>
                            </div>
                        @endif

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-uppercase" style="font-size: 0.75rem;">Nama Lengkap</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input class="form-control form-control-lg" type="text" name="name" value="{{ auth()->user()->name }}" placeholder="Masukkan nama" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-uppercase" style="font-size: 0.75rem;">Alamat Email</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input class="form-control form-control-lg" type="email" name="email" value="{{ auth()->user()->email }}" placeholder="email@contoh.com" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-uppercase" style="font-size: 0.75rem;">Nomor Telepon</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                    <input type="text" class="form-control form-control-lg" name="telepon" value="{{ auth()->user()->telepon }}" placeholder="08xxxx" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-uppercase" style="font-size: 0.75rem;">Alamat Lengkap</label>
                                <textarea class="form-control form-control-lg px-3" name="alamat" rows="3" placeholder="Tulis alamat lengkap...">{{ auth()->user()->alamat }}</textarea>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="p-3 rounded bg-light border-start border-primary border-4 mb-4">
                                    <h6 class="mb-1 text-primary fw-bold">Keamanan Akun</h6>
                                    <p class="mb-0 text-muted small">Kosongkan kolom di bawah jika tidak ingin mengganti kata sandi.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-uppercase" style="font-size: 0.75rem;">Kata Sandi Baru</label>
                                <input class="form-control form-control-lg" type="password" name="password" placeholder="············" autocomplete="new-password"/>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-uppercase" style="font-size: 0.75rem;">Konfirmasi Sandi</label>
                                <input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="············" />
                            </div>
                        </div>

                        <div class="mt-5 d-flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm px-5">
                                <i class="bx bx-save me-2"></i> Simpan Perubahan
                            </button>
                            <button type="reset" class="btn btn-outline-secondary btn-lg px-4">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection