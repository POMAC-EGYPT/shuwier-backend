<?php

namespace App\Repository\Contracts;

use App\Models\HowItWork;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface HowItWorkRepositoryInterface
{
    public function getAllWithFiltersPaginated(?string $search = null, ?string $type = null, ?int $perPage = 15): LengthAwarePaginator;

    public function getAll(): Collection;

    public function find($id): HowItWork;

    public function create(array $data): HowItWork;

    public function update($id, array $data): bool;

    public function delete($id): bool;
}
