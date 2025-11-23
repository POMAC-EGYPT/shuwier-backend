<?php

namespace App\Services\Implementations\Auth\Social\Strategies\Providers;

use App\Services\Implementations\Auth\Social\Contract\SocialProviderInterface;
use Laravel\Socialite\Socialite;

class GoogleProvider implements SocialProviderInterface
{
    public function supports(string $provider): bool
    {
        return $provider === 'google';
    }

    public function getUserData(): array
    {
        $user = Socialite::driver('google')->stateless()->user();

        return [
            'providerId' => $user->getId(),
            'name'       => $user->getName(),
            'email'      => $user->getEmail(),
            'provider'   => 'google',
        ];
    }
}
