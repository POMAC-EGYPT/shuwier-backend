<?php

namespace App\Services\Contracts\Auth;

interface AuthAdminServiceInterface
{
    public function login(string $email, string $password, bool $remember): array;

    public function changePassword(string $currentPassword, string $newPassword): array;
}
