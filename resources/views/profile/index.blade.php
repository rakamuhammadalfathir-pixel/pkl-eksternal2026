<!DOCTYPE html>
<html
  lang="en"
  /* 1. UBAH: Ganti layout-menu-fixed menjadi layout-without-menu */
  class="light-style layout-without-menu"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Wishlist Saya</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    
    <style>
        /* 2. TAMBAHKAN: CSS agar konten tidak tertutup navbar fixed dan lebar penuh */
        body {
            padding-top: 70px !important;
        }
        .layout-page {
            padding-left: 0 !important;
        }
    </style>

    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/js/config.js') }}"></script>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        
        <div class="layout-page">
          @include('layouts.partials.navbar-landing')

          <div class="content-wrapper">
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
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                                                    <input class="form-control" type="password" name="password_confirmation" placeholder="············" />
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

                    @include('layouts.partials.footer')
                    <div class="content-backdrop fade"></div>
               </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script>
        // Script untuk preview gambar setelah upload
        document.getElementById('upload').onchange = evt => {
            const [file] = document.getElementById('upload').files
            if (file) {
                document.getElementById('uploadedAvatar').src = URL.createObjectURL(file)
            }
        }
    </script>
</body>
</html>