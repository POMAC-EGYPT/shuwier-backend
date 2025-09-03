<?php

namespace App\Repository\Eloquent;

use App\Enum\UserType;
use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function getFreelancersWithFilter(?string $approvalStatus = null, ?string $isActive = null, ?string $name = null, int $perPage = 10): ?LengthAwarePaginator
    {
        return User::with('freelancerProfile')
            ->freelancers()
            ->when($approvalStatus, fn($query) => $query->where('approval_status', $approvalStatus))
            ->when(!is_null($isActive), fn($query) => $query->where('is_active', $isActive))
            ->when($name, fn($query) => $query->where('name', 'like', "%{$name}%"))
            ->paginate($perPage);
    }

    public function getClientsWithFilter(?string $name = null, int $perPage = 10): ?LengthAwarePaginator
    {
        return User::clients()
            ->when($name, fn($query) => $query->where('name', 'like', "%{$name}%"))
            ->paginate($perPage);
    }

    public function find(int $id): ?User
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
        $user = $this->find($id);

        return $user->update($data);
    }

    public function delete(int $id): bool
    {
        $user = $this->find($id);

        return $user->delete();
    }

    public function findByType(int $id, string $type): ?User
    {
        return User::{$type}()->findOrFail($id);
    }
}
