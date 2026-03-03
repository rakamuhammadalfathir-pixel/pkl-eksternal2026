<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanDetail;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamanDetails = PeminjamanDetail::all();
        return view('peminjaman_detail.index', compact('peminjamanDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peminjamans = Peminjaman::all();
        $bukus = Buku::all();
        return view('peminjaman_detail.create', compact('peminjamans', 'bukus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'buku_id' => 'required|exists:bukus,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        PeminjamanDetail::create($request->all());

        return redirect()->route('peminjaman_detail.index')
                         ->with('success', 'Peminjaman Detail berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjamanDetail = PeminjamanDetail::findOrFail($id);
        return view('peminjaman_detail.show', compact('peminjamanDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // ambil data detail peminjaman
        $peminjamanDetail = PeminjamanDetail::findOrFail($id);
        $peminjamans = Peminjaman::all();
        $bukus = Buku::all();
        
        // kirim variabel dengan nama yang sesuai ke view
        return view('peminjaman_detail.edit', compact('peminjamanDetail', 'peminjamans', 'bukus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'buku_id' => 'required|exists:bukus,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $peminjamanDetail = PeminjamanDetail::findOrFail($id);
        $peminjamanDetail->update($request->all());

        return redirect()->route('peminjaman_detail.index')
                         ->with('success', 'Peminjaman Detail berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
