<?php

namespace App\Services;

use App\Repositories\TransaksiRepository;

class TransaksiService
{
    protected TransaksiRepository $transaksiRepository;

    public function __construct(TransaksiRepository $transaksiRepository)
    {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function getAllTransactions(int $perPage)
    {
        return $this->transaksiRepository->getAll($perPage);
    }

    public function createTransaction(array $data)
    {
        return $this->transaksiRepository->create($data);
    }

    public function getTransactionById(string $id)
    {
        return $this->transaksiRepository->findById($id);
    }

    public function getTransactionDetail(string $id)
    {
        return $this->transaksiRepository->getTransactionById($id);
    }

    public function isValidProductId(string $produkId)
    {
        return $this->transaksiRepository->isValidProductId($produkId);
    }

    public function addProductToTransaction(string $id, string $produkId, int $qty, string $action)
    {
        return $this->transaksiRepository->addProduct($id, $produkId, $qty, $action);
    }

    public function calculateChange(string $id, int $jumlahBayar)
    {
        return $this->transaksiRepository->calculateChange($id, $jumlahBayar);
    }

    public function getAllProducts()
    {
        return $this->transaksiRepository->getAllProducts();
    }

    public function deleteTransaction(string $id)
    {
        return $this->transaksiRepository->delete($id);
    }
}
