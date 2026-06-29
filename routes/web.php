<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;

// Auth Routes
Route::get('/', function () { return redirect()->route('login'); });
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin only routes
    Route::middleware(['role:admin'])->group(function () {
        // Dosen
        Route::resource('dosen', DosenController::class);

        // Mahasiswa
        Route::resource('mahasiswa', MahasiswaController::class);

        // Mata Kuliah
        Route::resource('matakuliah', MatakuliahController::class);

        // Jadwal
        Route::resource('jadwal', JadwalController::class);

        // KRS admin view
        Route::get('/krs', [KrsController::class, 'adminIndex'])->name('krs.admin');
        Route::get('/krs/mahasiswa/{npm}', [KrsController::class, 'showByMahasiswa'])->name('krs.mahasiswa');
    });

    // Mahasiswa only routes
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/my-krs', [KrsController::class, 'index'])->name('krs.index');
        Route::post('/my-krs', [KrsController::class, 'store'])->name('krs.store');
        Route::delete('/my-krs/{id}', [KrsController::class, 'destroy'])->name('krs.destroy');
        Route::get('/jadwal-view', [JadwalController::class, 'mahasiswaView'])->name('jadwal.mahasiswa');
    });
});
