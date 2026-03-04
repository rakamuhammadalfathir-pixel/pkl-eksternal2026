<?php

namespace App\Http\Controllers\Admin;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
        return view('admin.buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $raks = Rak::all();
        return view('admin.buku.create', compact('kategoris', 'raks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|date',
            'stok' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'rak_id' => 'required|exists:raks,id',
        ]);

        $buku = new Buku();
        $buku->judul = $request->input('judul');
        $buku->pengarang = $request->input('pengarang');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun = $request->input('tahun');
        $buku->stok = $request->input('stok');
        $buku->kategori_id = $request->input('kategori_id');
        $buku->rak_id = $request->input('rak_id');

        $buku->save();
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        $raks = Rak::all();
        return view('admin.buku.edit', compact('buku', 'kategoris', 'raks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|date',
            'stok' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'rak_id' => 'required|exists:raks,id',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->judul = $request->input('judul');
        $buku->pengarang = $request->input('pengarang');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun = $request->input('tahun');
        $buku->stok = $request->input('stok');
        $buku->kategori_id = $request->input('kategori_id');
        $buku->rak_id = $request->input('rak_id');

        $buku->save();
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
