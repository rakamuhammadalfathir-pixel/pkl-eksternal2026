<?php

namespace App\Http\Controllers;

use App\Models\Buku;     
use App\Models\Kategori;  
use App\Models\Rak;      
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::all(); 
        $raks = Rak::all();

        $query = Buku::with(['kategori', 'rak']); 

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('pengarang', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->has('rak') && $request->rak != '') {
            $query->where('rak_id', $request->rak);
        }

        $buku = $query->latest()->paginate(9);

        return view('katalog.index', compact('buku', 'kategoris', 'raks'));
    }

    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('katalog.show', compact('buku'));
    }
}