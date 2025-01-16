<?php

namespace App\Repositories;

use App\Models\Produk;

class ProdukRepository implements ProdukRepositoryInterface
{
    public function getAll(int $pagination): mixed
    {
        return Produk::paginate($pagination);
    }

    public function findById(string $id): mixed
    {
        return Produk::findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return Produk::create($data);
    }

    public function update(string $id, array $data): bool
    {
        $produk = $this->findById($id);
        return $produk->update($data);
    }

    public function delete(string $id): bool
    {
        $produk = $this->findById($id);
        if ($produk->gambar) {
            unlink($produk->gambar);
        }
        return $produk->delete();
    }
}
