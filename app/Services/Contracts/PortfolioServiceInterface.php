<?php

namespace App\Services\Contracts;

interface PortfolioServiceInterface
{
    public function listPortfoliosByUserId(int $userId, ?int $perPage = 10): array;

    public function getPortfolioById(int $id): array;
}
