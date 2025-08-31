<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
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
}
