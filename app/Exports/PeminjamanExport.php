<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromQuery; // Ubah ke FromQuery
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromQuery, WithHeadings, WithMapping
{
    protected $search;

    // Constructor untuk menerima parameter search
    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function query()
    {
        $search = $this->search;

        // Gunakan logic query yang sama dengan index di Controller
        return Peminjaman::query()->with(['anggota', 'buku'])
            ->when($search, function ($query, $search) {
                return $query->where('kode_transaksi', 'like', '%' . $search . '%')
                    ->orWhereHas('anggota', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('buku', function ($q) use ($search) {
                        $q->where('judul', 'like', '%' . $search . '%');
                    });
            })
            ->latest();
    }

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