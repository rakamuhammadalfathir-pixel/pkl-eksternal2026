<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Anggota;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\AnggotaExport;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $anggota = Anggota::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                            ->orWhereHas('user', function ($q) use ($search) {
                                $q->where('email', 'like', '%' . $search . '%');
                            });
            })
            ->latest()
            ->get();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

    public function export_excel()
    {
        return Excel::download(new AnggotaExport, 'data-anggota-' . date('Y-m-d') . '.xlsx');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && is_array($ids)) {
          Anggota::whereIn('id', $ids)->delete();
            
            return redirect()->back()->with('success', count($ids) . ' data anggota berhasil dihapus.');
        }
        
        return redirect()->back()->with('error', 'Pilih data anggota yang ingin dihapus.');
    }
}
