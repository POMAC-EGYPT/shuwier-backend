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

    public function getFreelancerById(int $id): array
    {
        $data = $this->userRepo->findFreelancer($id);

        return ['status' => true, 'message' => __('message.success'), 'data' => $data];
    }

    public function create(array $data): array
    {
        if ($data['password'])
            $data['password'] = Hash::make($data['password']);

        if ($data['profile_picture'])
            $data['profile_picture'] = ImageHelpers::addImage($data['profile_picture'], 'freelancers');

        if ($data['other_freelance_platform_links'])
            $data['other_freelance_platform_links'] = array_values($data['other_freelance_platform_links']);

        $user = DB::transaction(function () use ($data) {
            $user = $this->userRepo->create([
                'first_name'                       => $data['first_name'],
                'last_name'                        => $data['last_name'] ?? null,
                'email'                            => $data['email'],
                'phone'                            => $data['phone'] ?? null,
                'password'                         => $data['password'] ?? null,
                'is_active'                        => $data['is_active'],
                'about_me'                         => $data['about_me'] ?? null,
                'profile_picture'                  => $data['profile_picture'] ?? null,
                'approval_status'                  => $data['approval_status'],
                'type'                             => 'freelancer',
                'email_verified_at'                => now()
            ]);

            $this->freelancerProfileRepo->create([
                'linkedin_link'                    => $data['linkedin_link'] ?? null,
                'twitter_link'                     => $data['twitter_link'] ?? null,
                'other_freelance_platform_links'   => json_encode($data['other_freelance_platform_links'] ?? null),
                'portfolio_link'                   => $data['portfolio_link'] ?? null,
                'headline'                         => $data['headline'] ?? null,
            ]);

            $user->load('freelancerProfile');

            return $user;
        });


        return ['status' => true, 'message' => __('message.freelancer_created_successfully'), 'data' => $user];
    }

    public function delete(int $id): array
    {
        $freelancer = $this->userRepo->findFreelancer($id);

        ImageHelpers::deleteImage($freelancer->profile_picture);

        $freelancer->delete();

        return ['status' => true, 'message' => __('message.freelancer_deleted_successfully')];
    }
}
