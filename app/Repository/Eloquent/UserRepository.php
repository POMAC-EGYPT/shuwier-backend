<?php

namespace App\Repository\Eloquent;

use App\Enum\UserType;
use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function getFreelancersWithFilter(?string $approvalStatus = null, ?string $isActive = null, int $perPage = 10): ?LengthAwarePaginator
    {
        return User::with('freelancerProfile')
            ->freelancers()
            ->when($approvalStatus, fn($query) => $query->where('approval_status', $approvalStatus))
            ->when(!is_null($isActive), fn($query) => $query->where('is_active', $isActive))
            ->paginate($perPage);
    }

    public function findOrFail(int $id): ?User
    {
        return User::findOrFail($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findByEmailAndType(string $email, string $type): ?User
    {
        return User::{$type}()->where('email', $email)->first();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->findOrFail($id);

        return $user->update($data);
    }

    public function delete(int $id): bool
    {
        $user = $this->findOrFail($id);

        return $user->delete();
    }

    public function findFreelancer(int $id): ?User
    {
        return User::freelancers()->findOrFail($id);
    }
}
