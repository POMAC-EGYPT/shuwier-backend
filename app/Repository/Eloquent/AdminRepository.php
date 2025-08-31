<?php

namespace App\Repository\Eloquent;

use App\Models\Admin;
use App\Repository\Contracts\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public function findOrFail(int $id): ?Admin
    {
        return Admin::findOrFail($id);
    }

    public function findByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }

    public function create(array $data): Admin
    {
        return Admin::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $admin = $this->findOrFail($id);

        return $admin->update($data);
    }

    public function delete(int $id): bool
    {
        $admin = $this->findOrFail($id);

        return $admin->delete();
    }
}
