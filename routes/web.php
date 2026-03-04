    <?php

    use App\Http\Controllers\Admin\BukuController;
    use App\Http\Controllers\Admin\AnggotaController;
    use App\Http\Controllers\Admin\PeminjamanController;
    use App\Http\Controllers\Admin\PeminjamanDetailController;
    use App\Http\Controllers\Admin\PengembalianController;
    use App\Http\Controllers\Admin\KategoriController;
    use App\Http\Controllers\Admin\RakController;
    use App\Http\Controllers\HomeController;
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

        Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
            
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            Route::resource('buku', BukuController::class);
            Route::resource('anggota', AnggotaController::class);
            Route::resource('peminjaman', PeminjamanController::class);
            Route::resource('peminjaman_detail', PeminjamanDetailController::class);
            Route::resource('pengembalian', PengembalianController::class);
            Route::resource('kategori', KategoriController::class);
            Route::resource('rak', RakController::class);

            Route::patch('/anggota/update-role/{id}', [AnggotaController::class, 'updateRole'])->name('anggota.updateRole');
            
        });
    });