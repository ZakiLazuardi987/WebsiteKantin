<?php

namespace App\Repositories;

use App\Models\Kategori;

class KategoriRepository implements KategoriRepositoryInterface
{
    public function getAll(int $pagination): mixed
    {
        return Kategori::paginate($pagination);
    }

    public function findById(string $id): mixed
    {
        return Kategori::findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return Kategori::create($data);
    }

    public function update(string $id, array $data): bool
    {
        $kategori = $this->findById($id);
        return $kategori->update($data);
    }

    public function delete(string $id): bool
    {
        $kategori = $this->findById($id);
        return $kategori->delete();
    }
}
