<?php

namespace App\Services\Upload\Factory;

use App\Services\Upload\Contracts\UploadStrategyInterface;
use InvalidArgumentException;


class UploadStrategyFactory
{
    /**
     * @var UploadStrategyInterface[]
     */
    private array $strategies;

    public function __construct(UploadStrategyInterface ...$strategies)
    {
        $this->strategies = $strategies;
    }

    public function getStrategy(string $type): UploadStrategyInterface
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($type)) {
                return $strategy;
            }
        }

        throw new InvalidArgumentException("No upload strategy found for type: {$type}");
    }
}
