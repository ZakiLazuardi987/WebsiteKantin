<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDetailTransaksiController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [AdminAuthController::class,'index'])->name('login')->middleware('guest');
Route::post('/login/do', [AdminAuthController::class,'doLogin'])->middleware('guest');
Route::get('/logout', [AdminAuthController::class,'logout'])->middleware('auth');

// Route::get('/', function () {
//     $data = [
//         'content' => 'admin.dashboard.index'
//     ];
//     return view('admin.layouts.wrapper', $data);
// })->middleware('auth');

Route::prefix('/admin')->middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
    
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

    // Route::resource('/transaksi', AdminTransaksiController::class)->names([
    //     'edit' => 'transaksi.edit',
    //     'create' => 'transaksi.create',
    //     'destroy' => 'destroy.destroy'

    // ]);
        
    
});
