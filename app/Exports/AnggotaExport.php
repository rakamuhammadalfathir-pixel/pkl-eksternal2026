<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Mengambil data anggota dengan relasi user agar bisa mengambil email
        return Anggota::with('user')->get();
    }

    public function headings(): array
    {
        // Definisi judul kolom di baris pertama Excel
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
        static $no = 1;
        // Memastikan properti alamat dan telepon dipanggil sesuai Migration
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