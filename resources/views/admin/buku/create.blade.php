<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Tambah Data Buku</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

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
                                                <label class="col-sm-2 col-form-label" for="judul">Judul</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-book"></i></span>
                                                        <input type="text" class="form-control" placeholder="Masukkan Judul Buku" name="judul" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="pengarang">Pengarang</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="Nama Pengarang" name="pengarang" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="penerbit">Penerbit</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                                        <input type="text" class="form-control" placeholder="Nama Penerbit" name="penerbit" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="tahun">Tahun</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                                        <input type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun" placeholder="Contoh: 2024" min="1900" max="2026" value="{{ old('tahun') }}" required />
                                                        @error('tahun')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <small class="text-muted">Masukkan 4 digit angka tahun</small>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="stok">Stok</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-archive"></i></span>
                                                        <input type="number" class="form-control" name="stok" placeholder="Jumlah Stok" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="sinopsis">Sinopsis</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-align-left"></i></span>
                                                        <textarea class="form-control" name="sinopsis" rows="3" placeholder="Ringkasan buku..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Kategori</label>
                                                <div class="col-sm-10">
                                                    <select name="kategori_id" class="form-select" required>
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach($kategoris as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Rak</label>
                                                <div class="col-sm-10">
                                                    <select name="rak_id" class="form-select" required>
                                                        <option value="">Pilih Rak</option>
                                                        @foreach($raks as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_rak }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Foto Sampul</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="foto" class="form-control" accept="image/*">
                                                    <small class="text-muted">Format: JPG, PNG, JPEG. Maks: 2MB</small>
                                                </div>
                                            </div>
                                            <div class="row justify-content-end">
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                    <div class="content-backdrop fade"></div>
                </div>
                </div>
            </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>

    <script src="{{ asset('/assets/js/main.js') }}"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>