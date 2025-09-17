<?php

namespace App\Repository\Contracts;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getAllPaginated(bool $withChildren = false, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator;

    public function getParentsPaginated(bool $withChildren = false, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator;

    public function getChildrensPaginated(?int $parent_id = null, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator;

    public function getParents(): ?Collection;

    public function find(int $id, bool $withChildren = false): ?Category;

    public function create(array $data): Category;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
