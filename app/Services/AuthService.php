<?php

namespace App\Services;

use App\Repositories\AuthRepositoryInterface;

class AuthService
{
    protected AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function attemptLogin(array $credentials): bool
    {
        return $this->authRepository->attemptLogin($credentials);
    }

    public function logout(): void
    {
        $this->authRepository->logout();
    }
}
