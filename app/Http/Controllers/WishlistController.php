<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = auth()->user()->wishlist()->latest()->get();
        
        return view('wishlist.index', compact('wishlist'));
    }
    public function toggle($bukuId)
    {
        $user = Auth::user();
        $user->wishlist()->toggle($bukuId);

        return back()->with('success', 'Wishlist diperbarui!');
    }
}