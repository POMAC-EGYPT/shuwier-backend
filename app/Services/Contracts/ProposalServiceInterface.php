<?php

namespace App\Services\Contracts;

interface ProposalServiceInterface
{
    public function getAllByFreelancerIdPaginated(int $freelancerId, ?array $status = null, ?string $search = null, int $perPage = 15): array;

    public function getByIdAndFreelancerId(int $id, int $freelancerId): array;

    public function getByProjectIdPaginated(int $projectId, int $clientId, ?int $perPage = 15): array;

    public function getByIdToClient(int $id, int $clientId): array;

    public function create(array $data): array;
}
