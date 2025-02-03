<?php

namespace App\Services;

use App\Repositories\KategoriRepositoryInterface;

class KategoriService
{
    protected KategoriRepositoryInterface $kategoriRepository;

    public function __construct(KategoriRepositoryInterface $kategoriRepository)
    {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function getAllCategories(int $pagination, ?string $search = null): mixed
    {
        return $this->kategoriRepository->getAll($pagination, $search);
    }

    public function getCategoryById(string $id): mixed
    {
        return $this->kategoriRepository->findById($id);
    }

    public function createCategory(array $data): mixed
    {
        return $this->kategoriRepository->create($data);
    }

    public function updateCategory(string $id, array $data): bool
    {
        return $this->kategoriRepository->update($id, $data);
    }

    public function deleteCategory(string $id): bool
    {
        return $this->kategoriRepository->delete($id);
    }
}
