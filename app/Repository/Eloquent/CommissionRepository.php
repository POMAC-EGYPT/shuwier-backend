<?php

namespace App\Repository\Eloquent;

use App\Models\Commission;
use App\Repository\Contracts\CommissionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommissionRepository implements CommissionRepositoryInterface
{
    public function getAllPaginated(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return Commission::when($search, function ($query, $search) {
            $query->where('rate', 'like', "%{$search}%")
                ->orWhere('effective_from', 'like', "%{$search}%");
        })
            ->orderBy('effective_from', 'desc')->paginate($perPage);
    }

    public function getLast(): ?Commission
    {
        return Commission::latest()->first();
    }

    public function create(array $data): Commission
    {
        return Commission::create($data);
    }

    public function findById(int $id): Commission
    {
        return Commission::findOrFail($id);
    }

    public function update(int $id, array $data): bool
    {
        $commission = $this->findById($id);

        return $commission->update($data);
    }

    public function delete(int $id): bool
    {
        $commission = $this->findById($id);

        return $commission->delete();
    }
}
