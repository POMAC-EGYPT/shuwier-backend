<?php

namespace App\Repository\Contracts;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    // public function getAllWithFilterPaginated(?int $perPage = 10): LengthAwarePaginator;
    public function getBestSellersServices(int $limit = 8): Collection;
    public function getByFreelancerIdPaginated(int $freelancerId, int $perPage = 10): LengthAwarePaginator;

    public function findById(int $id): ?Service;

    public function create(array $data): Service;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
