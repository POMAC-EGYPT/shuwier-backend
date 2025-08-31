<?php

namespace App\Repository\Contracts;

use App\Models\FreelancerProfile;

interface FreelancerProfileRepositoryInterface
{
    public function findOrFail(int $id): ?FreelancerProfile;

    public function findByEmail(string $email): ?FreelancerProfile;

    public function create(array $data): FreelancerProfile;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
