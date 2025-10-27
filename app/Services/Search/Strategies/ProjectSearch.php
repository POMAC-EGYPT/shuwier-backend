<?php

namespace App\Services\Search\Strategies;

use App\Enum\SearchType;
use App\Repository\Contracts\ProjectRepositoryInterface;
use App\Services\Search\Contracts\SearchStrategyInterface;

class ProjectSearch implements SearchStrategyInterface
{
    protected ProjectRepositoryInterface $projectRepo;

    public function __construct(ProjectRepositoryInterface $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }

    public function supports(string $type): bool
    {
        return $type === SearchType::PROJECT->value;
    }

    public function search(array $filters): mixed
    {
        return $this->projectRepo->searchWithFilters(
            $filters['search'] ?? '',
            $filters['category_ids'] ?? null,
            $filters['budgets'] ?? null,
            $filters['per_page'] ?? 15
        );
    }
}
