<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // User mungkin ingin melihat buku terbaru di dashboard mereka
        $bukuTerbaru = Buku::latest()->take(4)->get();
        return view('user.dashboard', compact('bukuTerbaru'));
    }
}