<?php

namespace App\Services\Search\Factory;

use App\Services\Search\Contracts\SearchStrategyInterface;
use InvalidArgumentException;

class SearchStrategyFactory
{
    /**
     * @var SearchStrategyInterface[]
     */
    private array $strategies;

    public function __construct(SearchStrategyInterface ...$strategies)
    {
        $this->strategies = $strategies;
    }

    public function getStrategy(string $type): SearchStrategyInterface
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($type)) {
                return $strategy;
            }
        }

        throw new InvalidArgumentException("No search strategy found for type: {$type}");
    }
}
