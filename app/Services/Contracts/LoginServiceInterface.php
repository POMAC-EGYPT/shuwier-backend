<?php

namespace App\Services\Contracts;

interface LoginServiceInterface
{
    public function login(string $email, string $password, string $type): array;
}
