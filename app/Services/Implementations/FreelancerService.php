<?php

namespace App\Services\Implementations;

use App\Enum\ApprovalStatus;
use App\Mail\FreelanceApproveMail;
use App\Repository\Contracts\FreelancerProfileRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\FreelancerServiceInterface;
use Illuminate\Support\Facades\Mail;

class FreelancerService implements FreelancerServiceInterface
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function list(?string $approvalStatus, ?string $isActive, int $perPage): array
    {
        $freelancers = $this->userRepo->getFreelancersWithFilter($approvalStatus, $isActive, $perPage);

        return ['status' => true, 'message' => __('message.success'), 'data' => $freelancers];
    }

    public function approveOrReject(int $id, string $action): array
    {
        $freelancer = $this->userRepo->findFreelancer($id);

        if ($freelancer->approval_status === ApprovalStatus::APPROVED)
            return ['status' => false, 'message' => __('message.freelancer_already_approved')];

        if ($action == 'reject') {
            $freelancer->delete();
            return ['status' => true, 'message' => __('message.freelancer_rejected_success')];
        } elseif ($action === 'approve') {
            $this->userRepo->update(
                $freelancer->id,
                [
                    'approval_status' => ApprovalStatus::APPROVED
                ]
            );
            $freelancer->load('freelancerProfile');

            Mail::to($freelancer->email)->queue(new FreelanceApproveMail($freelancer));
            return [
                'status' => true,
                'message' => __('message.freelancer_approved_success'),
                'data' => $freelancer
            ];
        }
        return ['status' => false, 'message' => __('message.invalid_action')];
    }
}
