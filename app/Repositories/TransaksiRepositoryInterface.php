<?php

namespace App\Repositories;

interface TransaksiRepositoryInterface
{
    public function getAll(int $perPage);
    public function create(array $data);
    public function findById(string $id);
    public function getTransactionById(string $id);
    public function isValidProductId(string $produkId);
    public function addProduct(string $transaksiId, string $produkId, int $qty, string $action);
    public function calculateChange(string $transaksiId, int $jumlahBayar);
    public function getAllProducts();
    public function delete(string $id);
}
