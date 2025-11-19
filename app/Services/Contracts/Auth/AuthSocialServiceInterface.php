<?php

namespace App\Services\Contracts\Auth;

interface AuthSocialServiceInterface
{
    public function handleCallback(string $provider, string $state): array;
}