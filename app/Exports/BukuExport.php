<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BukuExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Mengambil data buku beserta relasinya
        return Buku::with(['kategori', 'rak'])->get();
    }

    // Menentukan judul kolom di baris pertama Excel
    public function headings(): array
    {
        return [
            'No',
            'Judul Buku',
            'Pengarang',
            'Penerbit',
            'Tahun',
            'Stok',
            'Kategori',
            'Lokasi Rak',
        ];
    }

    // Memetakan data dari model ke kolom Excel
    public function map($buku): array
    {
        static $no = 1;
        return [
            $no++,
            $buku->judul,
            $buku->pengarang,
            $buku->penerbit,
            $buku->tahun,
            $buku->stok,
            $buku->kategori->nama_kategori ?? '-',
            $buku->rak->nama_rak ?? '-',
        ];
    }
}