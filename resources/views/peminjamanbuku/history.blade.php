@extends('layouts.user.peminjamanbuku')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bx bx-history fs-3 me-2"></i>Riwayat Peminjaman</h4>
            <p class="text-muted mb-0">Pantau status peminjaman dan denda buku Anda</p>
        </div>
        <span class="badge bg-label-primary px-3 py-2">Total {{ count($history) }} Transaksi</span>
    </div>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Tgl Kembali Real</th>
                        <th>Denda</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($history as $item)
                    @php
                        // 1. Hitung nominal denda
                        $nominalDenda = abs($item->pengembalian?->denda ?? 0);
                        
                        // 2. Cek status lunas
                        $isLunas = ($item->pengembalian?->status_denda == 'Lunas');

                        // 3. Styling Badge Status Peminjaman
                        $statusClasses = [
                            'Pending' => 'bg-label-warning',
                            'Pinjam'  => 'bg-label-primary',
                            'Kembali' => 'bg-label-success',
                            'Ditolak' => 'bg-label-danger'
                        ];
                        $class = $statusClasses[$item->status] ?? 'bg-label-secondary';
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $item->buku->foto ? asset('storage/buku/' . $item->buku->foto) : asset('assets/img/elements/18.jpg') }}" 
                                     alt="cover" class="avatar-img me-3 shadow-sm" style="width: 40px; height: 55px; object-fit: cover; border-radius: 4px;">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark">{{ Str::limit($item->buku->judul, 30) }}</span>
                                    <small class="text-muted">ID: {{ $item->kode_transaksi }}</small>
                                </div>
                            </div>
                        </td>

                        <td><small>{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}</small></td>
                        <td><small>{{ \Carbon\Carbon::parse($item->tgl_harus_kembali)->format('d M Y') }}</small></td>

                        <td>
                            <span class="badge {{ $class }} px-3 py-2">{{ $item->status }}</span>
                        </td>

                        <td>
                            <small>{{ $item->pengembalian ? \Carbon\Carbon::parse($item->pengembalian->tgl_kembali_aktual)->format('d M Y') : '-' }}</small>
                        </td>

                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-bold {{ ($nominalDenda > 0 && !$isLunas) ? 'text-danger' : 'text-dark' }}">
                                    Rp {{ number_format($nominalDenda, 0, ',', '.') }}
                                </span>
                                @if($nominalDenda > 0)
                                    @if($isLunas)
                                        <small class="text-success" style="font-size: 0.7rem;"><i class="bx bx-check-circle"></i> Lunas</small>
                                    @else
                                        <small class="text-danger" style="font-size: 0.7rem;"><i class="bx bx-info-circle"></i> Belum Bayar</small>
                                    @endif
                                @endif
                            </div>
                        </td>

                        <td class="text-center">
                            {{-- KONDISI 1: Masih Meminjam --}}
                            @if($item->status == 'Pinjam')
                                <form action="{{ route('peminjaman.kembali', $item->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('Kembalikan buku ini?')">
                                        Kembalikan
                                    </button>
                                </form>

                            {{-- KONDISI 2: Sudah Kembali tapi ADA denda yang BELUM Lunas --}}
                            @elseif($item->status == 'Kembali' && $nominalDenda > 0 && !$isLunas)
                                <a href="{{ route('peminjaman.bayar', $item->id) }}" class="btn btn-sm btn-primary shadow-sm px-3">
                                    <i class="bx bx-credit-card me-1"></i> Bayar
                                </a>

                            {{-- KONDISI 3: Masih menunggu persetujuan admin --}}
                            @elseif($item->status == 'Pending')
                                <i class="bx bx-loader-alt bx-spin text-warning fs-4"></i>

                            {{-- KONDISI 4: Selesai --}}
                            @else
                                <i class="bx bx-check-double text-success fs-3" title="Transaksi Selesai"></i>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <p class="text-muted">Anda belum memiliki riwayat peminjaman.</p>
                            <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Cari Buku</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script>
    // Script khusus halaman history jika diperlukan (seperti notifikasi sukses dari session)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection