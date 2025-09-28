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

    public function getLatest(): ?Commission
    {
        return Commission::orderBy('effective_from', 'desc')->first();
    }

    public function create(array $data): Commission
    {
        return Commission::create($data);
    }
}
