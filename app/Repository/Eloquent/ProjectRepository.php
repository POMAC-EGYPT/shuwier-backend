<?php

namespace App\Repository\Eloquent;

use App\Models\Project;
use App\Repository\Contracts\ProjectRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getWithFilterByCategoryAndBudget(
        ?string $search = null,
        ?array $category_ids = null,
        ?array $budgets = null,
        int $perPage = 15
    ): LengthAwarePaginator {
        return Project::with('category')
            ->when($search, fn($query) => $query->where('title', 'like', "%$search%"))
            ->when($category_ids, fn($query) => $query->whereIn('category_id', $category_ids))
            ->when($budgets, fn($query) => $query->whereIn('budget', $budgets))
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }
    public function getByClientIdPaginated(?string $status = null, int $clientId, int $perPage = 15): LengthAwarePaginator
    {
        return Project::with('category', 'subcategory')
            ->where('user_id', $clientId)
            ->when($status, fn($query) => $query->where('status', $status))
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }
    public function findById(int $id): Project
    {
        return Project::findOrFail($id);
    }

    public function create(array $data): Project
    {
        return Project::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $project = Project::findOrFail($id);

        return $project->update($data);
    }

    public function delete(int $id): bool
    {
        $project = Project::findOrFail($id);

        return $project->delete();
    }
}
