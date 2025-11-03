<?php

namespace App\Services\Contracts\Auth;

interface AuthUserServiceInterface
{
    public function register(array $data): array;

    public function resendCode(string $email): array;

    public function verifyEmail(string $email, string $otp): array;

    public function resetEmail(string $oldEmail, string $newEmail): array;

    public function login(string $email, string $password): array;

    public function forgetPassword(string $email): array;

    public function resetPassword(string $email, string $password, string $token): array;

    public function updateProfile(array $data): array;

    public function changePassword(string $currentPassword, string $newPassword): array;

    public function changeEmail(string $email, string $password): array;

    public function verifyChangeEmail(string $email, string $otp): array;

    public function refreshToken(): array;
}
