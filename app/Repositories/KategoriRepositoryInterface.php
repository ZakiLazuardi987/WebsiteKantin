<?php

namespace App\Repositories;

interface KategoriRepositoryInterface
{
    public function getAll(int $pagination): mixed;
    public function findById(string $id): mixed;
    public function create(array $data): mixed;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}
