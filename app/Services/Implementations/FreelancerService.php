<?php

namespace App\Services\Implementations;

use App\Enum\ApprovalStatus;
use App\Helpers\ImageHelpers;
use App\Mail\FreelanceApproveMail;
use App\Repository\Contracts\FreelancerProfileRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\FreelancerServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FreelancerService implements FreelancerServiceInterface
{
    protected $userRepo;
    protected $freelancerProfileRepo;

    public function __construct(UserRepositoryInterface $userRepo, FreelancerProfileRepositoryInterface $freelancerProfileRepo)
    {
        $this->userRepo = $userRepo;
        $this->freelancerProfileRepo = $freelancerProfileRepo;
    }

    public function list(?string $approvalStatus, ?string $isActive, ?string $name, int $perPage): array
    {
        $freelancers = $this->userRepo->getFreelancersWithFilter(
            $approvalStatus,
            $isActive,
            $name,
            $perPage
        );

        return ['status' => true, 'message' => __('message.success'), 'data' => $freelancers];
    }

    public function approveOrReject(int $id, string $action): array
    {
        $freelancer = $this->userRepo->findByType($id, 'freelancers');

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

    public function getFreelancerById(int $id): array
    {
        $data = $this->userRepo->findByType($id, 'freelancers');

        return ['status' => true, 'message' => __('message.success'), 'data' => $data];
    }

    public function delete(int $id): array
    {
        $freelancer = $this->userRepo->findByType($id, 'freelancers');

        ImageHelpers::deleteImage($freelancer->profile_picture);

        $this->userRepo->delete($freelancer->id);

        return ['status' => true, 'message' => __('message.freelancer_deleted_successfully')];
    }

    public function blockAndUnblock(int $id): array
    {
        $freelancer = $this->userRepo->findByType($id, 'freelancers');

        if ($freelancer->approval_status !== ApprovalStatus::APPROVED)
            return ['status' => false, 'message' => __('message.only_approved_freelancer_can_be_blocked')];

        $this->userRepo->update($id, ['is_active' => !$freelancer->is_active]);

        $message = $freelancer->is_active
            ? __('message.freelancer_blocked_successfully')
            : __('message.freelancer_unblocked_successfully');

        return ['status' => true, 'message' => $message];
    }
}
