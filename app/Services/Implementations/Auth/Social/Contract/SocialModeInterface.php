<?php

namespace App\Services\Implementations\Auth\Social\Contract;

interface SocialModeInterface
{
    public function supports(string $mode): bool;

    public function handleCallback(SocialProviderInterface $provider): array;
}