<?php

namespace App\Repository\Contracts;

use App\Models\Proposal;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProposalRepositoryInterface
{
    public function getAllByFreelancerIdPaginated(int $freelancerId, ?array $status = null, ?string $search = null, int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id): Proposal;

    public function getByIdAndFreelancerId(int $id, int $freelancerId): Proposal;

    public function findByFreelancerIdAndProjectId(int $freelancerId, int $projectId): ?Proposal;

    public function getAllByProjectIdPaginated(int $projectId, ?int $perPage = 15): LengthAwarePaginator;

    public function create(array $data): Proposal;

    public function update(int $id, array $data): bool;
}
