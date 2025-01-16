<?php

namespace App\Repositories;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Produk;

class TransaksiRepository
{
    public function getAll(int $perPage)
    {
        return Transaksi::paginate($perPage);
    }

    public function create(array $data)
    {
        return Transaksi::create($data);
    }

    public function findById(string $id)
    {
        return Transaksi::with('details')->findOrFail($id);
    }

    public function getTransactionById(string $id)
    {
        return DetailTransaksi::whereTransaksiId($id)->get();
    }

    public function isValidProductId(string $produkId)
    {
        return Produk::where('id', $produkId)->exists();
    }

    public function addProduct(string $transaksiId, string $produkId, int $qty, string $action)
    {
        $transaksi = Transaksi::findOrFail($transaksiId);
        $produk = Produk::findOrFail($produkId);
        $produk_name = $produk->name;

        $qty = $action === 'minus' ? max(1, $qty - 1) : $qty + 1;

        $subtotal = $produk->harga * $qty;
        $transaksi->details()->updateOrCreate(
            ['produk_id' => $produkId],
            ['produk_name' => $produk_name, 'qty' => $qty, 'subtotal' => $subtotal]
    
        );

        $transaksi->total = $transaksi->details->sum('subtotal');
        $transaksi->save();

        return [
            'produk' => $produk,
            'qty' => $qty,
            'subtotal' => $subtotal,
        ];
    }

    public function calculateChange(string $transaksiId, int $jumlahBayar)
    {
        $transaksi = Transaksi::findOrFail($transaksiId);
        return max(0, $jumlahBayar - $transaksi->total);
    }

    public function getAllProducts()
    {
        return Produk::all();
    }

    public function delete(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return true;
    }
}
