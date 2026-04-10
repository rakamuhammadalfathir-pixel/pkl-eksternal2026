@extends('layouts.admin')

@section('title', 'Data Peminjaman | E-Perpus')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

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
                            @forelse($peminjamans as $item)
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}">
                                </td>
                                <td class="text-center">{{ $loop->iteration }}</td>
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
                                        <button type="button" onclick="event.preventDefault(); document.getElementById('form-approve-{{ $item->id }}').submit();" class="btn btn-sm btn-success" onclick="return confirm('Setujui peminjaman?')" title="Setujui">
                                            <i class="bx bx-check"></i>
                                        </button>
                                        <button type="button" onclick="event.preventDefault(); document.getElementById('form-reject-{{ $item->id }}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Tolak peminjaman?')" title="Tolak">
                                            <i class="bx bx-x"></i>
                                        </button>
                                        @endif
                                        <a href="{{ route('admin.peminjaman.show', $item->id) }}" class="btn btn-sm btn-info" title="Detail">
                                            <i class="bx bx-show"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Data tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

            {{-- Hidden Forms for Actions --}}
            @foreach($peminjamans as $item)
                @if($item->status == 'Pending')
                    <form id="form-approve-{{ $item->id }}" action="{{ route('admin.peminjaman.approve', $item->id) }}" method="POST" style="display:none;">@csrf</form>
                    <form id="form-reject-{{ $item->id }}" action="{{ route('admin.peminjaman.reject', $item->id) }}" method="POST" style="display:none;">@csrf</form>
                @endif
            @endforeach
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
</script>
@endpush