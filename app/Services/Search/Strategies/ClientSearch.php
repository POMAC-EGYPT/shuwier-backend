<?php

namespace App\Services\Search\Strategies;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Search\Contracts\SearchStrategyInterface;


class ClientSearch implements SearchStrategyInterface
{
    public function __construct(protected UserRepositoryInterface $userRepo) {}
    public function supports(string $type): bool
    {
        return $type === 'client';
    }

    public function search(array $filters): mixed
    {
        return $this->userRepo->clientSearchWithRate(
            $filters['search'] ?? null,
            $filters['rates'] ?? null,
            $filters['per_page'] ?? 15
        );
    }
}
