<?php

namespace App\Services\Contracts;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryServiceInterface
{
    public function getAllPaginated(?string $type = null, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator;

    public function getById(int $id): null | Category;

    public function create(array $data): array;

    public function createAllWithChildrens(array $data): array;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
