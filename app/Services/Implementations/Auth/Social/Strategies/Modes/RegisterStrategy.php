<?php

namespace App\Services\Implementations\Auth\Social\Strategies\Modes;

use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Implementations\Auth\Social\Contract\SocialModeInterface;
use App\Services\Implementations\Auth\Social\Contract\SocialProviderInterface;
use Illuminate\Support\Facades\Cache;
use Str;

class RegisterStrategy implements SocialModeInterface
{
    public function __construct(protected UserRepositoryInterface $userRepo) {}
    public function supports(string $mode): bool
    {
        return $mode === 'register';
    }

    public function handleCallback(SocialProviderInterface $provider): array
    {
        $socialUser = $provider->getUserData();

        $user = $this->userRepo->findByEmailOrProvider(
            $socialUser['email'] ?? null,
            $socialUser['provider'],
            $socialUser['providerId']
        );

        if ($user)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.Account already exists. Please login.')];

        $tempKey = 'social_register_' . Str::uuid();

        Cache::put($tempKey, $socialUser, now()->addMinutes(15));

        return [
            'status'  => true,
            'message' => __('message.success'),
            'data'    => [
                'temp_key' => $tempKey
            ]
        ];
    }
}
