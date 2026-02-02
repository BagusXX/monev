<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonitoringKegiatanController;
use App\Http\Controllers\LaporanKegiatanController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\MonitoringRapatController;
use App\Http\Controllers\LaporanRapatController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware('auth')->group(function () {
    // Home/Dashboard
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Setup
    Route::get('/setup', function () {
        $users = User::with(['kota', 'kabupaten'])
            ->latest()
            ->paginate(10);
        return view('setup', compact('users'));
    })->name('setup');

    // Monitoring Rapat
    Route::get('/monitor', [MonitoringRapatController::class, 'index'])->name('monitor');
    Route::post('/monitor', [MonitoringRapatController::class, 'store'])->name('monitor.store');

    // Monitoring Kegiatan
    Route::get('/monitoring/kegiatan', [MonitoringKegiatanController::class, 'index'])
        ->name('monitoring.kegiatan');
    Route::post('/monitoring/kegiatan', [MonitoringKegiatanController::class, 'store'])
        ->name('monitoring.kegiatan.store');
    Route::delete('/monitoring/kegiatan/{kegiatan}', [MonitoringKegiatanController::class, 'destroy'])
        ->name('monitoring.kegiatan.destroy');

    // Laporan Kegiatan
    Route::get('/laporan/kegiatan', [LaporanKegiatanController::class, 'index'])
        ->name('laporan.kegiatan');

    // Laporan Rapat
    Route::get('/laporan/rapat', [LaporanRapatController::class, 'index'])
        ->name('laporan.rapat');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User Management Routes (via Setup)
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Wilayah (Kota & Kabupaten) Routes - Consolidated
    Route::get('/wilayah', [App\Http\Controllers\WilayahController::class, 'index'])->name('wilayah.index');
    Route::get('/wilayah/create', [App\Http\Controllers\WilayahController::class, 'create'])->name('wilayah.create');
    Route::post('/wilayah/kota', [App\Http\Controllers\WilayahController::class, 'storeKota'])->name('wilayah.store.kota');
    Route::post('/wilayah/kabupaten', [App\Http\Controllers\WilayahController::class, 'storeKabupaten'])->name('wilayah.store.kabupaten');
    Route::get('/wilayah/kota/{kota}/edit', [App\Http\Controllers\WilayahController::class, 'editKota'])->name('wilayah.edit.kota');
    Route::get('/wilayah/kabupaten/{kabupaten}/edit', [App\Http\Controllers\WilayahController::class, 'editKabupaten'])->name('wilayah.edit.kabupaten');
    Route::patch('/wilayah/kota/{kota}', [App\Http\Controllers\WilayahController::class, 'updateKota'])->name('wilayah.update.kota');
    Route::patch('/wilayah/kabupaten/{kabupaten}', [App\Http\Controllers\WilayahController::class, 'updateKabupaten'])->name('wilayah.update.kabupaten');
    Route::delete('/wilayah/kota/{kota}', [App\Http\Controllers\WilayahController::class, 'destroyKota'])->name('wilayah.destroy.kota');
    Route::delete('/wilayah/kabupaten/{kabupaten}', [App\Http\Controllers\WilayahController::class, 'destroyKabupaten'])->name('wilayah.destroy.kabupaten');

    // Per Wilayah Routes
    Route::resource('kecamatan', App\Http\Controllers\KecamatanController::class);
    Route::resource('kelurahan', App\Http\Controllers\KelurahanController::class);
    
    // Keep old kota/kabupaten routes for backward compatibility (optional, can be removed if not used elsewhere)
    Route::resource('kota', KotaController::class)->parameters(['kota' => 'kota'])->except(['show']);
    Route::resource('kabupaten', KabupatenController::class)->except(['show']);
});

require __DIR__.'/auth.php';
