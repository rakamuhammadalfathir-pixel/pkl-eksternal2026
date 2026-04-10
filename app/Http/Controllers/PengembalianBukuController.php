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

        // 1. Hitung Denda (Misal: 1000 per hari)
        $tglHarusKembali = Carbon::parse($peminjaman->tgl_harus_kembali);
        $tglSekarang = now();
        $dendaPerHari = 1000;
        $totalDenda = 0;

        if ($tglSekarang->gt($tglHarusKembali)) {
            $selisihHari = $tglSekarang->diffInDays($tglHarusKembali);
            $totalDenda = $selisihHari * $dendaPerHari;
        }

        // 2. Simpan ke tabel pengembalians
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tgl_kembali_aktual' => $tglSekarang,
            'denda' => $totalDenda,
        ]);

        // 3. Update status peminjaman & Kembalikan Stok Buku
        $peminjaman->update(['status' => 'Kembali']); // Pastikan status ini ada di ENUM database
        Buku::find($peminjaman->buku_id)->increment('stok');

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan. Denda: Rp ' . number_class($totalDenda));
    }
}
