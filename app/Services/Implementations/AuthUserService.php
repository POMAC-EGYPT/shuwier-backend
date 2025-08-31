<?php

namespace App\Services\Implementations;

use App\Enum\UserType;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\AuthUserServiceInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthUserService implements AuthUserServiceInterface
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(array $data): array
    {
        return [];
    }

    public function login(string $email, string $password, string $type): array
    {
        $user = $this->userRepo->findByEmailAndType($email, $type . 's');

        if (!$user)
            return ['success' => false, 'error_num' => 400, 'message' => __('message.user_not_found')];

        if (!Hash::check($password, $user->password))
            return ['success' => false, 'error_num' => 400, 'message' => __('message.invalid_password')];

        if (!$user->is_active)
            return ['success' => false, 'error_num' => 403, 'message' => __('message.account_is_blocked')];

        if (!$user->email_verified_at)
            return ['success' => false, 'error_num' => 403, 'message' => __('message.email_not_verified')];

        $token = JWTAuth::fromUser($user);

        if ($user->type == UserType::FREELANCER)
            $user->load(['freelancerProfile']);

        return ['success' => true, 'message' => __('message.login_success'), 'data' => [
            'user' => $user,
            'token' => $token,
        ]];
    }

    public function logout(): void
    {
        // Implementation for user logout
    }

    public function refreshToken(): array
    {
        return [];
    }
}
