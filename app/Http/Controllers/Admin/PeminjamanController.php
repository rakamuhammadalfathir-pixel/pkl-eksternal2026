<?php

namespace App\Http\Controllers\Admin;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamans = Peminjaman::all();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $anggotas = Anggota::all(); 

        return view('admin.peminjaman.edit', compact('peminjaman', 'anggotas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_transaksi' => 'required|string|max:255|unique:peminjamans,kode_transaksi,' . $id,
            'anggota_id' => 'required|exists:anggotas,id',
            'tgl_pinjam' => 'required|date',
            'tgl_harus_kembali' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $buku = Buku::findOrFail($peminjaman->buku_id);

        if ($peminjaman->status == 'pinjam' && $request->status == 'kembali') {
            $buku->increment('stok'); 
        } 
        elseif ($peminjaman->status == 'kembali' && $request->status == 'pinjam') {
            $buku->decrement('stok'); 
        }

        $peminjaman->update([
            'kode_transaksi' => $request->kode_transaksi,
            'anggota_id' => $request->anggota_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_harus_kembali' => $request->tgl_harus_kembali,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        if ($peminjaman->status == 'pinjam') {
            $buku = Buku::find($peminjaman->buku_id);
            if ($buku) {
                $buku->increment('stok');
            }
        }

        $peminjaman->delete();
        return redirect()->route('admin.peminjaman.index')->with('success', 'Data Berhasil Dihapus & Stok Dikembalikan');
    }
}
