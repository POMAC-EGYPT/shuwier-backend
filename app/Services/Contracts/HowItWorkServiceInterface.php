<?php

namespace App\Services\Contracts;

interface HowItWorkServiceInterface
{
    public function getAllPaginated(?string $search = null, ?string $type = null, ?int $perPage = 15): array;

    public function getById(int $id): array;

    public function update(int $id, array $data): array;
}
