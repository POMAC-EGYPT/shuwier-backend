<?php

namespace App\Repository\Eloquent;

use App\Models\Service;
use App\Repository\Contracts\ServiceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function searchWithFilters(
        string $search,
        ?int $categoryId = null,
        ?int $subcategoryId = null,
        ?string $hashtag = null,
        ?int $priceMin = null,
        ?int $priceMax = null,
        ?int $perPage = 10
    ): LengthAwarePaginator {

        return Service::with(['category', 'subcategory', 'user'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->whereFullText(['title', 'description'], $search)
                        ->orWhere('title', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                });
            })
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->when($subcategoryId, fn($q) => $q->where('subcategory_id', $subcategoryId))
            ->when($hashtag, fn($q) => $q->whereRelation('hashtags', 'name', 'LIKE', "%" . strtolower($hashtag) . "%"))
            ->when($priceMin, fn($q) => $q->where('price', '>=', $priceMin))
            ->when($priceMax, fn($q) => $q->where('price', '<=', $priceMax))
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function getBestSellersServices(int $limit = 8): Collection
    {
        //TODO: apply filter logic of best sellers

        return Service::with(['category', 'subcategory', 'user'])
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    public function getByFreelancerIdPaginated(int $freelancerId, int $perPage = 10): LengthAwarePaginator
    {
        return Service::where('user_id', $freelancerId)
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function findByIdAndFreelancerId(int $id, int $freelancerId): ?Service
    {
        return Service::where('user_id', $freelancerId)->findOrFail($id);
    }

    public function findById(int $id): Service
    {
        return Service::findOrFail($id);
    }

    public function create(array $data): Service
    {
        return Service::create($data);
    }

    public function update(int $id, int $freelancerId, array $data): bool
    {
        $service = $this->findByIdAndFreelancerId($id, $freelancerId);

        return $service->update($data);
    }

    public function delete(int $id, int $freelancerId): bool
    {
        $service = $this->findByIdAndFreelancerId($id, $freelancerId);

        return $service->delete();
    }
}
