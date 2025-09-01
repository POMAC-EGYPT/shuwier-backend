<?php

namespace App\Services\Contracts\Auth;

interface AuthAdminServiceInterface
{
    public function login(string $email, string $password): array;
}
