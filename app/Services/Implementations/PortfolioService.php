<?php

namespace App\Services\Implementations;

use App\Services\Contracts\PortfolioServiceInterface;

class PortfolioService implements PortfolioServiceInterface
{
    public function listPortfoliosByUserId(int $userId, ?int $perPage = 10): array
    {
        return $this->listPortfoliosByUserId($userId, $perPage);
    }

    public function getPortfolioById(int $id): array
    {
        return $this->getPortfolioById($id);
    }
}
