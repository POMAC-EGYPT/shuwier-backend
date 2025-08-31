<?php

namespace App\Repository\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findOrFail(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function findByEmailAndType(string $email, string $type): ?User;

    public function create(array $data): User;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
