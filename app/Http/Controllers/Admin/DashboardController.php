<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        // 1. Statistik Utama
        $stats = [
            'total_buku' => \App\Models\Buku::count(),
            'total_anggota' => \App\Models\Anggota::count(),
            'pending_peminjaman' => \App\Models\Peminjaman::where('status', 'Pinjam')->count(),
            // Menggunakan kolom yang benar: tgl_harus_kembali
            'terlambat' => \App\Models\Peminjaman::where('status', 'Pinjam')
                                    ->where('tgl_harus_kembali', '<', now())
                                    ->count(),
            // Tambahan: Total Denda dari semua pengembalian
            'total_denda' => \App\Models\Pengembalian::sum('denda'),
        ];

        // 2. Aktivitas Terbaru (Relasi ke Anggota karena di model pakai anggota_id)
        $recentLoans = \App\Models\Peminjaman::with(['buku', 'anggota'])
                        ->latest()
                        ->take(5)
                        ->get();

        // 3. Buku Populer
        $popularBooks = \App\Models\Buku::withCount('peminjaman')
                        ->orderBy('peminjaman_count', 'desc')
                        ->take(6)
                        ->get();

        // 4. Data Grafik 7 Hari Terakhir
        $loanChart = \App\Models\Peminjaman::select(
                            \DB::raw('DATE(created_at) as date'), 
                            \DB::raw('count(*) as total')
                        )
                        ->where('created_at', '>=', now()->subDays(7))
                        ->groupBy('date')
                        ->orderBy('date', 'ASC')
                        ->get();

        return view('admin.dashboard', compact('stats', 'recentLoans', 'popularBooks', 'loanChart'));
    }
}