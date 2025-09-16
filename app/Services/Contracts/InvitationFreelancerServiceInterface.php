<?php

namespace App\Services\Contracts;

interface InvitationFreelancerServiceInterface
{
    public function getAllPaginated(?int $perPage = 10): array;

    public function sendInvitation(string $email): array;
}
