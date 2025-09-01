<?php

namespace App\Repository\Contracts;

use App\Models\FreelancerProfile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FreelancerProfileRepositoryInterface
{
    public function getAll(?string $approvalStatus = null, ?string $isActive = null, int $perPage = 10): ?LengthAwarePaginator;

    public function findOrFail(int $id): ?FreelancerProfile;

    public function findByEmail(string $email): ?FreelancerProfile;

    public function create(array $data): FreelancerProfile;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
