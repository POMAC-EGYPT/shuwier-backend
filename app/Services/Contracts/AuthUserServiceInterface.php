<?php

namespace App\Services\Contracts;

interface AuthUserServiceInterface
{
    public function register(array $data): array;

    public function login(string $email, string $password, string $type): array;
    public function logout(): void;

    public function refreshToken(): array;
}
