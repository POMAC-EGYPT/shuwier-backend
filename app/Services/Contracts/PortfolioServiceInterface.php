<?php

namespace App\Services\Contracts;

interface PortfolioServiceInterface
{
    public function listPortfoliosByUserId(int $userId, ?int $perPage = 10): array;

    public function getPortfolioByUserIdAndPortfolioId(int $userId, int $portfolioId): array;

    public function getById(int $id): array;

    public function create(array $data): array;

    public function update(int $userId, int $id, array $data): array;

    public function delete(int $userId, int $id): array;
}
