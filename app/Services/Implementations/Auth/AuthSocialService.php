<?php

namespace App\Services\Implementations\Auth;

use App\Services\Contracts\Auth\AuthSocialServiceInterface;

class AuthSocialService implements AuthSocialServiceInterface
{
    public function handleCallback(string $provider, string $state): array
    {
        dd($provider, $state);
        return [];
    }
}
