<?php

namespace App\Repository\Contracts;

use App\Models\Skill;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface SkillRepositoryInterface
{
    public function getAllPaginated(?string $search = null, ?int $perPage = 10): ?LengthAwarePaginator;

    public function getAll(): ?Collection;

    public function findById($id): ?Skill;

    public function create(array $data): Skill;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
