@extends('layouts.admin')

@section('title', 'Data Anggota')

@section('content')

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.anggota.export_excel', ['search' => request('search')]) }}" class="btn btn-success">
            <i class="bx bxs-file-export me-1"></i> Export Excel
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <form action="{{ route('admin.anggota.index') }}" method="GET">
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}" />
                    @if(request('search'))
                        <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary">
                            <i class="bx bx-x"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">Tabel Anggota</h5>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-primary alert-dismissible" role="alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form id="bulkDeleteForm" action="{{ route('admin.anggota.bulkDelete') }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <button type="submit" id="btnDeleteSelected" class="btn btn-danger" onclick="return confirm('Hapus anggota terpilih?')" disabled>
                        <i class="bx bx-trash me-1"></i> Hapus Terpilih
                    </button>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 50px;"><input class="form-check-input" type="checkbox" id="selectAll"></th>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggota as $item)
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}">
                                </td>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name ?? 'Tidak ada nama' }}</td>
                                <td>{{ $item->user->email ?? 'Tidak ada akun' }}</td>
                                <td class="text-center">
                                    @if($item->user)
                                        <span class="badge {{ $item->user->role == 'admin' ? 'bg-label-success' : 'bg-label-primary' }}">
                                            {{ ucfirst($item->user->role) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        @if($item->user)
                                            <button type="submit" form="form-role-{{ $item->user->id }}" class="btn btn-secondary btn-sm" title="Tukar Role">
                                                <i class="bx bx-sync"></i>
                                            </button>
                                        @endif
                                        <a href="{{ route('admin.anggota.show', $item->id) }}" class="btn btn-info btn-sm">
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

            {{-- Hidden Forms for Role Update --}}
            @foreach($anggota as $item)
                @if($item->user)
                <form id="form-role-{{ $item->user->id }}" action="{{ route('admin.anggota.updateRole', $item->user->id) }}" method="POST" style="display:none;">
                    @csrf @method('PATCH')
                </form>
                @endif
            @endforeach
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
                checkboxes.forEach(checkbox => checkbox.checked = selectAll.checked);
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