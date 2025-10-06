<?php

namespace App\Services\Contracts;

interface HomeServiceInterface
{
    public function guestHome(int $limitCategory = 8, int $limitService = 10): array;

    public function freelancerHome(?string $search = null, ?array $category_ids = null, ?array $budgets = null, int $perPage = 10): array;
}
