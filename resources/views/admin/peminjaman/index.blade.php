<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Data Peminjaman</title>

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
                        <h4 class="fw-bold py-3 mb-4">Data Peminjaman</h4>

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.peminjaman.export_excel', ['search' => request('search')]) }}" class="btn btn-success">
                                <i class="bx bxs-file-export me-1"></i> Export Excel
                            </a>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <form action="{{ route('admin.peminjaman.index') }}" method="GET">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-search"></i></span>
                                        <input type="text" name="search" class="form-control" placeholder="Cari Kode, Anggota, atau Buku..." value="{{ request('search') }}" />
                                        @if(request('search'))
                                        <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-x"></i>
                                        </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">Table peminjaman</h5>
                            <div class="card-body">
                                @if(session('success'))
                                <div class="alert alert-primary alert-dismissible" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                <form id="bulkDeleteForm" action="{{ route('admin.peminjaman.bulkDelete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="mb-3">
                                        <button type="submit" id="btnDeleteSelected" class="btn btn-danger" onclick="return confirm('Hapus data terpilih?')" disabled>
                                            <i class="bx bx-trash me-1"></i> Hapus Terpilih
                                        </button>
                                    </div>

                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">
                                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                                    </th>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Kode Transaksi</th>
                                                    <th>Nama Anggota</th>
                                                    <th>Buku</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @foreach($peminjamans as $item)
                                                <tr>
                                                    <td class="text-center">
                                                        <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}">
                                                    </td>
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    <td class="text-center">{{ $item->kode_transaksi }}</td>
                                                    <td>{{ $item->anggota->nama }}</td>
                                                    <td>{{ $item->buku->judul }}</td>
                                                    <td class="text-center">
                                                        @if($item->status == 'Pending')
                                                            <span class="badge bg-label-warning">Menunggu Persetujuan</span>
                                                        @elseif($item->status == 'Pinjam')
                                                            <span class="badge bg-label-primary">Sedang Dipinjam</span>
                                                        @elseif($item->status == 'Kembali')
                                                            <span class="badge bg-label-success">Sudah Kembali</span>
                                                        @elseif($item->status == 'Ditolak')
                                                            <span class="badge bg-label-danger">Ditolak</span>
                                                        @else
                                                            <span class="badge bg-label-secondary">{{ $item->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex flex-row justify-content-center gap-2">
                                                            @if($item->status == 'Pending')
                                                            <button type="submit" form="form-approve-{{ $item->id }}" class="btn btn-sm btn-success" onclick="return confirm('Setujui peminjaman?')" title="Setujui Peminjaman" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                <i class="bx bx-check"></i>
                                                            </button>
                                                            <button type="submit" form="form-reject-{{ $item->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Tolak peminjaman?')" title="Tolak Peminjaman" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                <i class="bx bx-x"></i>
                                                            </button>
                                                            @endif
                                                            <a href="{{ route('admin.peminjaman.show', $item->id) }}" class="btn btn-sm btn-info" title="Show Peminjaman" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                <i class="bx bx-show"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </form>

                                {{-- Hidden Forms --}}
                                @foreach($peminjamans as $item)
                                    @if($item->status == 'Pending')
                                        <form id="form-approve-{{ $item->id }}" action="{{ route('admin.peminjaman.approve', $item->id) }}" method="POST" style="display:none;">@csrf</form>
                                        <form id="form-reject-{{ $item->id }}" action="{{ route('admin.peminjaman.reject', $item->id) }}" method="POST" style="display:none;">@csrf</form>
                                    @endif
                                @endforeach
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const btnDelete = document.getElementById('btnDeleteSelected');

            function updateButtonStatus() {
                const checkedCount = document.querySelectorAll('.item-checkbox:checked').length;
                btnDelete.disabled = (checkedCount === 0);
            }

            if (selectAll) {
                selectAll.addEventListener('click', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = selectAll.checked;
                    });
                    updateButtonStatus();
                });
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (!this.checked) selectAll.checked = false;
                    if (document.querySelectorAll('.item-checkbox:checked').length === checkboxes.length) {
                        selectAll.checked = true;
                    }
                    updateButtonStatus();
                });
            });
        });
    </script>
</body>
</html>