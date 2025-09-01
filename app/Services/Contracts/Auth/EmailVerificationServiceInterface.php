<?php

namespace App\Services\Contracts\Auth;

interface EmailVerificationServiceInterface
{
    public function sendVerificationCode(array $data): array;

    public function resendVerificationCode(string $email): array;

    public function verifyCode(string $email, string $otp): array;

    public function resetEmail(string $oldEmail, string $newEmail): array;
}
