<?php

namespace App\Repositories;

use App\Models\Produk;

class ProdukRepository implements ProdukRepositoryInterface
{
    public function getAll(int $pagination): mixed
    {
        return Produk::paginate($pagination);
    }

    public function getPaginatedProducts($perPage, $search = null): mixed
    {
        $query = Produk::query();

        // Menambahkan relasi kategori
        $query->with('kategori');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('harga', 'like', '%' . $search . '%')
                ->orWhere('stok', 'like', '%' . $search . '%')
                ->orWhere('keterangan', 'like', '%' . $search . '%');
        }

        // Menggunakan paginate untuk mengambil data dengan pagination
        return $query->paginate($perPage);
    }

    public function findById(string $id): mixed
    {
        return Produk::with('kategori')->findOrFail($id);
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
