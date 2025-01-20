<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah produk
        $jumlahProduk = Produk::count();

        // Mengambil jumlah user
        $jumlahUser = User::count();

        // Mengambil jumlah transaksi
        $jumlahTransaksi = Transaksi::count();

        // Mengambil total pendapatan
        $jumlahPendapatan = Transaksi::sum('total'); 

        // Mengambil pendapatan per hari
        $pendapatanPerHari = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total) as pendapatan')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->pluck('pendapatan', 'tanggal')
            ->toArray();

        // Mengirim data ke view dashboard
        $data = [
            'title' => 'Kelola Transaksi',
            'jumlahProduk' => $jumlahProduk,
            'jumlahUser' => $jumlahUser,
            'jumlahTransaksi' => $jumlahTransaksi,
            'jumlahPendapatan' => $jumlahPendapatan,
            'pendapatanPerHari' => $pendapatanPerHari, // Data pendapatan per hari
            'content' => 'admin/dashboard/index',
        ];
        
        return view('admin.layouts.wrapper', $data);
    }
}

