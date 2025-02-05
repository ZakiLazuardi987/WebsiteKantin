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
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'content' => 'admin/dashboard/index',
            'user' => Auth::user(),
        ];

        // Mengembalikan view dengan data
        return view('admin.layouts.wrapper', $data);
    }
    
    public function data()
    {
        $user = Auth::user();
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
            'success' => true,
            'status' => 'success',
            'message' => 'Dashboard data retrieved successfully',
            'user' => $user ? ['name' => $user->name, 'email' => $user->email] : null,
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
