<?php

namespace App\Services\Implementations\Auth\Social\Context;

use App\Services\Implementations\Auth\Social\Factories\SocialModeFactory;
use App\Services\Implementations\Auth\Social\Factories\SocialProviderFactory;

class SocialContext
{
    private SocialProviderFactory $providerFactory;
    private SocialModeFactory $modeFactory;

    public function __construct(
        SocialProviderFactory $providerFactory,
        SocialModeFactory $modeFactory
    ) {
        $this->providerFactory = $providerFactory;
        $this->modeFactory = $modeFactory;
    }

    public function callback(string $provider, string $mode): mixed
    {
        $provider = $this->providerFactory->getProvider($provider);

        $mode = $this->modeFactory->getMode($mode);

        return $mode->handleCallback($provider);
    }
}
