<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamanDetailController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// =========================================================
// 1. RUTE UNTUK SEMUA USER (Admin & Anggota) yang SUDAH LOGIN
// =========================================================
Route::middleware('auth')->group(function () {
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // =========================================================
    // 2. RUTE KHUSUS ADMIN SAJA
    // =========================================================
    Route::middleware('admin')->group(function () {
        
        // Dashboard Khusus Admin
        Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

        // Kelola Data Buku (Hanya Admin yang boleh CRUD)
        Route::resource('buku', BukuController::class);
        Route::resource('anggota', AnggotaController::class);
        Route::resource('peminjaman', PeminjamanController::class);
        Route::resource('peminjaman_detail', PeminjamanDetailController::class);
        Route::resource('pengembalian', PengembalianController::class);
        
        // Nantinya kamu bisa tambah rute anggota, peminjaman, dll di sini
    });
});