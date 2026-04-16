<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Buku;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengembalianBukuController extends Controller
{
    public function store(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Gunakan startOfDay agar perhitungannya murni tanggal, bukan sisa jam
        $tglHarusKembali = Carbon::parse($peminjaman->tgl_harus_kembali)->startOfDay();
        $tglSekarang = Carbon::now()->startOfDay();
        
        $dendaPerHari = 1000;
        $totalDenda = 0;

        if ($tglSekarang->gt($tglHarusKembali)) {
            $selisihHari = $tglSekarang->diffInDays($tglHarusKembali);
            $totalDenda = $selisihHari * $dendaPerHari;
        }

        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tgl_kembali_aktual' => now(),
            'denda' => $totalDenda,
            'status_denda' => $totalDenda > 0 ? 'Belum Bayar' : 'Tidak Ada Denda'
        ]);

        $peminjaman->update(['status' => 'Kembali']);
        Buku::find($peminjaman->buku_id)->increment('stok');

        // Perbaikan: number_format bukan number_class
        return redirect()->back()->with('success', 'Buku berhasil dikembalikan. Denda: Rp ' . number_format($totalDenda, 0, ',', '.'));
    }
}
