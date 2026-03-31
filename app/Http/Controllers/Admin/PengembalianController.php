<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PengembalianService;
use App\Models\Pengembalian;
use App\Exports\PengembalianExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Exception;

class PengembalianController extends Controller
{
    protected $pengembalianService;

    public function __construct(PengembalianService $pengembalianService)
    {
        $this->pengembalianService = $pengembalianService;
    }

    public function index(Request $request)
    {
        $pengembalians = $this->pengembalianService->getPaginatedPengembalian($request->input('search'));
        return view('admin.pengembalian.index', compact('pengembalians'));
    }

    public function show($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    public function destroy($id)
    {
        $this->pengembalianService->deletePengembalian($id);
        return redirect()->route('admin.pengembalian.index')
                         ->with('success', 'Pengembalian berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        
        if (!$ids || !is_array($ids)) {
            return redirect()->back()->with('error', 'Silakan pilih data yang ingin dihapus terlebih dahulu.');
        }

        try {
            $this->pengembalianService->bulkDeletePengembalian($ids);
            return redirect()->back()->with('success', 'Data pengembalian terpilih berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function export_excel(Request $request) 
    {
        $search = $request->query('search');
        return Excel::download(new PengembalianExport($search), 'laporan-pengembalian-' . date('Y-m-d') . '.xlsx');
    }
}