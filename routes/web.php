<?php

// ============================================================
// routes/web.php
// ============================================================

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelulusanController;

// Halaman publik cek kelulusan
Route::get('/', [KelulusanController::class, 'index'])->name('kelulusan');
// Route::get('/', function () {
//     return view('welcome');
// });

// Auth
Route::get('/login',   [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',  [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Area admin (wajib login)
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tahun Ajaran CRUD
    Route::resource('tahun-ajaran', TahunAjaranController::class)
         ->except(['create', 'edit']);

    // Siswa CRUD (nested di bawah tahun-ajaran)
    Route::post('/tahun-ajaran/{tahunAjaran}/siswa',          [SiswaController::class, 'store'])  ->name('tahun-ajaran.siswa.store');
    Route::put('/tahun-ajaran/{tahunAjaran}/siswa/{siswa}',   [SiswaController::class, 'update']) ->name('tahun-ajaran.siswa.update');
    Route::delete('/tahun-ajaran/{tahunAjaran}/siswa/{siswa}',[SiswaController::class, 'destroy'])->name('tahun-ajaran.siswa.destroy');
    Route::post('/tahun-ajaran/{tahunAjaran}/siswa/import', [SiswaController::class, 'import'])
        ->name('tahun-ajaran.siswa.import');
});
