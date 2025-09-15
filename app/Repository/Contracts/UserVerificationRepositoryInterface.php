<?php

namespace App\Services\Contracts;

use App\Models\UserVerification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserVerificationRepositoryInterface
{
    public function getAllPaginated(?int $perPage = 15): LengthAwarePaginator;
    public function getById(int $id): UserVerification;

    public function create(array $data): UserVerification;
}
