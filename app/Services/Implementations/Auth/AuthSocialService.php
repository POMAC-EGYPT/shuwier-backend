<?php

namespace App\Services\Implementations\Auth;

use App\Enum\ApprovalStatus;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\Auth\AuthSocialServiceInterface;
use Laravel\Socialite\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthSocialService implements AuthSocialServiceInterface
{

    public function __construct(protected UserRepositoryInterface $userRepo) {}
    public function handleCallback(string $provider, string $state): array
    {
        $socialUser = Socialite::driver($provider)->user();

        $providerId = $socialUser->getId();

        $email = $socialUser->getEmail();

        $name = $socialUser->getName();

        if ($state == 'register') {
            $user = $this->userRepo->create([
                'name' => $name,
                'email' => $email,
                'type' => 'client',
                'provider' => 'google',
                'provider_id' => $providerId,
                'email_verified_at' => now(),
                'is_active' => 1,
                'password' => bcrypt(bin2hex(random_bytes(8))),
                'approval_status' => ApprovalStatus::APPROVED,
            ]);
            $user->load('freelancerProfile');

            return [
                'status'  => true,
                'message' => __('message.user_registered'),
                'data'    => [
                    'user'  => $user,
                    'token' => JWTAuth::fromUser($user),
                ]
            ];
        } else {
            $user = $this->userRepo->findByProviderAndProviderId($provider, $providerId);

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
}
