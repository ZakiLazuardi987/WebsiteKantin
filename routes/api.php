<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDetailTransaksiController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AdminAuthController::class, 'login']);
Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth:sanctum');

// Group API dengan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'data'])->name('dashboard.data');

    // Transaksi detail
    Route::get('/transaksi/detail/done/{id}', [AdminDetailTransaksiController::class, 'done']);
    Route::delete('/transaksi/detail/delete', [AdminDetailTransaksiController::class, 'delete']);
    Route::post('/transaksi/detail/create', [AdminDetailTransaksiController::class, 'create']);

    // Transaksi utama
    Route::get('/transaksi', [AdminTransaksiController::class, 'index']);
    Route::post('/transaksi', [AdminTransaksiController::class, 'store']);
    Route::get('/transaksi/{id}', [AdminTransaksiController::class, 'show']);
    Route::put('/transaksi/{id}', [AdminTransaksiController::class, 'update']);
    Route::delete('/transaksi/{id}', [AdminTransaksiController::class, 'destroy']);
    
    Route::get('/transaksi', [AdminTransaksiController::class, 'index']);
    Route::post('/transaksi', [AdminTransaksiController::class, 'store']);
    Route::get('/transaksi/{id}', [AdminTransaksiController::class, 'show']);
    Route::put('/transaksi/{id}', [AdminTransaksiController::class, 'update']);
    Route::delete('/transaksi/{id}', [AdminTransaksiController::class, 'destroy']);

    // CRUD Produk, Kategori, dan User menggunakan API Resource
    Route::apiResource('/produk', AdminProdukController::class);
    Route::apiResource('/kategori', AdminKategoriController::class);
    Route::apiResource('/user', AdminUserController::class);
});
