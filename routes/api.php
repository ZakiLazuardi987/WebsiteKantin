<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiDetailTransaksiController;
use App\Http\Controllers\Api\ApiKategoriController;
use App\Http\Controllers\Api\ApiProdukController;
use App\Http\Controllers\Api\ApiTransaksiController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiAuthController::class, 'login']);
Route::middleware('auth')->post('/logout', [ApiAuthController::class, 'logout']);

// Group API dengan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'data'])->name('dashboard.data');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Transaksi detail
    Route::get('/transaksi/detail/done/{id}', [ApiDetailTransaksiController::class, 'done']);
    Route::delete('/transaksi/detail/delete', [ApiDetailTransaksiController::class, 'delete']);
    Route::post('/transaksi/detail/create', [ApiDetailTransaksiController::class, 'create']);

    // Transaksi utama
    Route::get('/transaksi', [ApiTransaksiController::class, 'index']);
    Route::post('/transaksi', [ApiTransaksiController::class, 'store']);
    Route::get('/transaksi/{id}', [ApiTransaksiController::class, 'show']);
    Route::post('/transaksi/{id}/edit', [ApiTransaksiController::class, 'edit']);
    Route::delete('/transaksi/{id}', [ApiTransaksiController::class, 'destroy']);

    // CRUD Produk, Kategori, dan User menggunakan API Resource
    Route::apiResource('/transaksi', controller: ApiTransaksiController::class);
    Route::apiResource('/produk', controller: ApiProdukController::class);
    Route::apiResource('/kategori', controller: ApiKategoriController::class);
});

Route::middleware('auth:sanctum')->prefix('users')->group(function () {
    Route::get('/', [ApiUserController::class, 'index']);
    Route::post('/', [ApiUserController::class, 'store']);
    Route::get('/{id}', [ApiUserController::class, 'show']);
    Route::put('/{id}', [ApiUserController::class, 'update']);
    Route::delete('/{id}', [ApiUserController::class, 'destroy']);
});
