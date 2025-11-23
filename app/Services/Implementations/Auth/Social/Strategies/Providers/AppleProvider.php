<?php

namespace App\Services\Implementations\Auth\Social\Strategies\Providers;

use App\Services\Implementations\Auth\Social\Contract\SocialProviderInterface;
use Laravel\Socialite\Socialite;

class AppleProvider implements SocialProviderInterface
{
    public function supports(string $provider): bool
    {
        return $provider === 'apple';
    }

    public function getUserData(): array
    {
        $socialUser = Socialite::driver('apple')->stateless()->user();

        return [
            'providerId' => $socialUser->getId(),
            'name'       => $socialUser->getName() ?? 'Apple User',
            'email'      => $socialUser->getEmail() ?? $this->generateDummyEmail($socialUser->getId()),
            'provider'   => 'apple',
        ];
    }

    private function generateDummyEmail($appleId): string
    {
        return $appleId . '@apple-user.local';
    }
}
