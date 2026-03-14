<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raks = Rak::all();
        return view('admin.rak.index', compact('raks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_rak' => 'required',
            'lokasi' => 'required',
        ]);

        Rak::create($request->all());

        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rak = Rak::findOrFail($id);
        return view('admin.rak.show', compact('rak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rak = Rak::findOrFail($id);
        return view('admin.rak.edit', compact('rak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_rak' => 'required',
            'lokasi' => 'required',
        ]);

        $rak = Rak::findOrFail($id);
        $rak->update($request->all());

        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rak = Rak::findOrFail($id);
        $rak->delete();

        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil dihapus.');
    } 
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            \App\Models\Rak::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Data rak terpilih berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Pilih data yang ingin dihapus terlebih dahulu.');
    }
}
