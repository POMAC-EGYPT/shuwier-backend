<?php

namespace App\Services\Contracts;

interface CommissionServiceInterface
{
    public function getAllPaginated(?string $search = null, int $perPage = 10): array;

    public function create(array $data): array;

    public function update(int $id, array $data): array;

    public function delete(int $id): array;
}
