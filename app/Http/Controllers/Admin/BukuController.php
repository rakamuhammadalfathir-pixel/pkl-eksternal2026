<?php

namespace App\Http\Controllers\Admin;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\BukuExport;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $buku = Buku::with(['kategori', 'rak'])
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', '%' . $search . '%')
                            // Mencari di relasi kategori
                            ->orWhereHas('kategori', function ($q) use ($search) {
                                $q->where('nama_kategori', 'like', '%' . $search . '%'); // Sesuaikan kolom ini
                            })
                            // Bonus: Mencari berdasarkan pengarang juga
                            ->orWhere('pengarang', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(15);

        return view('admin.buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $raks = Rak::all();
        return view('admin.buku.create', compact('kategoris', 'raks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'sinopsis' => 'nullable',
            'penerbit' => 'required',
            'tahun' => 'required|numeric|digits:4|min:1900|max:' . date('Y'),
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'rak_id' => 'required|exists:raks,id',
            'foto'  => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // 1. Buat instance model baru
        $buku = new Buku();
        $buku->judul = $request->input('judul');
        $buku->pengarang = $request->input('pengarang');
        $buku->sinopsis = $request->input('sinopsis');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun = $request->input('tahun');
        $buku->stok = $request->input('stok');
        $buku->kategori_id = $request->input('kategori_id');
        $buku->rak_id = $request->input('rak_id');

       if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            
            $file->storeAs('buku', $namaFile, 'public');
            
            $buku->foto = $namaFile;
        }

        // 3. Simpan ke database (HANYA SEKALI SAJA)
        $buku->save(); 

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'sinopsis' => 'nullable',
            'penerbit' => 'required',
            'tahun' => 'required|numeric|digits:4|min:1900|max:' . date('Y'),
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'rak_id' => 'required|exists:raks,id',
            'foto'  => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->judul = $request->input('judul');
        $buku->pengarang = $request->input('pengarang');
        $buku->sinopsis = $request->input('sinopsis');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun = $request->input('tahun');
        $buku->stok = $request->input('stok');
        $buku->kategori_id = $request->input('kategori_id');
        $buku->rak_id = $request->input('rak_id');

        if ($request->hasFile('foto')) {

            if ($buku->foto && Storage::disk('public')->exists('buku/' . $buku->foto)) {
                Storage::disk('public')->delete('buku/' . $buku->foto);
            }
            
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            
            $file->storeAs('buku', $namaFile, 'public'); 
            
            $buku->foto = $namaFile;
        }

        $buku->save();
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->foto && Storage::disk('public')->exists('buku/' . $buku->foto)) {
            Storage::disk('public')->delete('buku/' . $buku->foto);
        }

        $buku->delete();
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
    }
    
    public function export_excel(Request $request)
    {
        $search = $request->query('search');
        // Kirim variabel search ke dalam class BukuExport
        return Excel::download(new BukuExport($search), 'laporan-buku-' . date('Y-m-d') . '.xlsx');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && is_array($ids)) {
            // Jika Anda menggunakan SoftDeletes, ini akan memindahkan ke sampah
            // Jika tidak, ini akan menghapus permanen
            Buku::whereIn('id', $ids)->delete();
            
            return redirect()->back()->with('success', count($ids) . ' buku berhasil dihapus sekaligus.');
        }
        
        return redirect()->back()->with('error', 'Pilih buku yang ingin dihapus.');
    }
}
