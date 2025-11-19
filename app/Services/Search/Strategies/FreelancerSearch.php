<?php

namespace App\Services\Search\Strategies;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Search\Contracts\SearchStrategyInterface;

class FreelancerSearch implements SearchStrategyInterface
{
    public function __construct(protected UserRepositoryInterface $userRepo) {}

    public function supports(string $type): bool
    {
        return $type === 'freelancer';
    }

    public function search(array $filters): mixed
    {
        return $this->userRepo->freelancerSearchWithFilters(
            $filters['search'] ?? null,
            $filters['category_ids'] ?? null,
            $filters['skill_ids'] ?? null,
            $filters['rates'] ?? null,
            $filters['per_page'] ?? 15
        );
    }
}   