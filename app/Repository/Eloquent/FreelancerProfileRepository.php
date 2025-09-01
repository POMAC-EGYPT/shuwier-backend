<?php

namespace App\Repository\Eloquent;

use App\Models\FreelancerProfile;
use App\Repository\Contracts\FreelancerProfileRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FreelancerProfileRepository implements FreelancerProfileRepositoryInterface
{
    public function getAll(?string $approvalStatus = null, ?string $isActive = null, int $perPage = 10): ?LengthAwarePaginator
    {
        return FreelancerProfile::query()
            ->when($approvalStatus, fn($query) => $query->where('approval_status', $approvalStatus))
            ->when(!is_null($isActive), fn($query) => $query->where('is_active', $isActive))
            ->paginate($perPage);
    }

    public function findOrFail(int $id): ?FreelancerProfile
    {
        return FreelancerProfile::findOrFail($id);
    }

    public function findByEmail(string $email): ?FreelancerProfile
    {
        return FreelancerProfile::where('email', $email)->first();
    }

    public function create(array $data): FreelancerProfile
    {
        return FreelancerProfile::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $profile = $this->findOrFail($id);

        return $profile->update($data);
    }

    public function delete(int $id): bool
    {
        $profile = $this->findOrFail($id);

        return $profile->delete();
    }
}
