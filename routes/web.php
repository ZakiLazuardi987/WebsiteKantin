<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDetailTransaksiController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TesLogin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/landing/index');
});
Route::get('/login', [AdminAuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/do', [ApiAuthController::class, 'login']);
Route::get('/logout', [ApiAuthController::class, 'logout'])->middleware('auth');
// Route::get('/teslogin', [TesLogin::class, 'index']);

Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/transaksi/detail/done/{id}', [AdminDetailTransaksiController::class, 'done']);
    Route::get('/transaksi/detail/delete', [AdminDetailTransaksiController::class, 'delete']);
    Route::post('/transaksi/detail/create', [AdminDetailTransaksiController::class, 'create']);

    Route::get('transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/create', [AdminTransaksiController::class, 'create'])->name('transaksi.create');
    Route::get('transaksi/{id}/edit', [AdminTransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::delete('transaksi/{id}', [AdminTransaksiController::class, 'destroy'])->name('transaksi.destroy');

    Route::resource('/produk', AdminProdukController::class);
    Route::resource('/kategori', AdminKategoriController::class);
    Route::resource('/user', AdminUserController::class);
});
