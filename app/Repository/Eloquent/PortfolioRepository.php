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

    public function syncHashtags(Portfolio $portfolio, array $hashtags): void
    {
        $portfolio->hashtags()->sync($hashtags);
    }

    public function create(array $data): Portfolio
    {
        $portfolio = Portfolio::create($data);

        $portfolio->hashtags()->sync($data['hashtags'] ?? []);

        return $portfolio;
    }

    public function update(int $id, array $data): bool
    {
        $portfolio = $this->findById($id);

        return $portfolio->update($data);
    }
    public function delete(int $id): bool
    {
        $portfolio = $this->findById($id);

        $portfolio->hashtags()->detach();
        
        return $portfolio->delete();
    }
}
