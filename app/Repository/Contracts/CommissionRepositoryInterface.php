<?php

namespace App\Repository\Contracts;

use App\Models\Commission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CommissionRepositoryInterface
{
    public function getAllPaginated(?string $search = null, int $perPage = 10): LengthAwarePaginator;

    public function getLast(): ?Commission;

    public function create(array $data): Commission;

    public function findById(int $id): Commission;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
