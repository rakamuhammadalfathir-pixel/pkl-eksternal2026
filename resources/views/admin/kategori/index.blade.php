@extends('layouts.admin')

@section('title', 'Data Kategori | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    
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
                                        <a href="{{ route('admin.kategori.show', $item->id) }}" class="btn btn-sm btn-info" title="Show Kategori">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('admin.kategori.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit Kategori">
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
@endsection

@push('scripts')
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
                if (!this.checked) {
                    selectAll.checked = false;
                }
                if (document.querySelectorAll('.item-checkbox:checked').length === checkboxes.length) {
                    selectAll.checked = true;
                }
                updateButtonStatus();
            });
        });
    });
</script>
@endpush