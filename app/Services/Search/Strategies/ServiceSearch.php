<?php

namespace App\Services\Search\Strategies;

use App\Enum\SearchType;
use App\Repository\Contracts\ServiceRepositoryInterface;
use App\Services\Search\Contracts\SearchStrategyInterface;

class ServiceSearch implements SearchStrategyInterface
{
    protected ServiceRepositoryInterface $serviceRepo;

    public function __construct(ServiceRepositoryInterface $serviceRepo)
    {
        $this->serviceRepo = $serviceRepo;
    }

    public function supports(string $type): bool
    {
        return $type === SearchType::SERVICE->value;
    }

    public function search(array $filters): mixed
    {
        return $this->serviceRepo->searchWithFilters(
            $filters['search'] ?? '',
            $filters['category_id'] ?? null,
            $filters['subcategory_id'] ?? null,
            $filters['hashtag_ids'] ?? null,
            $filters['priceMin'] ?? null,
            $filters['priceMax'] ?? null,
            $filters['perPage'] ?? 16
        );
    }
}
