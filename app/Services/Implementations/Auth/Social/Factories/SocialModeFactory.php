<?php

namespace App\Services\Implementations\Auth\Social\Factories;

use App\Services\Implementations\Auth\Social\Contract\SocialModeInterface;
use InvalidArgumentException;

class SocialModeFactory
{
    /**
     * @var SocialModeInterface[]
     */
    private array $modes;

    public function __construct(SocialModeInterface ...$modes)
    {
        $this->modes = $modes;
    }

    public function getMode(string $type): SocialModeInterface
    {
        foreach ($this->modes as $mode) {
            if ($mode->supports($type)) {
                return $mode;
            }
        }

        throw new InvalidArgumentException("No social mode found for mode: {$type}");
    }
}
