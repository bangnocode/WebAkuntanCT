<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\LaporanController;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Master Rekening
    Route::get('/rekening', [RekeningController::class, 'index'])->name('rekening.index');
    Route::post('/rekening', [RekeningController::class, 'store'])->name('rekening.store');
    Route::get('/rekening/{koder}/edit', [RekeningController::class, 'edit'])->name('rekening.edit');
    Route::put('/rekening/{koder}', [RekeningController::class, 'update'])->name('rekening.update');
    Route::delete('/rekening/{koder}', [RekeningController::class, 'destroy'])->name('rekening.destroy');

    // Jurnal
    Route::get('/jurnal/search-rekening', [JurnalController::class, 'searchRekening'])->name('jurnal.search');
    Route::get('/jurnal', [JurnalController::class, 'create'])->name('jurnal.create');
    Route::post('/jurnal', [JurnalController::class, 'store'])->name('jurnal.store');
    Route::post('/jurnal/sync-balances', [JurnalController::class, 'syncBalances'])->name('jurnal.sync');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/neraca', [App\Http\Controllers\LaporanKeuanganController::class, 'neraca'])->name('laporan.neraca');
    Route::get('/laporan/labarugi', [App\Http\Controllers\LaporanKeuanganController::class, 'labarugi'])->name('laporan.labarugi');
});
