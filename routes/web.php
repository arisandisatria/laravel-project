<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResepController;
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

        Route::get('/dashboard-pasien', [\App\Http\Controllers\PasienController::class, 'index'])->name('pasien.dashboard');

        Route::get('/jadwal-minum', [App\Http\Controllers\PasienController::class, 'jadwalMinum'])->name('pasien.jadwal');

        Route::post('/jadwal-minum/tandai', [App\Http\Controllers\PasienController::class, 'tandaiDiminum'])->name('pasien.jadwal.tandai');

        Route::get('/jadwal-minum/riwayat', [App\Http\Controllers\PasienController::class, 'riwayatResep'])->name('pasien.riwayat-resep');
    });

    // DOKTER
    Route::middleware(['role:dokter'])->group(function () {

        Route::get('/dokter', [\App\Http\Controllers\DokterController::class, 'index'])->name("dokter.dashboard");

        Route::get('/manajemen-pasien', [\App\Http\Controllers\DokterController::class, 'manajemenPasien'])->name('dokter.pasien');

        // REKAM MEDIS
        Route::get('/dokter/rekam-medis/{id}/edit', [App\Http\Controllers\DokterController::class, 'editRekamMedis'])->name('dokter.rekam-medis.edit');

        Route::put('/dokter/rekam-medis/{id}', [App\Http\Controllers\DokterController::class, 'updateRekamMedis'])->name('dokter.rekam-medis.update');

        Route::delete('/dokter/rekam-medis/{id}', [App\Http\Controllers\DokterController::class, 'destroyRekamMedis'])->name('dokter.rekam-medis.destroy');

        Route::get('/dokter/rekam-medis/{id}/periksa', [App\Http\Controllers\DokterController::class, 'periksa'])->name('dokter.rekam-medis.periksa');

        Route::post('/dokter/rekam-medis/{id}/periksa', [App\Http\Controllers\DokterController::class, 'simpanPemeriksaan'])->name('dokter.rekam-medis.simpan-pemeriksaan');

        // RESEP
        Route::get('/kelola-resep', [App\Http\Controllers\DokterController::class, 'indexResep'])->name('dokter.resep.index');

        Route::get('/kelola-resep/create', [App\Http\Controllers\DokterController::class, 'createResep'])->name('dokter.resep.create');

        Route::post('/kelola-resep/create', [App\Http\Controllers\DokterController::class, 'storeResep'])->name('dokter.resep.store');

        Route::get('/kelola-resep/{id}/edit', [App\Http\Controllers\DokterController::class, 'editResep'])->name('dokter.resep.edit');

        Route::put('/kelola-resep/{id}', [App\Http\Controllers\DokterController::class, 'updateResep'])->name('dokter.resep.update');

        Route::delete('/kelola-resep/{id}', [App\Http\Controllers\DokterController::class, 'destroyResep'])->name('dokter.resep.destroy');
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

        Route::get('/permintaan-resep/proses/{id}', [\App\Http\Controllers\ResepController::class, 'proses'])->name('permintaan-resep.proses');

        Route::put('/permintaan-resep/proses/{id}', [\App\Http\Controllers\ResepController::class, 'updateStatus'])->name('permintaan-resep.update');
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
