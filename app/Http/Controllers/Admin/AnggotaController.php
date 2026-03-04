<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Anggota;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota = Anggota::all();
        return view('admin.anggota.index', compact('anggota'));
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
        $anggota = Anggota::findOrFail($id);
        return view('admin.anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->nik = $request->nik;
        $anggota->nama = $request->nama;
        $anggota->alamat = $request->alamat;
        $anggota->telepon = $request->telepon;
        $anggota->jenis_kelamin = $request->jenis_kelamin;
        $anggota->save();
        return redirect()->route('admin.anggota.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();
        return redirect()->route('admin.anggota.index');
    }
    public function updateRole($id)
    {
        // Cari user berdasarkan ID yang terhubung dengan anggota
        $user = User::findOrFail($id);
        
        // Switch role
        $user->role = ($user->role == 'admin') ? 'customer' : 'admin';
        $user->save();

        return redirect()->back()->with('success', 'Role user berhasil diubah!');
    }
}
