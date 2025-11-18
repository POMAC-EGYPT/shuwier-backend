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
        // TODO: Implement search by rates logic and filtering based on Jira Ticket
        return User::clients()
            ->when($search, fn($query)
            => $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            }))
            ->when($rates, fn($query) => $query->whereHas('reviews', function ($q) use ($rates) {
                $q->withAvg('reviews', 'rate')
                    ->havingBetween('reviews_avg_rate', min($rates), max($rates));
            }))
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
