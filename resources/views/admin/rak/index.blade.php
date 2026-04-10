@extends('layouts.admin')

@section('title', 'Data Rak | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    
    <div class="mb-4">
        <a href="{{ route('admin.rak.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Rak
        </a>
    </div>

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
                            @forelse($raks as $item)
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}">
                                </td>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->nama_rak }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td class="text-center">
                                    <div class="d-flex flex-row justify-content-center gap-2">
                                        <a href="{{ route('admin.rak.show', $item->id) }}" class="btn btn-sm btn-info" title="Show" data-bs-toggle="tooltip">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('admin.rak.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit" data-bs-toggle="tooltip">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Data Rak kosong.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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
@endsection