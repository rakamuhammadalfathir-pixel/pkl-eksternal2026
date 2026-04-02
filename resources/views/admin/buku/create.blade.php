<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Tambah Data Buku | E-Perpus</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.partials.sidebar')

            <div class="layout-page">
                @include('layouts.partials.navbar')
                
                <div class="content-wrapper">
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

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="judul">Judul Buku</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-book"></i></span>
                                                        <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                                            name="judul" id="judul" placeholder="Masukkan Judul Buku" value="{{ old('judul') }}" />
                                                    </div>
                                                    @error('judul') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="pengarang">Pengarang</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                        <input type="text" class="form-control @error('pengarang') is-invalid @enderror" 
                                                            name="pengarang" id="pengarang" placeholder="Nama Pengarang" value="{{ old('pengarang') }}" />
                                                    </div>
                                                    @error('pengarang') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="penerbit">Penerbit</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                                        <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                                                            name="penerbit" id="penerbit" placeholder="Nama Penerbit" value="{{ old('penerbit') }}" />
                                                    </div>
                                                    @error('penerbit') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-4 col-form-label" for="tahun">Tahun</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                                                <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                                                                    name="tahun" id="tahun" placeholder="YYYY" value="{{ old('tahun') }}" />
                                                            </div>
                                                            @error('tahun') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-4 col-form-label" for="stok">Stok</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="bx bx-archive"></i></span>
                                                                <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                                                    name="stok" id="stok" placeholder="0" value="{{ old('stok') }}" />
                                                            </div>
                                                            @error('stok') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="sinopsis">Sinopsis</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control @error('sinopsis') is-invalid @enderror" 
                                                        name="sinopsis" id="sinopsis" rows="3" placeholder="Ringkasan buku...">{{ old('sinopsis') }}</textarea>
                                                    @error('sinopsis') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Kategori & Rak</label>
                                                <div class="col-sm-5">
                                                    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach($kategoris as $item)
                                                            <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kategori_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                                <div class="col-sm-5">
                                                    <select name="rak_id" class="form-select @error('rak_id') is-invalid @enderror">
                                                        <option value="">Pilih Rak</option>
                                                        @foreach($raks as $item)
                                                            <option value="{{ $item->id }}" {{ old('rak_id') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->nama_rak }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('rak_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-sm-2 col-form-label">Foto Sampul</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="foto" id="upload" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                                                    <div class="mt-2">
                                                        <img src="{{ asset('assets/img/elements/18.jpg') }}" alt="Preview" class="d-block rounded" height="100" id="uploadedAvatar" />
                                                    </div>
                                                    @error('foto') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                            </div>

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
                    @include('layouts.partials.footer')
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>

    <script>
        document.getElementById('upload').onchange = function() {
            let reader = new FileReader();
            reader.onload = (e) => { 
                document.getElementById('uploadedAvatar').src = e.target.result; 
            };
            reader.readAsDataURL(this.files[0]);
        };
    </script>
</body>
</html>