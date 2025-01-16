<?php

namespace App\Repositories;

interface DetailTransaksiRepositoryInterface
{
    public function create(array $data): mixed;

    public function update(string $id, array $data): bool;

    public function delete(string $id): bool;

    public function findByProdukAndTransaksi(string $produkId, string $transaksiId): mixed;

    public function getTransaksiById(string $id): mixed;
}
