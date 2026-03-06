<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah data untuk ditampilkan di kotak-kotak dashboard
        $data = [
            'total_buku' => Buku::count(),
            'total_anggota' => Anggota::count(),
            'total_peminjaman' => Peminjaman::where('status', 'Pinjam')->count(),
        ];

        return view('admin.dashboard', $data);
    }
}