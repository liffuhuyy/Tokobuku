<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ManagementbukuController;
use App\Http\Controllers\ManagementuserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Kategori;
use App\Http\Middleware\RoleMiddleware;

//model
use App\Models\DataBuku;


Route::get('/', function () {
    return view('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Hanya admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    //dashboard admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    //management buku
    Route::get('/management-buku', [ManagementbukuController::class, 'index'])->name('admin.management_buku');
    Route::post('/management-buku', [ManagementbukuController::class, 'store'])->name('admin.management_buku.store');
    Route::get('/admin/management_buku/kode/{kategori}', [ManagementBukuController::class, 'generateKode'])->name('admin.management_buku.generateKode');
    Route::delete('/admin/management_buku/{id}/delete', [ManagementBukuController::class, 'destroy'])->name('admin.management_buku.destroy');
    Route::get('/admin/management_buku/{id}/edit', [ManagementbukuController::class, 'edit'])->name('admin.management_buku.edit');
    Route::put('/admin/management_buku/{id}', [ManagementbukuController::class, 'update'])->name('admin.management_buku.update');

    //management user
    Route::get('/management-kasir', [ManagementuserController::class, 'index'])->name('admin.management_kasir');

    //management kategori
    Route::get('/management-kategori', [Kategori::class, 'index'])->name('admin.management_kategori');

    //riwayat transaksi
    Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('admin.riwayat_transaksi');
});


// Hanya owner
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner', [OwnerController::class, 'index'])->name('owner.dashboard');
    //data buku
    Route::get('/management_buku', [OwnerController::class, 'buku'])->name('owner.buku');
    //data user
    Route::get('/data-user', [OwnerController::class, 'data_user'])->name('owner.data_user');
    //penjualan
    Route::get('/penjualan', [OwnerController::class, 'penjualan'])->name('owner.penjualan');
    //riwayat transaksi
    Route::get('/riwayat-transaksi', [OwnerController::class, 'riwayat_transaksi'])->name('owner.riwayat_transaksi');
});


// Hanya kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.dashboard');

    //data buku
    Route::get('/data-buku', [ManagementbukuController::class, 'data_buku'])->name('kasir.data_buku');

    //transaksi
    Route::get('/transaksi', [TransaksiController::class, 'transaksi'])->name('kasir.transaksi');

    //riwayat transaksi
    Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayat_transaksi'])->name('kasir.riwayat_transaksi');
});
