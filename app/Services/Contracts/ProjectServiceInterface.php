<?php

namespace App\Services\Contracts;

interface ProjectServiceInterface
{
    public function getByClientId(string $status, int $clientId, int $perPage = 15): array;

    public function findByIdAndClientId(int $id, int $clientId): array;

    public function findByIdToFreelancer(int $freelancerId, int $id): array;

    public function create(array $data): array;

    public function endProject(int $id, $clientId): array;
}
