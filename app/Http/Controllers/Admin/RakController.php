<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RakService;
use App\Models\Rak;
use App\Http\Requests\RakRequest;
use Illuminate\Http\Request;

class RakController extends Controller
{
    protected $rakService;

    public function __construct(RakService $rakService)
    {
        $this->rakService = $rakService;
    }

    public function index()
    {
        $raks = $this->rakService->getPaginatedRak(10);
        return view('admin.rak.index', compact('raks'));
    }

    public function create()
    {
        return view('admin.rak.create');
    }

    public function store(RakRequest $request)
    {
        
        $this->rakService->storeRak($request->validated());

        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil ditambahkan.');
    }

    public function show($id)
    {
        $rak = Rak::findOrFail($id);
        return view('admin.rak.show', compact('rak'));
    }

    public function edit($id)
    {
        $rak = Rak::findOrFail($id);
        return view('admin.rak.edit', compact('rak'));
    }

    public function update(RakRequest $request, $id)
    {

        $this->rakService->updateRak($id, $request->validated());

        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->rakService->deleteRak($id);
        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && is_array($ids)) {
            $this->rakService->bulkDeleteRak($ids);
            return redirect()->back()->with('success', 'Data rak terpilih berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Pilih data yang ingin dihapus terlebih dahulu.');
    }
}