<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\KategoriService;
use App\Models\Kategori; // Tetap di-import untuk type-hinting jika perlu
use App\Http\Requests\KategoriRequest;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    protected $kategoriService;

    public function __construct(KategoriService $kategoriService)
    {
        $this->kategoriService = $kategoriService;
    }

    public function index()
    {
        $kategoris = $this->kategoriService->getAllPaginated(5);
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(KategoriRequest $request)
    {

        $this->kategoriService->storeKategori($request->validated());

        return redirect()->route('admin.kategori.index')
                            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(KategoriRequest $request, $id)
    {
    
        $this->kategoriService->updateKategori($id, $request->validated());

        return redirect()->route('admin.kategori.index')
                            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->kategoriService->deleteKategori($id);
        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && is_array($ids)) {
            $this->kategoriService->bulkDeleteKategori($ids);
            return redirect()->back()->with('success', 'Data terpilih berhasil dihapus.');
        }
        
        return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
    }
}