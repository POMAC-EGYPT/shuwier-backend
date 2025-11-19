<?php

namespace App\Repository\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function getFreelancersWithFilter(?string $approvalStatus = null, ?string $isActive = null, ?string $name = null, int $perPage = 10): ?LengthAwarePaginator;

    public function getClientsWithFilter(?string $name = null, int $perPage = 10): ?LengthAwarePaginator;

    public function clientSearchWithRate(?string $search = null, ?array $rates = null, int $perPage = 15): mixed;

    public function freelancerSearchWithFilters(?string $search = null, ?array $categoryIds = null, ?array $skillIds = null, ?array $rates = null, int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function findByEmailAndType(string $email, string $type): ?User;

    public function findByUsername(string $username): ?User;

    public function findByProviderAndProviderId(string $provider, int $providerId): User;

    public function create(array $data): User;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function findByType(int $id, string $type): ?User;

    public function getRequestVerifications(?string $status = null, ?int $perPage = 10, ?string $search = null): ?LengthAwarePaginator;
}
