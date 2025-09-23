<?php

namespace App\Repository\Contracts;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ServiceRepositoryInterface
{
    public function getByFreelancerIdPaginated(int $freelancerId, int $perPage = 10): LengthAwarePaginator;

    public function findById(int $id): ?Service;

    public function create(array $data): Service;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
