<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Data Kategori</title>

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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Data Kategori</h4>
                        
                        <div class="mb-4">
                            <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
                                Tambah Kategori
                            </a>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-primary alert-dismissible" role="alert">
                            <span>{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="card">
                            <h5 class="card-header">Table Kategori</h5>
                            <div class="card-body">
                                <form id="bulkDeleteForm" action="{{ route('admin.kategori.bulkDelete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <div class="mb-3">
                                        <button type="submit" id="btnDeleteSelected" class="btn btn-danger" onclick="return confirm('Hapus semua data yang dipilih?')" disabled>
                                            <i class="bx bx-trash me-1"></i> Hapus yang Terpilih
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
                                                    <th>Nama Kategori</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @foreach($kategoris as $item)
                                                <tr>
                                                    <td class="text-center">
                                                        <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}">
                                                    </td>
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    <td>{{ $item->nama_kategori }}</td>
                                                    <td class="text-center">
                                                        <div class="d-flex flex-row justify-content-center gap-2">
                                                            <a href="{{ route('admin.kategori.show', $item->id) }}" class="btn btn-sm btn-info" title="Show Kategori" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                <i class="bx bx-show"></i>
                                                            </a>
                                                            <a href="{{ route('admin.kategori.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit Kategori" data-bs-toggle="tooltip" data-bs-placement="top">
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
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

    <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <script src="{{ asset('/assets/js/main.js') }}"></script>

    <script src="{{ asset('/assets/js/dashboards-analytics.js') }}"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const btnDelete = document.getElementById('btnDeleteSelected');

            // Fungsi untuk update status tombol hapus
            function updateButtonStatus() {
                const checkedCount = document.querySelectorAll('.item-checkbox:checked').length;
                btnDelete.disabled = checkedCount === 0;
            }

            // Event Klik Select All
            selectAll.addEventListener('click', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAll.checked;
                });
                updateButtonStatus();
            });

            // Event Klik Checkbox satuan
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Jika ada satu yang tidak dicentang, matikan centang 'Select All'
                    if (!this.checked) {
                        selectAll.checked = false;
                    }
                    // Jika semua dicentang manual, hidupkan centang 'Select All'
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