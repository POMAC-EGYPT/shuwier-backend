<?php

namespace App\Services\Implementations\Auth\Social\Factories;

use App\Services\Implementations\Auth\Social\Contract\SocialProviderInterface;
use InvalidArgumentException;

class SocialProviderFactory
{
    /**
     * @var SocialProviderInterface[]
     */
    private array $providers;

    public function __construct(SocialProviderInterface ...$providers)
    {
        $this->providers = $providers;
    }

    public function getProvider(string $type): SocialProviderInterface
    {
        foreach ($this->providers as $provider) {
            if ($provider->supports($type)) {
                return $provider;
            }
        }

        throw new InvalidArgumentException("No social strategy found for type: {$type}");
    }
}
