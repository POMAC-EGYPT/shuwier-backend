<?php

namespace App\Repository\Eloquent;

use App\Models\HowItWork;
use App\Repository\Contracts\HowItWorkRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class HowItWorkRepository implements HowItWorkRepositoryInterface
{
    public function getAllWithFiltersPaginated(?string $search = null, ?string $type = null, ?int $perPage = 15): LengthAwarePaginator
    {
        return HowItWork::when($search, function ($query) use ($search) {
            $query->where('title_en', 'like', '%' . $search . '%')
                ->orWhere('title_ar', 'like', '%' . $search . '%')
                ->orWhere('description_en', 'like', '%' . $search . '%')
                ->orWhere('description_ar', 'like', '%' . $search . '%');
        })
            ->when($type, fn($query) => $query->where('type', $type))
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function getWithLimit(int $limit = 10): Collection
    {
        return HowItWork::orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    public function find($id): HowItWork
    {
        return HowItWork::findOrFail($id);
    }

    public function create(array $data): HowItWork
    {
        return HowItWork::create($data);
    }

    public function update($id, array $data): bool
    {
        $howItWork = $this->find($id);

        return $howItWork->update($data);
    }

    public function delete($id): bool
    {
        $howItWork = $this->find($id);

        return $howItWork->delete();
    }
}
