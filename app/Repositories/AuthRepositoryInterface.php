<?php

namespace App\Repositories;

interface AuthRepositoryInterface
{
    public function attemptLogin(array $credentials): bool;
    public function logout(): void;
}
