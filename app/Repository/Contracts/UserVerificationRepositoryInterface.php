<?php

namespace App\Repository\Contracts;

use App\Models\UserVerification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserVerificationRepositoryInterface
{
    public function getAllPaginated(?int $perPage = 15): LengthAwarePaginator;

    public function getById(int $id): UserVerification;

    public function getByUserId(int $userId): ?UserVerification;

    public function create(array $data): UserVerification;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
