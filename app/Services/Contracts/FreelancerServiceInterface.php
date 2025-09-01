<?php

namespace App\Services\Contracts;

interface FreelancerServiceInterface
{
    public function list(?string $approvalStatus, ?string $isActive, int $perPage): array;

    public function approveOrReject(int $id, string $action): array;
}
