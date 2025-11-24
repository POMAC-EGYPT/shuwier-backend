<?php

namespace App\Repository\Eloquent;

use App\Enum\UserType;
use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function getFreelancersWithFilter(?string $approvalStatus = null, ?string $isActive = null, ?string $name = null, int $perPage = 10): ?LengthAwarePaginator
    {
        return User::with('freelancerProfile')
            ->freelancers()
            ->when($approvalStatus, fn($query) => $query->where('approval_status', $approvalStatus))
            ->when(!is_null($isActive), fn($query) => $query->where('is_active', $isActive))
            ->when($name, fn($query) => $query->where('name', 'like', "%{$name}%"))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getClientsWithFilter(?string $name = null, int $perPage = 10): ?LengthAwarePaginator
    {
        return User::clients()
            ->when($name, fn($query) => $query->where('name', 'like', "%{$name}%"))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function clientSearchWithRate(?string $search = null, ?array $rates = null, int $perPage = 15): LengthAwarePaginator
    {
        return User::clients()
            ->when($search, fn($query)
            => $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            }))
            ->when($rates, function ($query) use ($rates) {
                $query = $query->withAvg('reviews', 'rating');

                count($rates) === 1 ?
                    $query->having('reviews_avg_rating', '>=', $rates[0] ?? 0)
                    ->having('reviews_avg_rating', '<', ($rates[0] ?? 0) + 1)
                    : $query->havingBetween('reviews_avg_rating', [
                        min($rates),
                        max($rates)
                    ]);
            })
            ->paginate($perPage);
    }

    public function freelancerSearchWithFilters(
        ?string $search = null,
        ?array $categoryIds = null,
        ?array $skillIds = null,
        ?array $rates = null,
        int $perPage = 15
    ): LengthAwarePaginator {
        return User::with(['freelancerProfile', 'freelancerProfile.category', 'skills'])->freelancers()
            ->when($search, fn($query)
            => $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            }))
            ->when($categoryIds, fn($query)
            => $query->whereHas('freelancerProfile', fn($q)
            => $q->whereIn('category_id', $categoryIds)))

            ->when($skillIds, fn($query)
            => $query->whereHas('skills', fn($q)
            => $q->whereIn('skills.id', $skillIds)))

            ->when($rates, function ($query) use ($rates) {
                $query = $query->withAvg('reviews', 'rating');

                count($rates) === 1 ?
                    $query->having('reviews_avg_rating', '>=', $rates[0] ?? 0)
                    ->having('reviews_avg_rating', '<', ($rates[0] ?? 0) + 1)
                    : $query->havingBetween('reviews_avg_rating', [
                        min($rates),
                        max($rates)
                    ]);
            })
            ->paginate($perPage);
    }

    public function find(int $id): ?User
    {
        return User::findOrFail($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
    
    public function findByEmailAndType(string $email, string $type): ?User
    {
        return User::{$type}()->where('email', $email)->first();
    }

    public function findByUsername(string $username): ?User
    {
        return User::with(
            [
                'portfolios' => fn($query) => $query->orderByDesc('id')
            ]
        )->where('username', $username)->firstOrFail();
    }

    public function findByProviderAndProviderId(string $provider, string $providerId): ?User
    {
        return User::where('provider', $provider)
            ->where('provider_id', $providerId)
            ->first();
    }

    public function findByEmailOrProvider(?string $email, string $provider, string $providerId): ?User
    {
        return User::when($email, fn($q) => $q->where('email', $email))
            ->orWhere(
                fn($q) =>
                $q->where('provider', $provider)
                    ->where('provider_id', $providerId)
            )->first();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->find($id);

        return $user->update($data);
    }

    public function delete(int $id): bool
    {
        $user = $this->find($id);

        return $user->delete();
    }

    public function findByType(int $id, string $type): ?User
    {
        return User::{$type}()->findOrFail($id);
    }

    public function getRequestVerifications(?string $status = null, ?int $perPage = 10, ?string $search = null): ?LengthAwarePaginator
    {
        return User::whereRelation('verification', 'status', $status ?? 'pending')
            ->with(['verification' => function ($query) use ($status) {
                $query->when($status, fn($q) => $q->where('status', $status));
            }])
            ->when($search, fn($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
