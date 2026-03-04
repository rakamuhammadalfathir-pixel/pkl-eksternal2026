<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

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
        $buku = Buku::with('kategori')->latest()->get(); 
        
         return view('home', compact('buku'));
    }
}