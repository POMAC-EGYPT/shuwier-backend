<?php

namespace App\Services\Implementations\Auth;

use App\Enum\ApprovalStatus;
use App\Helpers\ImageHelpers;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\Auth\SocialAuthSerivceInterface;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class SocialAuthService implements SocialAuthSerivceInterface
{
    public function __construct(protected UserRepositoryInterface $userRepo) {}

    public function finalizeRegistration(string $tempKey, string $username): array
    {
        $userData = Cache::get($tempKey);

        if (!$userData)
            return ['status' => false, 'message' => __('message.Temporary key has expired or is invalid.')];
        dd($userData);
        if ($userData['photo'])
            $imagePath = ImageHelpers::addImage($userData['photo'], 'profiles');

        $user = $this->userRepo->create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'provider' => $userData['provider'],
            'provider_id' => $userData['providerId'],
            'type' => 'client',
            'email_verified_at' => now(),
            'is_active' => 1,
            'password' => bcrypt(bin2hex(random_bytes(8))),
            'approval_status' => ApprovalStatus::APPROVED,
            'profile_picture' => $imagePath ?? null,
            'username' => $username,
        ]);

        JWTAuth::fromUser($user);

        Cache::forget($tempKey);

        return ['status' => true, 'data' => [
            'user'  => $user,
            'token' => JWTAuth::fromUser($user),
        ]];
    }
}
