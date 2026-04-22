<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/login', function() {
    return view('auth.login');
})->name('login');

Route::get('/register', function() {
    return view('auth.register');
})->name('register');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        if ($role === 'pasien') return redirect()->route('pasien.dashboard');
        if ($role === 'dokter') return redirect()->route('dokter.dashboard');
        if ($role === 'apoteker') return redirect()->route('apoteker.dashboard');
        if ($role === 'admin') return redirect()->route('admin.dashboard');

        abort(403, 'Role tidak valid.');
    })->name('dashboard');

    Route::middleware(['role:pasien'])->group(function () {

        Route::get('/pasien', function() {
            return view('pasien.index');
        })->name("pasien.dashboard");

        Route::get('/jadwal-minum-obat', function () {
            return view('pasien.jadwal');
        });
    });

    // DOKTER
    Route::middleware(['role:dokter'])->group(function () {

        Route::get('/dokter', function() {
            return view('dokter.index');
        })->name("dokter.dashboard");

        Route::get('/manajemen-pasien', function() {
            return view('dokter.pasien');
        });

        // REKAM MEDIS
        Route::get('/rekam-medis/create', function() {
            return view('dokter.rekam-medis.create');
        });

        Route::get('/rekam-medis/create', function() {
            return view('dokter.rekam-medis.create');
        });

        Route::get('/rekam-medis/edit/1', function() {
            return view('dokter.rekam-medis.edit');
        });

        // RESEP
        Route::get('/kelola-resep', function() {
            return view('dokter.resep.index');
        });

        Route::get('/kelola-resep/create', function() {
            return view('dokter.resep.create');
        });

        Route::get('/kelola-resep/edit/1', function() {
            return view('dokter.resep.edit');
        });


    });

    // APOTEKER
    Route::middleware(['role:apoteker'])->group(function () {

        Route::get("/apoteker", [\App\Http\Controllers\ApotekerController::class, 'index'])->name("apoteker.dashboard");

        // OBAT
       Route::resource('stok-obat', \App\Http\Controllers\ObatController::class);

        // RESEP
        Route::get('/permintaan-resep', [\App\Http\Controllers\ResepController::class, 'index'])->name('permintaan-resep.index');

        Route::get("/permintaan-resep/riwayat", function() {
            return view("apoteker.resep.riwayat");
        });

        Route::get("/permintaan-resep/proses/1", function() {
            return view("apoteker.resep.proses");
        });


    });

    // ADMIN
    Route::middleware(['role:admin'])->group(function () {

        Route::get("/admin", [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::resource('manajemen-user', \App\Http\Controllers\UserController::class);

        Route::get('/backup-database', [\App\Http\Controllers\AdminController::class, 'backupDatabase'])->name('admin.backup');

    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
