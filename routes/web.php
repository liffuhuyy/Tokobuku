<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ManagementbukuController;
use App\Http\Controllers\ManagementuserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Hanya admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/management-buku', [ManagementbukuController::class, 'index'])->name('admin.management_buku');
    Route::get('/management-kasir', [ManagementuserController::class, 'index'])->name('admin.management_kasir');
    Route::get('/riwayat-transaksi', [TransaksiController::class, 'index'])->name('admin.riwayat_transaksi');
});

// Hanya owner
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner', [OwnerController::class, 'index'])->name('owner.dashboard');
});

// Hanya kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.dashboard');
});
