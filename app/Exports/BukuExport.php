<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BukuExport implements FromQuery, WithHeadings, WithMapping
{
    protected $search;

    // Constructor untuk menerima data search dari Controller
    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function query()
    {
        $search = $this->search;

        return Buku::query()->with(['kategori', 'rak'])
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', '%' . $search . '%')
                             ->orWhereHas('kategori', function ($q) use ($search) {
                                 $q->where('nama_kategori', 'like', '%' . $search . '%');
                             })
                             ->orWhere('pengarang', 'like', '%' . $search . '%');
            });
    }

    public function headings(): array
    {
        // Tambahkan semua kolom yang Anda inginkan di sini
        return [
            "Judul", 
            "Pengarang", 
            "Penerbit", 
            "Tahun", 
            "Kategori", 
            "Rak", 
            "Stok", 
            "Sinopsis"
        ];
    }

    public function map($buku): array
    {
        // Urutan data di sini HARUS SAMA dengan urutan di headings()
        return [
            $buku->judul,
            $buku->pengarang,
            $buku->penerbit, // Kolom tambahan
            $buku->tahun,    // Kolom tambahan
            $buku->kategori->nama_kategori,
            $buku->rak->nama_rak,
            $buku->stok,
            $buku->sinopsis, // Kolom tambahan
        ];
    }
}