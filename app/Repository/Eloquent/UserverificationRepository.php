<?php

namespace App\Repository\Eloquent;

use App\Models\UserVerification;
use App\Repository\Contracts\UserVerificationRepositoryInterface;
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

    public function getByUserId(int $userId): ?UserVerification
    {
        return UserVerification::where('user_id', $userId)->first();
    }

    public function create(array $userVerification): UserVerification
    {
        return UserVerification::create($userVerification);
    }

    public function update(int $id, array $data): bool
    {
        $verification = $this->getById($id);

        return $verification->update($data);
    }

    public function delete(int $id): bool
    {
        $verification = $this->getById($id);

        return $verification->delete();
    }
}
