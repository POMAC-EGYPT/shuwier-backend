<?php

namespace App\Services\Contracts;

interface ServiceServiceInterface
{
    public function getByFreelancerIdPaginated(int $freelancerId, int $perPage = 10): array;

    public function getById(int $id): array;

    public function create(array $data): array;

    public function update(int $id, array $data): array;

    public function delete(int $id): array;
}
