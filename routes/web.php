    <?php

    use App\Http\Controllers\Admin\BukuController;
    use App\Http\Controllers\Admin\AnggotaController;
    use App\Http\Controllers\Admin\PeminjamanController;
    use App\Http\Controllers\Admin\PengembalianController;
    use App\Http\Controllers\Admin\KategoriController;
    use App\Http\Controllers\Admin\RakController;
    use App\Http\Controllers\Admin\DashboardController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\KatalogController;
    use App\Http\Controllers\PeminjamanBukuController;
    use App\Http\Controllers\ProfileController;
    
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Auth::routes();

    Route::middleware('auth')->group(function () {

        Route::get('/home', function() {
            return Auth::user()->role == 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('home');
        });
            
        // Route::get('/home', [HomeController::class, 'index'])->name('home');

            // Katalog
            Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
            Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('catalog.show');

            // Peminjaman Buku
            Route::get('/peminjamanbuku', [PeminjamanBukuController::class, 'index'])->name('peminjamanbuku.index');
            Route::post('/peminjamanbuku/add', [PeminjamanBukuController::class, 'add'])->name('peminjamanbuku.add');
            Route::delete('/peminjamanbuku/remove', [PeminjamanBukuController::class, 'remove'])->name('peminjamanbuku.remove');
            Route::post('/peminjamanbuku/clear', [PeminjamanBukuController::class, 'clear'])->name('peminjamanbuku.clear');
            Route::post('/peminjamanbuku/checkout', [PeminjamanBukuController::class, 'checkout'])->name('peminjaman.bulk_store');
            Route::get('/history-peminjaman', [PeminjamanBukuController::class, 'history'])->name('peminjaman.history');
            Route::post('/kembalikan/{id}', [PeminjamanBukuController::class, 'kembalikanBuku'])->name('peminjaman.kembali');
            Route::post('/peminjaman/kembali/{id}', [PeminjamanBukuController::class, 'kembalikanBuku'])
                ->name('peminjaman.kembali');

        Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
            
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            Route::resource('buku', BukuController::class);
            Route::resource('anggota', AnggotaController::class);
            Route::resource('peminjaman', PeminjamanController::class);
            Route::resource('pengembalian', PengembalianController::class);
            Route::resource('kategori', KategoriController::class);
            Route::resource('rak', RakController::class);

            Route::patch('/anggota/update-role/{id}', [AnggotaController::class, 'updateRole'])->name('anggota.updateRole');
            
        });
    });