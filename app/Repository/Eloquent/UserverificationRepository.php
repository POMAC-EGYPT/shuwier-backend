<?php

namespace App\Services\Implementations;

use App\Models\UserVerification;
use App\Services\Contracts\UserVerificationRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserVerificationRepository implements UserVerificationRepositoryInterface
{
    public function getAllPaginated(?int $perPage = 15): LengthAwarePaginator
    {
        return UserVerification::paginate($perPage);
    }

    public function getById(int $id): UserVerification
    {
        return UserVerification::findOrFail($id);
    }

    public function create(array $userVerification): UserVerification
    {
        return UserVerification::create($userVerification);
    }
}
