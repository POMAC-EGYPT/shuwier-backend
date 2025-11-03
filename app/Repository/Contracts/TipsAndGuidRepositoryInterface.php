<?php

namespace App\Repository\Contracts;

use App\Models\TipsAndGuid;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TipsAndGuidRepositoryInterface
{
    public function getAllPaginated(?string $search = null, ?int $perPage = 15): LengthAwarePaginator;

    public function getWithLimit(int $limit = 10): Collection;

    public function find(int $id): TipsAndGuid;

    public function create(array $data): TipsAndGuid;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
