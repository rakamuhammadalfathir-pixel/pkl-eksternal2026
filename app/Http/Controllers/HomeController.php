<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Menampilkan halaman utama (Landing Page)
     */
    public function index()
    {
        $kategori = Kategori::withCount('buku')->get();

        $buku = Buku::with('kategori')->latest()->take(8)->get();

        return view('home', compact('kategori', 'buku'));
    }
}