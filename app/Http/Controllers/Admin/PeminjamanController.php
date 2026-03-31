<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PeminjamanService;
use App\Models\Peminjaman;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Exception;

class PeminjamanController extends Controller
{
    protected $peminjamanService;

    public function __construct(PeminjamanService $peminjamanService)
    {
        $this->peminjamanService = $peminjamanService;
    }

    public function index(Request $request)
    {
        $peminjamans = $this->peminjamanService->getPaginatedPeminjaman($request->input('search'));
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    public function destroy($id)
    {
        $this->peminjamanService->deletePeminjaman($id);
        return redirect()->route('admin.peminjaman.index')
                         ->with('success', 'Data Berhasil Dihapus & Stok Dikembalikan');
    }

    public function approve($id) 
    {
        try {
            $this->peminjamanService->approvePeminjaman($id);
            return back()->with('success', 'Peminjaman disetujui, stok buku telah dipotong.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function reject($id)
    {
        $this->peminjamanService->rejectPeminjaman($id);
        return back()->with('info', 'Permintaan peminjaman telah ditolak.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && is_array($ids)) {
            $this->peminjamanService->bulkDeletePeminjaman($ids);
            return redirect()->back()->with('success', 'Data berhasil dihapus secara massal.');
        }
        
        return redirect()->back()->with('error', 'Pilih data terlebih dahulu.');
    }

    public function export_excel(Request $request) 
    {
        $search = $request->query('search');
        return Excel::download(new PeminjamanExport($search), 'laporan-peminjaman-' . date('Y-m-d') . '.xlsx');
    }
}