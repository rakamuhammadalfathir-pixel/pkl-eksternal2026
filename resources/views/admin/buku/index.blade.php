@extends('layouts.admin')

@section('title', 'Data Buku')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div class="d-flex gap-2">
        <a href="{{ route('admin.buku.create') }}" class="btn btn-primary">Tambah Buku</a>
        <a href="{{ route('admin.buku.export_excel', ['search' => request('search')]) }}" class="btn btn-success">
            <i class="bx bxs-file-export me-1"></i> Export Excel
        </a>
    </div>

    <div class="col-md-4">
        <form action="{{ route('admin.buku.index') }}" method="GET">
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari buku atau kategori..." value="{{ request('search') }}" />
                @if(request('search'))
                    <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary">
                        <i class="bx bx-x"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card">
    <h5 class="card-header">Tabel Koleksi Buku</h5>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form id="bulkDeleteForm" action="{{ route('admin.buku.bulkDelete') }}" method="POST">
            @csrf
            @method('DELETE')
            
            <div class="mb-3">
                <button type="submit" id="btnDeleteSelected" class="btn btn-danger" onclick="return confirm('Hapus buku yang dipilih?')" disabled>
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
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Kategori</th>
                            <th class="text-center">Rak</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($buku as $index => $item)
                        <tr>
                            <td class="text-center">
                                <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}">
                            </td>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->pengarang }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td class="text-center">{{ $item->rak->nama_rak }}</td>
                            <td class="text-center">{{ $item->stok }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.buku.show', $item->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="bx bx-show"></i>
                                    </a>
                                    <a href="{{ route('admin.buku.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Data tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
@endsection

@push('page-js')
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
@endpush