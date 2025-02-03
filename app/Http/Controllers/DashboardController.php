<?php

namespace App\Http\Controllers;

// use App\Models\Produk;
// use App\Models\User;
// use App\Models\Transaksi;
// use Illuminate\Http\Request;

// class DashboardController extends Controller
// {
//     public function index()
//     {
//         // Mengambil jumlah produk
//         $jumlahProduk = Produk::count();

//         // Mengambil jumlah user
//         $jumlahUser = User::count();

//         // Mengambil jumlah transaksi
//         $jumlahTransaksi = Transaksi::count();

//         // Mengambil total pendapatan
//         $jumlahPendapatan = Transaksi::sum('total'); 

//         // Mengambil pendapatan per hari
//         $pendapatanPerHari = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total) as pendapatan')
//             ->groupBy('tanggal')
//             ->orderBy('tanggal', 'asc')
//             ->pluck('pendapatan', 'tanggal')
//             ->toArray();

//         // Mengirim data ke view dashboard
//         $data = [
//             'title' => 'Kelola Transaksi',
//             'jumlahProduk' => $jumlahProduk,
//             'jumlahUser' => $jumlahUser,
//             'jumlahTransaksi' => $jumlahTransaksi,
//             'jumlahPendapatan' => $jumlahPendapatan,
//             'pendapatanPerHari' => $pendapatanPerHari, // Data pendapatan per hari
//             'content' => 'admin/dashboard/index',
//         ];
        
//         return view('admin.layouts.wrapper', $data);
//     }
// }

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data yang dibutuhkan untuk tampilan
        $jumlahProduk = Produk::count();
        $jumlahUser = User::count();
        $jumlahTransaksi = Transaksi::count();
        $jumlahPendapatan = Transaksi::sum('total');
        $pendapatanPerHari = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total) as pendapatan')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->pluck('pendapatan', 'tanggal')
            ->toArray();

        // Menyusun data untuk dikirim ke view
        $data = [
            'title' => 'Dashboard',
            'jumlahProduk' => $jumlahProduk,
            'jumlahUser' => $jumlahUser,
            'jumlahTransaksi' => $jumlahTransaksi,
            'jumlahPendapatan' => $jumlahPendapatan,
            'pendapatanPerHari' => $pendapatanPerHari,
            'content' => 'admin/dashboard/index',
        ];

        // Mengembalikan view dengan data
        return view('admin.layouts.wrapper', $data);
    }
    
    public function data()
    {
        // Mengambil data untuk API
        $jumlahProduk = Produk::count();
        $jumlahUser = User::count();
        $jumlahTransaksi = Transaksi::count();
        $jumlahPendapatan = Transaksi::sum('total');
        $pendapatanPerHari = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total) as pendapatan')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->pluck('pendapatan', 'tanggal')
            ->toArray();

        // Menyusun data untuk respons API
        $data = [
            'status' => 'success',
            'message' => 'Dashboard data retrieved successfully',
            'jumlahProduk' => $jumlahProduk,
            'jumlahUser' => $jumlahUser,
            'jumlahTransaksi' => $jumlahTransaksi,
            'jumlahPendapatan' => $jumlahPendapatan,
            'pendapatanPerHari' => $pendapatanPerHari,
        ];

        // Mengirimkan respons API dalam format JSON
        return response()->json($data, 200);
    }
}
