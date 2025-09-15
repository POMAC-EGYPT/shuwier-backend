<?php

namespace App\Services\Contracts;

interface UserVerificationServiceInterface
{
    public function create(array $data): array;

    public function getAllWithFilterPaginated(?string $status = null, ?int $perPage = 15): array;

    public function acceptOrReject(int $id, string $action): array;
}
