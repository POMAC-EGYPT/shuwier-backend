<?php

namespace App\Services\Contracts;

interface TipsAndGuidServiceInterface
{
    public function getAllPaginated(?string $search = null, ?int $perPage = 15);

    public function getById(int $id): array;

    public function create(array $data): array;

    public function update(int $id, array $data): array;

    public function delete(int $id): array;
}
