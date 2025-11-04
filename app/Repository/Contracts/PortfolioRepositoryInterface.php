<?php

namespace App\Repository\Contracts;

use App\Models\Portfolio;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PortfolioRepositoryInterface
{
    public function getPortfoliosByUserIdPaginated(int $userId, ?int $perPage = 10): LengthAwarePaginator;

    public function findByUserIdAndPortfolioId(int $userId, int $portfolioId): Portfolio;

    public function findById(int $id): Portfolio;

    public function syncHashtags(Portfolio $portfolio, array $hashtags): void;

    public function create(array $data): Portfolio;

    public function update(int $userId, int $id, array $data): bool;

    public function delete(int $userId, int $id): bool;
}
