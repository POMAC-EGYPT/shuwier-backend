<?php

namespace App\Repository\Eloquent;

use App\Models\Proposal;
use App\Repository\Contracts\ProposalRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProposalRepository implements ProposalRepositoryInterface
{
    public function getAllByFreelancerIdPaginated(int $freelancerId, ?array $status = null, ?string $search = null, int $perPage = 15): LengthAwarePaginator
    {
        return Proposal::where('user_id', $freelancerId)
            ->when($status, fn($query) => $query->whereIn('status', $status))
            ->when($search, fn($query) => $query->whereRelation('project', fn($q) => $q->where('title', 'like', "%$search%")))
            ->with('project')
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function findById(int $id): Proposal
    {
        return Proposal::findOrFail($id);
    }

    public function getByIdAndFreelancerId(int $id, int $freelancerId): Proposal
    {
        return Proposal::with('project', 'attachments', 'user')
            ->where('user_id', $freelancerId)
            ->findOrFail($id);
    }

    public function findByFreelancerIdAndProjectId(int $freelancerId, int $projectId): ?Proposal
    {
        return Proposal::where('user_id', $freelancerId)
            ->where('project_id', $projectId)
            ->first();
    }

    public function getAllByProjectIdPaginated(int $projectId, ?int $perPage = 15): LengthAwarePaginator
    {
        return Proposal::with('user', 'attachments', 'project')
            ->where('project_id', $projectId)
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function create(array $data): Proposal
    {
        return Proposal::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $proposal = Proposal::findOrFail($id);

        return $proposal->update($data);
    }
}
