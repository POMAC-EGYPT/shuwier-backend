<?php

namespace App\Services\Contracts;

interface ServiceServiceInterface
{
    public function getByFreelancerIdPaginated(int $freelancerId, int $perPage = 10): array;

    public function findByIdAndFreelancerId(int $id, int $freelancerId): array;

    public function create(array $data): array;

    public function update(int $id, int $freelancerId, array $data): array;

    public function delete(int $id, int $freelancerId): array;
}
