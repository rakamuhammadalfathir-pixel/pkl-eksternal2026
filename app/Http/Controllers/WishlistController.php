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

        $isWishlisted = auth()->user()->wishlist->contains($bukuId);
        $msg = $isWishlisted ? 'Buku berhasil ditambahkan ke Wishlist!' : 'Buku dihapus dari Wishlist.';
        
        return back()->with('success', $msg);
    }
}