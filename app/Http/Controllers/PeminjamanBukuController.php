<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku; 
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Pengembalian;
class PeminjamanBukuController extends Controller
{
    public function index()
    {
        $peminjamanbuku = session()->get('peminjamanbuku', []);
        return view('peminjamanbuku.index', compact('peminjamanbuku'));
    }

    public function add(Request $request)
    {
        $buku = Buku::findOrFail($request->buku_id);
        $peminjamanbuku = session()->get('peminjamanbuku', []);

        if(isset($peminjamanbuku[$buku->id])) {
            return redirect()->back()->with('info', 'Buku ini sudah ada di antrean pinjam kamu.');
        }

        $peminjamanbuku[$buku->id] = [
            "judul" => $buku->judul,
            "pengarang" => $buku->pengarang,
            "foto" => $buku->foto,
            "id" => $buku->id
        ];

        session()->put('peminjamanbuku', $peminjamanbuku);
        
        return redirect()->back()->with('success', 'Buku berhasil ditambah ke antrean!');
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $peminjamanbuku = session()->get('peminjamanbuku');
            if(isset($peminjamanbuku[$request->id])) {
                unset($peminjamanbuku[$request->id]);
                session()->put('peminjamanbuku', $peminjamanbuku);
            }
            return redirect()->back()->with('success', 'Buku dihapus dari antrean.');
        }
    }

    public function clear()
    {
        session()->forget('peminjamanbuku');
        return redirect()->back()->with('success', 'Antrean dikosongkan.');
    }
    
   public function checkout(Request $request)
    {
        $peminjamanbuku = session()->get('peminjamanbuku');

        if(!$peminjamanbuku) {
            return redirect()->back()->with('error', 'peminjamanbuku kosong!');
        }

        $anggota = Anggota::where('user_id', auth()->id())->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Anda belum terdaftar sebagai anggota perpustakaan!');
        }

        $kodeTransaksi = 'TRP-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5));

        foreach($peminjamanbuku as $id => $details) {
            // 1. Simpan data peminjaman
            Peminjaman::create([
                'anggota_id'      => $anggota->id,
                'buku_id'         => $id,
                'kode_transaksi'  => $kodeTransaksi, 
                'tgl_pinjam'      => now(),
                'tgl_harus_kembali'=> now()->addDays(7),
                'status'          => 'Pinjam'
            ]);

            // 2. Kurangi stok buku
            Buku::find($id)->decrement('stok');

            // 3. TAMBAHKAN INI: Hapus buku ini dari wishlist user setelah checkout berhasil
            auth()->user()->wishlist()->detach($id);
        }

        session()->forget('peminjamanbuku');

        return redirect()->route('peminjamanbuku.index')->with('success', 'Peminjaman berhasil diajukan dengan Kode: ' . $kodeTransaksi);
    }
    public function kembalikanBuku($id)
    {

        $peminjaman = Peminjaman::findOrFail($id);

        $tglHarusKembali = \Carbon\Carbon::parse($peminjaman->tgl_harus_kembali);
        $tglSekarang = now();
        $denda = 0;

        if ($tglSekarang->gt($tglHarusKembali)) {
            $selisihHari = $tglSekarang->diffInDays($tglHarusKembali);
            $denda = $selisihHari * 1000; 
        }

        Pengembalian::create([
            'peminjaman_id'      => $peminjaman->id,
            'tgl_kembali_aktual' => $tglSekarang,
            'denda'              => $denda,
        ]);

        $peminjaman->update([
            'status' => 'Kembali' 
        ]);

        Buku::find($peminjaman->buku_id)->increment('stok');

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan! Denda Anda: Rp ' . number_format($denda));
    }

    public function history()
    {
        $anggota = Anggota::where('user_id', auth()->id())->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        $history = Peminjaman::with(['buku', 'pengembalian'])
                    ->where('anggota_id', $anggota->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('peminjamanbuku.history', compact('history'));
    }
}