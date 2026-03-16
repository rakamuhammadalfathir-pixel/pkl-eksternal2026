<?php

namespace App\Exports;

use App\Models\Pengembalian;
use Maatwebsite\Excel\Concerns\FromQuery; // Ubah ke FromQuery
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PengembalianExport implements FromQuery, WithHeadings, WithMapping
{
    protected $search;

    // Constructor untuk menangkap kata kunci pencarian
    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function query()
    {
        $search = $this->search;

        // Gunakan logic query yang sama persis dengan index di Controller
        return Pengembalian::query()->with(['peminjaman.anggota', 'peminjaman.buku'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('peminjaman', function ($q) use ($search) {
                    $q->where('kode_transaksi', 'like', '%' . $search . '%')
                    ->orWhereHas('anggota', function ($q2) use ($search) {
                        $q2->where('nama', 'like', '%' . $search . '%');
                    });
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