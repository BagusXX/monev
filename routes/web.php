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
    // Approval pending page (no approval check needed for this route)
    Route::get('/approval/pending', [App\Http\Controllers\ApprovalController::class, 'pending'])->name('approval.pending');
    Route::get('/approval/rejected', [App\Http\Controllers\ApprovalController::class, 'rejected'])->name('approval.rejected');

    // Home/Dashboard
    Route::get('/home', function () {
        $kecamatanCount = 576; // fixed value for Jawa Tengah
        $kelurahanCount = 8560; // fixed value for Jawa Tengah
        $bulan = \Carbon\Carbon::now()->format('Y-m');
        $kegiatanCount = \App\Models\Kegiatan::where('bulan', $bulan)->count();

        return view('home', compact('kecamatanCount', 'kelurahanCount', 'kegiatanCount'));
    })->name('home');

    // Setup
    Route::get('/setup', function () {
        $users = User::with(['daerah'])
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

    // Monitoring Rapat (add delete action)
    Route::delete('/monitoring/rapat/{rapat}', [MonitoringRapatController::class, 'destroy'])
        ->name('monitoring.rapat.destroy');

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
    Route::patch('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::patch('/users/{user}/reject', [UserController::class, 'reject'])->name('users.reject');

    // Daerah (Province/Region) Routes
    Route::resource('daerah', App\Http\Controllers\DaerahController::class);

    // Per Wilayah Routes
    Route::resource('kecamatan', App\Http\Controllers\KecamatanController::class);
    Route::resource('kelurahan', App\Http\Controllers\KelurahanController::class);
    
    // Kota & Kabupaten Routes
    Route::resource('kota', KotaController::class)->parameters(['kota' => 'kota'])->except(['show']);
    Route::resource('kabupaten', KabupatenController::class)->except(['show']);
});

require __DIR__.'/auth.php';
