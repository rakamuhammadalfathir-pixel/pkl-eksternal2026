<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengembalians = Pengembalian::all();
        return view('admin.pengembalian.index', compact('pengembalians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peminjamans = Peminjaman::all();
        return view('admin.pengembalian.create', compact('peminjamans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tgl_kembali_aktual' => 'required|date',
            'denda' => 'nullable|integer|min:0',
        ]);

        Pengembalian::create($request->all());

        return redirect()->route('admin.pengembalian.index')
                         ->with('success', 'Pengembalian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $peminjamans = Peminjaman::all();
        return view('admin.pengembalian.edit', compact('pengembalian', 'peminjamans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tgl_kembali_aktual' => 'required|date',
            'denda' => 'nullable|integer|min:0',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        
        // Cara ini lebih pasti karena kita menyebutkan nama kolomnya satu per satu
        $pengembalian->update([
            'peminjaman_id' => $request->peminjaman_id,
            'tgl_kembali_aktual' => $request->tgl_kembali_aktual,
            'denda' => $request->denda,
        ]);

        return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->route('admin.pengembalian.index')
                         ->with('success', 'Pengembalian berhasil dihapus.');
    }
}
