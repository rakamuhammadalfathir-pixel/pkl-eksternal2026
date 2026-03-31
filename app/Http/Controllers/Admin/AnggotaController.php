<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnggotaService;
use App\Exports\AnggotaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    protected $anggotaService;

    // Inject service melalui constructor
    public function __construct(AnggotaService $anggotaService)
    {
        $this->anggotaService = $anggotaService;
    }

    public function index(Request $request)
    {
        $anggota = $this->anggotaService->getPaginatedAnggota($request->input('search'));
        return view('admin.anggota.index', compact('anggota'));
    }

    public function show($id)
    {
        $anggota = \App\Models\Anggota::findOrFail($id);
        return view('admin.anggota.show', compact('anggota'));
    }

    public function destroy($id)
    {
        $this->anggotaService->deleteAnggota($id);
        return redirect()->route('admin.anggota.index')->with('success', 'Data berhasil dihapus');
    }

    public function updateRole($id)
    {
        $this->anggotaService->toggleUserRole($id);
        return redirect()->back()->with('success', 'Role user berhasil diubah!');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && is_array($ids)) {
            $count = $this->anggotaService->bulkDeleteAnggota($ids);
            return redirect()->back()->with('success', "$count data anggota berhasil dihapus.");
        }
        
        return redirect()->back()->with('error', 'Pilih data anggota yang ingin dihapus.');
    }

    public function export_excel(Request $request)
    {
        $search = $request->query('search');
        return Excel::download(new AnggotaExport($search), 'data-anggota-' . date('Y-m-d') . '.xlsx');
    }
}