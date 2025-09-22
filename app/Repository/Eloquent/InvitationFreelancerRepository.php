<?php

namespace App\Repository\Eloquent;

use App\Models\InvitationUser;
use App\Repository\Contracts\InvitationFreelancerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvitationFreelancerRepository implements InvitationFreelancerRepositoryInterface
{
    public function getAllPaginated(?int $perPage = 10): LengthAwarePaginator
    {
        return InvitationUser::orderByDesc('created_at')->paginate($perPage);
    }

    public function getById(int $id): InvitationUser
    {
        return InvitationUser::findOrFail($id);
    }

    public function getByEmail(string $email): ?InvitationUser
    {
        return InvitationUser::where("email", $email)->first();
    }

    public function create(array $data): InvitationUser
    {
        return InvitationUser::create($data);
    }

    public function deleteByEmail(string $email): bool
    {
        $invitation = $this->getByEmail($email);

        if ($invitation)
            return $invitation->delete();

        return false;
    }

    public function delete(int $id): bool
    {
        $invitation = $this->getById($id);

        return $invitation->delete();
    }
}
