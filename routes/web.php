    <?php

    use App\Http\Controllers\Admin\BukuController;
    use App\Http\Controllers\Admin\AnggotaController;
    use App\Http\Controllers\Admin\PeminjamanController;
    use App\Http\Controllers\Admin\PengembalianController;
    use App\Http\Controllers\Admin\KategoriController;
    use App\Http\Controllers\Admin\RakController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\KatalogController;
    use App\Http\Controllers\KeranjangController;
    use App\Http\Controllers\Admin\DashboardController;
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
            
        Route::get('/home', [HomeController::class, 'index'])->name('home');
            // Katalog
            Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
            Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('catalog.show');

            // Keranjang
            Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
            Route::post('/keranjang/add', [KeranjangController::class, 'add'])->name('keranjang.add');
            Route::delete('/keranjang/remove', [KeranjangController::class, 'remove'])->name('keranjang.remove');
            Route::post('/keranjang/clear', [KeranjangController::class, 'clear'])->name('keranjang.clear');
            Route::post('/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('peminjaman.bulk_store');
            Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
            Route::get('/history-peminjaman', [KeranjangController::class, 'history'])->name('peminjaman.index');
            Route::post('/kembalikan/{id}', [KeranjangController::class, 'kembalikanBuku'])->name('peminjaman.kembali');

            // Pengembalian
            Route::post('/pengembalian/{id}', [PengembalianController::class, 'store'])->name('pengembalian.store');


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