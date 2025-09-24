<?php

namespace App\Repository\Eloquent;

use App\Models\Service;
use App\Repository\Contracts\ServiceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function getByFreelancerIdPaginated(int $freelancerId, int $perPage = 10): LengthAwarePaginator
    {
        return Service::where('user_id', $freelancerId)
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function findById(int $id): ?Service
    {
        return Service::findOrFail($id);
    }

    public function create(array $data): Service
    {
        return Service::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $service = $this->findById($id);

        return $service->update($data);
    }

    public function delete(int $id): bool
    {
        $service = $this->findById($id);

        return $service->delete();
    }
}
