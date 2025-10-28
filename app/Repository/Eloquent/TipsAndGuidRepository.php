<?php

namespace App\Repository\Eloquent;

use App\Models\TipsAndGuid;
use App\Repository\Contracts\TipsAndGuidRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TipsAndGuidRepository implements TipsAndGuidRepositoryInterface
{
    public function getAllPaginated(?string $search = null, ?int $perPage = 15): LengthAwarePaginator
    {
        return TipsAndGuid::when($search, function ($query) use ($search) {
            $query->where('title_en', 'like', '%' . $search . '%')
                ->orWhere('title_ar', 'like', '%' . $search . '%')
                ->orWhere('description_en', 'like', '%' . $search . '%')
                ->orWhere('description_ar', 'like', '%' . $search . '%');
        })
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function getWithLimit(int $limit = 10): Collection
    {
        return TipsAndGuid::orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    public function find(int $id): TipsAndGuid
    {
        return TipsAndGuid::findOrFail($id);
    }

    public function create(array $data): TipsAndGuid
    {
        return TipsAndGuid::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $tipsAndGuid = $this->find($id);

        return $tipsAndGuid->update($data);
    }

    public function delete(int $id): bool
    {
        $tipsAndGuid = $this->find($id);

        return $tipsAndGuid->delete();
    }
}
