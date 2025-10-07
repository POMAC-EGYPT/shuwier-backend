<?php

namespace App\Services\Contracts;

interface CommissionServiceInterface
{
    public function getAllPaginated(?string $search = null, int $perPage = 10): array;

    public function getLast(): array;

    public function create(array $data): array;
}
