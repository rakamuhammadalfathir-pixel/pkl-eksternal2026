<?php

namespace App\Http\Controllers\Admin;

use App\Models\Peminjaman;
use App\Models\Anggota;
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
        $peminjamans = Peminjaman::all();
        $anggotas = Anggota::all();
        return view('admin.peminjaman.create', compact('peminjamans', 'anggotas'));   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|string|max:255|unique:peminjamans,kode_transaksi',
            'anggota_id' => 'required|exists:anggotas,id',
            'tgl_pinjam' => 'required|date',
            'tgl_harus_kembali' => 'required|date',
            // Hapus 'status' dari sini karena tidak ada di form
        ]);

        // Tambahkan status secara manual
        Peminjaman::create([
            'kode_transaksi' => $request->kode_transaksi,
            'anggota_id' => $request->anggota_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_harus_kembali' => $request->tgl_harus_kembali,
            'status' => 'pinjam', // Default status
        ]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Data Berhasil Ditambah');
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
            'anggota_id' => 'required|string|max:255',
            'tgl_pinjam' => 'required|date',
            'tgl_harus_kembali' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'kode_transaksi' => $request->kode_transaksi,
            'anggota_id' => $request->anggota_id, // Pastikan ini sesuai dengan nama field di form
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
        $peminjaman->delete();

        return redirect()->route('admin.peminjaman.index')->with('success', 'Data Berhasil Dihapus');
    }
}
