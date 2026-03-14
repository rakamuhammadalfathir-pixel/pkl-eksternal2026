<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Data Rak</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('/assets/vendor/js/helpers.js') }}" ></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/assets/js/config.js') }}" ></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('layouts.partials.sidebar')
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('layouts.partials.navbar')
          <!-- / Navbar -->   
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Data Rak</h4>
                <div class="mb-4">
                  <a href="{{ route('admin.rak.create') }}" class="btn btn-primary">
                    Tambah Rak
                  </a>
                </div>
              <!-- Bordered Table -->
              @if(session('success'))
                  <div class="alert alert-primary alert-dismissible" role="alert">
                      <span>{{ session('success') }}</span>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endif
              <div class="card">
                <h5 class="card-header">Table Rak</h5>
                <div class="card-body">
                  <form id="bulkDeleteForm" action="{{ route('admin.rak.bulkDelete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                      <button type="submit" id="btnDeleteSelected" class="btn btn-danger" onclick="return confirm('Hapus semua data rak yang dipilih?')" disabled>
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
                            <th class="text-center">Nama Rak</th>
                            <th>Lokasi</th>
                            <th class="text-center">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $no = 1; @endphp
                          @foreach($raks as $item)
                          <tr>
                            <td class="text-center">
                              <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}">
                            </td>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $item->nama_rak }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td class="text-center">
                              <div class="d-flex flex-row justify-content-center gap-2">
                                <a href="{{ route('admin.rak.show', $item->id) }}" class="btn btn-sm btn-info">
                                  <i class="bx bx-show"></i>
                                </a>
                                <a href="{{ route('admin.rak.edit', $item->id) }}" class="btn btn-sm btn-warning">
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
              <!--/ Bordered Table -->
            </div>
            <!-- Footer -->
            @include('layouts.partials.footer')
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}" ></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}" ></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}" ></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}" ></script>

    <script src="{{ asset('/assets/vendor/js/menu.js') }}" ></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}" ></script>

    <!-- Main JS -->
    <script src="{{ asset('/assets/js/main.js') }}" ></script>

    <!-- Page JS -->
    <script src="{{ asset('/assets/js/dashboards-analytics.js') }}" ></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const btnDelete = document.getElementById('btnDeleteSelected');

        function updateButtonStatus() {
          const checkedCount = document.querySelectorAll('.item-checkbox:checked').length;
          btnDelete.disabled = checkedCount === 0;
        }

        selectAll.addEventListener('click', function() {
          checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
          });
          updateButtonStatus();
        });

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
