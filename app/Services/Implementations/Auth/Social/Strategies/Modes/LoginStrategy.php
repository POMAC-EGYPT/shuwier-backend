<?php

namespace App\Services\Implementations\Auth\Social\Strategies\Modes;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Implementations\Auth\Social\Contract\SocialModeInterface;
use App\Services\Implementations\Auth\Social\Contract\SocialProviderInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginStrategy implements SocialModeInterface
{
    public function __construct(protected UserRepositoryInterface $userRepo) {}
    public function supports(string $mode): bool
    {
        return $mode === 'login';
    }

    public function handleCallback(SocialProviderInterface $provider): array
    {
        $socialUser = $provider->getUserData();

        $user = $this->userRepo->findByEmail($socialUser['email'] ?? null);

        if ($user)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.Account already exists. Please login.')];

        $user = $this->userRepo->findByProviderAndProviderId(
            $socialUser['provider'],
            $socialUser['providerId']
        );

        if (!$user)
            return ['status' => false, 'error_num' => 404, 'message' => __('message.not_found')];

        if (!$user->is_active)
            return ['status' => false, 'error_num' => 403, 'message' => __('message.account_is_blocked')];

        if (!$user->email_verified_at)
            return ['status' => false, 'error_num' => 403, 'message' => __('message.email_not_verified')];

        return [
            'status' => true,
            'message' => __('message.login_success'),
            'data' => [
                'user'  => $user,
                'token' => JWTAuth::fromUser($user),
            ]
        ];
    }
}
