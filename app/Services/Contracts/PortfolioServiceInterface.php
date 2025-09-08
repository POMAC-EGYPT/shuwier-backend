<?php

namespace App\Services\Contracts;

interface PortfolioServiceInterface
{
    public function listPortfoliosByUserId(int $userId, ?int $perPage = 10): array;

    public function getPortfolioById(int $id): array;

    public function create(array $data): array;

    public function update(int $id, array $data): array;
}
