@extends('layouts.user.peminjamanbuku')

@section('title', 'Antrean Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0"><i class="bx bx-cart fs-3 me-2"></i>Antrean Peminjaman</h4>
    <a href="{{ route('katalog.index') }}" class="btn btn-outline-primary rounded-pill btn-sm">
        <i class="bx bx-plus me-1"></i> Tambah Buku Lagi
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 100px;">Buku</th>
                    <th>Detail Buku</th>
                    <th>Pengarang</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamanbuku as $id => $details)
                <tr>
                    <td>
                        <img src="{{ $details['foto'] ? asset('storage/buku/' . $details['foto']) : asset('assets/img/elements/buku.jpg') }}" class="rounded shadow-sm" width="60" height="80" style="object-fit: cover;">
                    </td>
                    <td>
                        <span class="fw-bold d-block fs-6 text-dark">{{ $details['judul'] }}</span>
                        <small class="text-muted">ID: {{ $id }}</small>
                    </td>
                    <td>{{ $details['pengarang'] }}</td>
                    <td class="text-center">
                        <form id="formDelete-{{ $id }}" action="{{ route('peminjamanbuku.remove') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="button" onclick="confirmDelete('{{ $id }}', '{{ $details['judul'] }}')" class="btn btn-icon btn-outline-danger btn-sm">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5">
                        <i class="bx bx-shopping-bag text-muted mb-3" style="font-size: 3rem;"></i>
                        <p>Antrean Anda masih kosong</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if(count($peminjamanbuku) > 0)
    <div class="card-footer bg-light border-top p-4 d-flex justify-content-between">
        <form action="{{ route('peminjamanbuku.clear') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-label-secondary">Kosongkan</button>
        </form>
        <button type="button" onclick="confirmCheckout()" class="btn btn-primary px-5">
            Ajukan Pinjaman <i class="bx bx-check-double ms-2"></i>
        </button>
    </div>
    @endif
</div>

<form id="formCheckout" action="{{ route('peminjaman.bulk_store') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

@section('page-script')
<script>
    function confirmCheckout() {
        Swal.fire({
            title: 'Proses Peminjaman?',
            text: "Ajukan peminjaman untuk buku-buku ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Ajukan!',
            customClass: { confirmButton: 'btn btn-primary me-3', cancelButton: 'btn btn-outline-secondary' },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) document.getElementById('formCheckout').submit();
        });
    }

    function confirmDelete(id, judul) {
        Swal.fire({
            title: 'Hapus Buku?',
            text: "Hapus '" + judul + "' dari antrean?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            customClass: { confirmButton: 'btn btn-danger me-3', cancelButton: 'btn btn-outline-secondary' },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) document.getElementById('formDelete-' + id).submit();
        });
    }
</script>
@endsection