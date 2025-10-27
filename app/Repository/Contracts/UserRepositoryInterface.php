<?php

namespace App\Repository\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function getFreelancersWithFilter(?string $approvalStatus = null, ?string $isActive = null, ?string $name = null, int $perPage = 10): ?LengthAwarePaginator;

    public function getClientsWithFilter(?string $name = null, int $perPage = 10): ?LengthAwarePaginator;

    public function find(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function findByEmailAndType(string $email, string $type): ?User;

    public function findBySlug(string $slug): ?User;

    public function create(array $data): User;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function findByType(int $id, string $type): ?User;

    public function getRequestVerifications(?string $status = null, ?int $perPage = 10, ?string $search = null): ?LengthAwarePaginator;
}
