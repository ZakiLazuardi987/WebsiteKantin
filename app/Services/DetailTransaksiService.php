<?php

namespace App\Services;

use App\Models\DetailTransaksi;
use App\Repositories\DetailTransaksiRepositoryInterface;
use App\Models\Transaksi;

class DetailTransaksiService
{
    protected DetailTransaksiRepositoryInterface $detailTransaksiRepository;

    public function __construct(DetailTransaksiRepositoryInterface $detailTransaksiRepository)
    {
        $this->detailTransaksiRepository = $detailTransaksiRepository;
    }

    public function createDetailTransaksi(array $data): mixed
    {
        $detailTransaksi = $this->detailTransaksiRepository->findByProdukAndTransaksi($data['produk_id'], $data['transaksi_id']);

        if (!$detailTransaksi) {
            return $this->detailTransaksiRepository->create($data);
        }

        $data['qty'] += $detailTransaksi->qty;
        $data['subtotal'] += $detailTransaksi->subtotal;
        $this->detailTransaksiRepository->update($detailTransaksi->id, $data);

        return $detailTransaksi;
    }

    public function deleteDetailTransaksi(string $id): bool
    {
        return $this->detailTransaksiRepository->delete($id);
    }

    public function finalizeTransaksi(string $id): bool
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status' => 'selesai']);
        return true;
    }

    public function getTransaksiById(string $id)
    {
        return Transaksi::with('details')->findOrFail($id);
    }
}
