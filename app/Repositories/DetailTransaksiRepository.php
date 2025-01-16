<?php

namespace App\Repositories;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;

class DetailTransaksiRepository implements DetailTransaksiRepositoryInterface
{
    public function create(array $data): mixed
    {
        return DetailTransaksi::create($data);
    }

    public function update(string $id, array $data): bool
    {
        $detailTransaksi = DetailTransaksi::findOrFail($id);
        return $detailTransaksi->update($data);
    }

    public function delete(string $id): bool
    {
        $detailTransaksi = DetailTransaksi::findOrFail($id);
        return $detailTransaksi->delete();
    }

    public function findByProdukAndTransaksi(string $produkId, string $transaksiId): mixed
    {
        return DetailTransaksi::where('produk_id', $produkId)
            ->where('transaksi_id', $transaksiId)
            ->first();
    }

    public function getTransaksiById(string $id): mixed
    {
        return DetailTransaksi::whereTransaksiId($id)->get();
    }
}
