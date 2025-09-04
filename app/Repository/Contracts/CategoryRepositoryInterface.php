<?php

namespace App\Repository\Contracts;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function getAllPaginated(bool $withChildren = false, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator;

    public function getParentsPaginated(bool $withChildren = false, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator;

    public function getChildrensPaginated(?string $parent_id = null, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator;

    public function find(int $id, bool $withChildren = false): ?Category;

    public function create(array $data): Category;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
