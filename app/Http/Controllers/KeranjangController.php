<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku; 
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Pengembalian;
class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('keranjang.index', compact('keranjang'));
    }

    public function add(Request $request)
    {
        $buku = Buku::findOrFail($request->buku_id);
        $keranjang = session()->get('keranjang', []);

        if(isset($keranjang[$buku->id])) {
            return redirect()->back()->with('info', 'Buku ini sudah ada di antrean pinjam kamu.');
        }

        $keranjang[$buku->id] = [
            "judul" => $buku->judul,
            "pengarang" => $buku->pengarang,
            "foto" => $buku->foto,
            "id" => $buku->id
        ];

        session()->put('keranjang', $keranjang);
        
        return redirect()->back()->with('success', 'Buku berhasil ditambah ke antrean!');
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $keranjang = session()->get('keranjang');
            if(isset($keranjang[$request->id])) {
                unset($keranjang[$request->id]);
                session()->put('keranjang', $keranjang);
            }
            return redirect()->back()->with('success', 'Buku dihapus dari antrean.');
        }
    }

    public function clear()
    {
        session()->forget('keranjang');
        return redirect()->back()->with('success', 'Antrean dikosongkan.');
    }
    
    public function checkout(Request $request)
    {
        $keranjang = session()->get('keranjang');

        if(!$keranjang) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $anggota = Anggota::where('user_id', auth()->id())->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Anda belum terdaftar sebagai anggota perpustakaan!');
        }

        $kodeTransaksi = 'TRP-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5));

        foreach($keranjang as $id => $details) {
            Peminjaman::create([
                'anggota_id'     => $anggota->id,
                'buku_id'        => $id,
                'kode_transaksi' => $kodeTransaksi, 
                'tgl_pinjam'     => now(),
                'tgl_harus_kembali'=> now()->addDays(7),
                'status'         => 'Pinjam'
            ]);

            Buku::find($id)->decrement('stok');
        }

        session()->forget('keranjang');

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan dengan Kode: ' . $kodeTransaksi);
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

        // Mengambil data peminjaman milik user tersebut
        $history = Peminjaman::with('buku')
                    ->where('anggota_id', $anggota->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('peminjaman.history', compact('history'));
    }
}