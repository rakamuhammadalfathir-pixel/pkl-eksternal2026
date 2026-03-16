<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromQuery; // Ubah ke FromQuery
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromQuery, WithHeadings, WithMapping
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

        return Anggota::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                             ->orWhereHas('user', function ($q) use ($search) {
                                 $q->where('email', 'like', '%' . $search . '%');
                             });
            });
    }

    public function headings(): array
    {
        return [
            'No',
            'User ID',
            'Nama Anggota',
            'Alamat',
            'Telepon',
            'Email',
        ];
    }

    public function map($anggota): array
    {
        // Gunakan variabel static untuk nomor urut
        static $no = 1;

        return [
            $no++,
            $anggota->user_id,
            $anggota->nama,
            $anggota->alamat ?? '-', 
            $anggota->telepon ?? '-', 
            $anggota->user->email ?? '-', 
        ];
    }
}