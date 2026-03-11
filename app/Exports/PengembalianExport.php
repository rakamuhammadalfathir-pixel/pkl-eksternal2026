<?php

namespace App\Exports;

use App\Models\Pengembalian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PengembalianExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Eager loading: ambil pengembalian beserta data pinjam, anggota, dan buku
        return Pengembalian::with(['peminjaman.anggota', 'peminjaman.buku'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Nama Anggota',
            'Judul Buku',
            'Tanggal Kembali',
            'Denda (Rp)',
        ];
    }

    public function map($pengembalian): array
    {
        return [
            $pengembalian->peminjaman->kode_transaksi ?? '-',
            $pengembalian->peminjaman->anggota->nama ?? 'Anggota Dihapus',
            $pengembalian->peminjaman->buku->judul ?? 'Buku Dihapus',
            $pengembalian->tgl_kembali_aktual,
            $pengembalian->denda ?? 0,
        ];
    }
}
