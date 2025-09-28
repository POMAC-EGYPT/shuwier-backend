<?php

namespace App\Repository\Contracts;

use App\Models\Commission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CommissionRepositoryInterface
{
    public function getAllPaginated(?string $search = null, int $perPage = 10): LengthAwarePaginator;

    public function getLatest(): ?Commission;

    public function create(array $data): Commission;
}
