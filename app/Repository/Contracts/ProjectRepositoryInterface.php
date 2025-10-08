<?php

namespace App\Repository\Contracts;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProjectRepositoryInterface
{
    public function getWithFilterByCategoryAndBudget(
        ?string $search = null,
        ?array $category_ids = null,
        ?array $budgets = null,
        int $perPage = 10
    ): LengthAwarePaginator;

    public function getByClientIdPaginated(?string $status = null, int $clientId, int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id): Project;

    public function findByIdAndClientId(int $id, int $clientId): Project;

    public function create(array $data): Project;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
