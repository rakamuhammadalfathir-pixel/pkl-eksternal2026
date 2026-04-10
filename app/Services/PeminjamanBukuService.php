<?php

namespace App\Services;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PeminjamanBukuService
{
    /**
     * Mengambil daftar antrean dari session
     */
    public function getAntrean()
    {
        return session()->get('peminjamanbuku', []);
    }

    /**
     * Menambahkan buku ke dalam session (antrean)
     */
    public function tambahkanKeAntrean($bukuId)
    {
        $buku = Buku::findOrFail($bukuId);
        $peminjamanbuku = $this->getAntrean();

        if (isset($peminjamanbuku[$buku->id])) {
            return ['status' => 'info', 'pesan' => 'Buku ini sudah ada di antrean pinjam kamu.'];
        }

        $peminjamanbuku[$buku->id] = [
            "judul" => $buku->judul,
            "pengarang" => $buku->pengarang,
            "foto" => $buku->foto,
            "id" => $buku->id
        ];

        session()->put('peminjamanbuku', $peminjamanbuku);
        return ['status' => 'success', 'pesan' => 'Buku berhasil ditambah ke antrean!'];
    }

    /**
     * Menghapus satu buku dari antrean
     */
    public function hapusDariAntrean($id)
    {
        $peminjamanbuku = $this->getAntrean();
        if (isset($peminjamanbuku[$id])) {
            unset($peminjamanbuku[$id]);
            session()->put('peminjamanbuku', $peminjamanbuku);
            return true;
        }
        return false;
    }

    /**
     * Mengosongkan seluruh antrean
     */
    public function kosongkanAntrean()
    {
        session()->forget('peminjamanbuku');
    }

    /**
     * Proses checkout dari session ke database
     */
    public function prosesCheckout($userId)
    {
        $peminjamanbuku = $this->getAntrean();

        if (empty($peminjamanbuku)) {
            return ['status' => 'error', 'pesan' => 'Antrean peminjaman kosong!'];
        }

        $anggota = Anggota::where('user_id', $userId)->first();

        if (!$anggota) {
            return ['status' => 'error', 'pesan' => 'Anda belum terdaftar sebagai anggota perpustakaan!'];
        }

        $kodeTransaksi = 'TRP-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        $user = User::find($userId);

        foreach ($peminjamanbuku as $id => $details) {
            Peminjaman::create([
                'anggota_id'        => $anggota->id,
                'buku_id'           => $id,
                'kode_transaksi'    => $kodeTransaksi,
                'tgl_pinjam'        => now(),
                'tgl_harus_kembali' => now()->addDays(7),
                'status'            => 'Pending'
            ]);
            
            // Lepas dari wishlist jika ada relasi
            $user->wishlist()->detach($id);
        }

        $this->kosongkanAntrean();
        return ['status' => 'success', 'pesan' => 'Peminjaman berhasil diajukan!'];
    }

    /**
     * Proses pengembalian buku dan hitung denda
     */
    public function prosesPengembalian($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Pastikan kita membandingkan hanya tanggal (Y-m-d) agar hitungan hari akurat
        $tglHarusKembali = Carbon::parse($peminjaman->tgl_harus_kembali)->startOfDay();
        $tglSekarang = now()->startOfDay(); 
        
        $denda = 0;

        // Logika: Jika tanggal sekarang melewati tanggal harus kembali
        if ($tglSekarang->gt($tglHarusKembali)) {
            // Hitung selisih hari secara absolut
            $selisihHari = $tglSekarang->diffInDays($tglHarusKembali);
            
            // Denda 1000 per hari, dipastikan tidak minus dengan max(0, ...)
            $denda = max(0, $selisihHari * 1000);
        }

        // Simpan ke tabel pengembalian
        Pengembalian::create([
            'peminjaman_id'      => $peminjaman->id,
            'tgl_kembali_aktual' => now(), // Simpan waktu lengkap saat klik tombol
            'denda'              => $denda,
        ]);

        // Update status di tabel peminjaman
        $peminjaman->update([
            'status' => 'Kembali'
        ]);
        
        // Tambah stok buku kembali
        Buku::find($peminjaman->buku_id)->increment('stok');

        return [
            'status' => 'success', 
            'pesan' => 'Buku berhasil dikembalikan! ' . ($denda > 0 ? 'Denda: Rp ' . number_format($denda, 0, ',', '.') : 'Tepat waktu!')
        ];
    }

    /**
     * Mengambil riwayat peminjaman user
     */
    public function getRiwayatUser($userId)
    {
        $anggota = Anggota::where('user_id', $userId)->first();

        if (!$anggota) return null;

        return Peminjaman::with(['buku', 'pengembalian'])
                    ->where('anggota_id', $anggota->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}