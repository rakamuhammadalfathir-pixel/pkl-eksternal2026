<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Menggunakan with agar tidak terjadi N+1 query (Eager Loading)
        return Peminjaman::with(['anggota', 'buku'])->latest()->get();
    }

    // Header untuk file Excel
    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Nama Anggota',
            'Judul Buku',
            'Tanggal Pinjam',
            'Batas Kembali',
            'Status',
        ];
    }

    // Memetakan data dari model ke kolom Excel
    public function map($peminjaman): array
    {
        return [
            $peminjaman->kode_transaksi,
            $peminjaman->anggota->nama ?? 'Tidak Diketahui',
            $peminjaman->buku->judul ?? 'Buku Dihapus',
            $peminjaman->tgl_pinjam,
            $peminjaman->tgl_harus_kembali,
            $peminjaman->status,
        ];
    }
}
