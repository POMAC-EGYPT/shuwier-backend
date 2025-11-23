<?php

namespace App\Services\Implementations\Auth\Social\Contract;

interface SocialProviderInterface
{
    public function supports(string $provider): bool;

    public function getUserData(): array;
}
