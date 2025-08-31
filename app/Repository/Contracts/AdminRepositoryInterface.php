<?php

namespace App\Repository\Contracts;

use App\Models\Admin;

interface AdminRepositoryInterface
{
    public function findOrFail(int $id): ?Admin;

    public function findByEmail(string $email): ?Admin;

    public function create(array $data): Admin;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
