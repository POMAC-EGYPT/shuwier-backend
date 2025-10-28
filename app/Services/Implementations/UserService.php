<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getProfile(string $slug): array
    {
        $user = $this->userRepo->findBySlug($slug);

        $user->load(['freelancerProfile', 'freelancerProfile.category', 'skills', 'portfolios', 'languages', 'projects']);

        return ['status' => true, 'message' => __('message.success'), 'data' => $user];
    }
}
