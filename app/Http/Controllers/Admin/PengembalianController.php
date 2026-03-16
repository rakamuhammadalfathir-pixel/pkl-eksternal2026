<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\PengembalianExport;
use Maatwebsite\Excel\Facades\Excel;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pengembalians = Pengembalian::with(['peminjaman.anggota'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('peminjaman', function ($q) use ($search) {
                    $q->where('kode_transaksi', 'like', '%' . $search . '%')
                    ->orWhereHas('anggota', function ($q2) use ($search) {
                        $q2->where('nama', 'like', '%' . $search . '%');
                    });
                });
            })
            ->latest()
            ->get();

        return view('admin.pengembalian.index', compact('pengembalians'));
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
        $pengembalian = Pengembalian::findOrFail($id);
        return view('admin.pengembalian.show', compact('pengembalian'));
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
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->route('admin.pengembalian.index')
                         ->with('success', 'Pengembalian berhasil dihapus.');
    }

   public function export_excel(Request $request) 
    {
        $search = $request->query('search');
        
        return Excel::download(new PengembalianExport($search), 'laporan-pengembalian-' . date('Y-m-d') . '.xlsx');
    }

    public function bulkDelete(Request $request)
    {
        if (!$request->has('ids') || empty($request->ids)) {
            return redirect()->back()->with('error', 'Silakan pilih data yang ingin dihapus terlebih dahulu.');
        }

        try {
            Pengembalian::whereIn('id', $request->ids)->delete();

            return redirect()->back()->with('success', 'Data pengembalian terpilih berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
