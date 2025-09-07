<?php

namespace App\Repository\Contracts;

use App\Models\Portfolio;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PortfolioRepositoryInterface
{
    public function getPortfoliosByUserIdPaginated(int $userId, ?int $perPage = 10): LengthAwarePaginator;

    public function findById(int $id): Portfolio;
}
