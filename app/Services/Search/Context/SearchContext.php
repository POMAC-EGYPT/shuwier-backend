<?php

namespace App\Services\Search\Context;

use App\Services\Search\Factory\SearchStrategyFactory;

class SearchContext
{
    private SearchStrategyFactory $factory;

    public function __construct(SearchStrategyFactory $factory)
    {
        $this->factory = $factory;
    }

    public function search(string $type, array $filters): mixed
    {
        $strategy = $this->factory->getStrategy($type);

        return $strategy->search($filters);
    }
}
