<?php

namespace App\Services\Implementations;

use App\Mail\InvitationFreelancerMail;
use App\Repository\Contracts\InvitationFreelancerRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\InvitationFreelancerServiceInterface;
use Illuminate\Support\Facades\Mail;

class InvitationFreelancerService implements InvitationFreelancerServiceInterface
{
    protected $invitationRepo;
    protected $userRepo;

    public function __construct(InvitationFreelancerRepositoryInterface $invitationRepo, UserRepositoryInterface $userRepo)
    {
        $this->invitationRepo = $invitationRepo;
        $this->userRepo = $userRepo;
    }

    public function getAllPaginated(?int $perPage = 10): array
    {
        $invitations = $this->invitationRepo->getAllPaginated($perPage);

        return ['status' => 'success', 'message' => __('message.success'), 'data' => $invitations];
    }

    public function sendInvitation(string $email): array
    {
        $user = $this->userRepo->findByEmail($email);

        if ($user)
            return ['status' => false, 'message' => __('message.user_already_registered')];

        $this->invitationRepo->create([
            'email'      => $email,
            'expired_at' => now()->addDays(7),
        ]);

        Mail::to($email)->send(new InvitationFreelancerMail($email));

        return ['status' => true, 'message' => __('message.invitation_sent_successfully')];
    }
}
