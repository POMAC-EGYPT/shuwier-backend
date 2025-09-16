<?php

namespace App\Repository\Contracts;

use App\Models\InvitationUser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface InvitationFreelancerRepositoryInterface
{
    public function getAllPaginated(?int $perPage = 10): LengthAwarePaginator;

    public function getById(int $id): ?InvitationUser;

    public function getByEmail(string $email): ?InvitationUser;

    public function create(array $data): InvitationUser;

    public function deleteByEmail(string $email): bool;

    public function delete(int $id): bool;
}
