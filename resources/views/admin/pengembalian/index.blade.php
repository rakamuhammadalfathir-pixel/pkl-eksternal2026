@extends('layouts.admin')

@section('title', 'Data Pengembalian | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.pengembalian.export_excel', ['search' => request('search')]) }}" class="btn btn-success">
            <i class="bx bxs-file-export me-1"></i> Export Excel
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <form action="{{ route('admin.pengembalian.index') }}" method="GET">
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari Kode atau Nama Anggota..." value="{{ request('search') }}" />
                    @if(request('search'))
                        <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-secondary">
                            <i class="bx bx-x"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">Table pengembalian</h5>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-primary alert-dismissible" role="alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="bulkDeleteForm" action="{{ route('admin.pengembalian.bulkDelete') }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <button type="submit" id="btnDeleteSelected" class="btn btn-danger" onclick="return confirm('Hapus data pengembalian terpilih?')" disabled>
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
                                <th class="text-center">Peminjaman</th>
                                <th class="text-center">Tanggal Kembali Aktual</th>
                                <th class="text-center">Denda</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengembalians as $item)
                                <tr>
                                    <td class="text-center">
                                        <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}">
                                    </td>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->peminjaman->kode_transaksi }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tgl_kembali_aktual)->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                        {{-- Menggunakan abs() untuk menghilangkan tanda minus --}}
                                        @php $nominalDenda = abs($item->denda); @endphp
                                        
                                        <span class="text fw-bold {{ $nominalDenda > 0 ? 'text-danger' : 'text-dark' }}">
                                            Rp {{ number_format($nominalDenda, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-row justify-content-center gap-2">
                                            <a href="{{ route('admin.pengembalian.show', $item->id) }}" class="btn btn-sm btn-info" title="Detail">
                                                <i class="bx bx-show"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

            <form id="singleDeleteForm" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
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

    function deleteSingle(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            const form = document.getElementById('singleDeleteForm');
            form.action = `/admin/pengembalian/${id}`;
            form.submit();
        }
    }
</script>
@endpush