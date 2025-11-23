<?php

namespace App\Services\Contracts\Auth;

interface SocialAuthSerivceInterface
{
    public function finalizeRegistration(string $tempKey, string $username): array;
}