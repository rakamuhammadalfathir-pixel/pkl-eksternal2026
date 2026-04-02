<?php

namespace App\Http\Controllers\Admin;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use App\Http\Controllers\Controller;
use App\Http\Requests\BukuRequest;
use Illuminate\Http\Request;
use App\Exports\BukuExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\BukuService; // Import Service

class BukuController extends Controller
{
    protected $bukuService;

    // Inject Service melalui Constructor
    public function __construct(BukuService $bukuService)
    {
        $this->bukuService = $bukuService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $buku = Buku::with(['kategori', 'rak'])
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', '%' . $search . '%')
                             ->orWhereHas('kategori', function ($q) use ($search) {
                                 $q->where('nama_kategori', 'like', '%' . $search . '%');
                             })
                             ->orWhere('pengarang', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(15);

        return view('admin.buku.index', compact('buku'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $raks = Rak::all();
        return view('admin.buku.create', compact('kategoris', 'raks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BukuRequest $request) 
    {
        try {
            $this->bukuService->upsertBuku($request->validated(), $request->file('foto'));
            
            return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan buku: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.show', compact('buku'));
    }

    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        $raks = Rak::all();
        return view('admin.buku.edit', compact('buku', 'kategoris', 'raks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BukuRequest $request, string $id)
    {
        try {
            $this->bukuService->upsertBuku($request->validated(), $request->file('foto'), $id);
            
            return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui buku: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->bukuService->deleteBuku($id);
            
            return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus buku: ' . $e->getMessage());
        }
    }
    
    public function export_excel(Request $request)
    {
        $search = $request->query('search');
        return Excel::download(new BukuExport($search), 'laporan-buku-' . date('Y-m-d') . '.xlsx');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && is_array($ids)) {
            Buku::whereIn('id', $ids)->get()->each(function($buku) {
                $this->bukuService->deleteBuku($buku->id);
            });
            
            return redirect()->back()->with('success', count($ids) . ' buku berhasil dihapus sekaligus.');
        }
        
        return redirect()->back()->with('error', 'Pilih buku yang ingin dihapus.');
    }
}