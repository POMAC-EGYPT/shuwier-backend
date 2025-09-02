<?php

namespace App\Services\Contracts;

interface FreelancerServiceInterface
{
    public function list(?string $approvalStatus, ?string $isActive, ?string $name, int $perPage): array;

    public function approveOrReject(int $id, string $action): array;

    public function getFreelancerById(int $id): array;

    public function create(array $data): array;

    public function delete(int $id): array;
}
