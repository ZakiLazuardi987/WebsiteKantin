<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): iterable
    {
        return $this->userRepository->getAll();
    }

    public function getUserById(int $id): ?\App\Models\User
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data): \App\Models\User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function updateUser(int $id, array $data): bool
    {
        $user = $this->userRepository->findById($id);
        if ($user) {
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                $data['password'] = $user->password;
            }
            return $this->userRepository->update($user, $data);
        }
        return false;
    }

    public function deleteUser(int $id): bool
    {
        $user = $this->userRepository->findById($id);
        if ($user) {
            return $this->userRepository->delete($user);
        }
        return false;
    }
}
