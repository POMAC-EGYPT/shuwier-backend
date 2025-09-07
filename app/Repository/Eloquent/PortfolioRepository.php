<?php

namespace App\Repository\Eloquent;

use App\Models\Portfolio;
use App\Repository\Contracts\PortfolioRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PortfolioRepository implements PortfolioRepositoryInterface
{
    public function getPortfoliosByUserIdPaginated(int $userId, ?int $perPage = 10): LengthAwarePaginator
    {
        return Portfolio::where('user_id', $userId)
            ->with(['category', 'subcategory', 'hashtags', 'attachments'])
            ->paginate($perPage);
    }

    public function findById(int $id): Portfolio
    {
        return Portfolio::findOrFail($id);
    }
}
