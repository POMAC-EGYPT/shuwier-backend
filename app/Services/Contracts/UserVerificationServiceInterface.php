<?php

namespace App\Services\Contracts;

interface UserVerificationServiceInterface
{
    public function create(array $data): array;

    public function getAllWithFilterPaginated(?string $status = null, ?int $perPage = 15, ?string $search = null): array;

    public function acceptOrReject(int $id, string $action): array;
}
