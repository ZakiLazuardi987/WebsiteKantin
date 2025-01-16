<?php

namespace App\Services;

use App\Repositories\ProdukRepositoryInterface;

class ProdukService
{
    protected ProdukRepositoryInterface $produkRepository;

    public function __construct(ProdukRepositoryInterface $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function getAllProducts(int $pagination): mixed
    {
        return $this->produkRepository->getAll($pagination);
    }

    public function getProductById(string $id): mixed
    {
        return $this->produkRepository->findById($id);
    }

    public function createProduct(array $data): mixed
    {
        return $this->produkRepository->create($data);
    }

    public function updateProduct(string $id, array $data): bool
    {
        return $this->produkRepository->update($id, $data);
    }

    public function deleteProduct(string $id): bool
    {
        return $this->produkRepository->delete($id);
    }
}
