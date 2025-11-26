<?php

namespace App\Services\Contracts\Auth;

interface AuthAdminServiceInterface
{
    public function login(string $email, string $password): array;

    public function changePassword(string $currentPassword, string $newPassword): array;
}
