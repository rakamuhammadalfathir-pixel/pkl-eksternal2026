<?php

namespace App\Http\Controllers\Admin;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $search = $request->input('search');

        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->when($search, function ($query, $search) {
                return $query->where('kode_transaksi', 'like', '%' . $search . '%')
                    ->orWhereHas('anggota', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('buku', function ($q) use ($search) {
                        $q->where('judul', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(15);

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

    public function export_excel(Request $request) 
    {
        $search = $request->query('search');
        return Excel::download(new PeminjamanExport($search), 'laporan-peminjaman-' . date('Y-m-d') . '.xlsx');
    }

    // Di Admin/PeminjamanController.php
    public function approve($id) 
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $buku = Buku::find($peminjaman->buku_id);
        if($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis, tidak bisa disetujui.');
        }

        $peminjaman->update(['status' => 'Pinjam']);

        $buku->decrement('stok');

        return back()->with('success', 'Peminjaman disetujui, stok buku telah dipotong.');
    }

    // PeminjamanController (Sisi Admin)
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $peminjaman->update([
            'status' => 'Ditolak'
        ]);

        return back()->with('info', 'Permintaan peminjaman telah ditolak.');
    }

    public function bulkDelete(Request $request)
    {
        if ($request->has('ids')) {
            Peminjaman::whereIn('id', $request->ids)->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus secara massal.');
        }
        return redirect()->back()->with('error', 'Pilih data terlebih dahulu.');
    }
}
