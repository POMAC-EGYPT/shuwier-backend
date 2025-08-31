<?php

namespace App\Services\Implementation;

use App\Enum\UserType;
use App\Models\User;
use App\Services\Contracts\LoginServiceInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginService implements LoginServiceInterface
{
    public function login(string $email, string $password, string $type): array
    {
        $user = User::{$type}()->where('email', $email)->first();

        if (!$user)
            return ['success' => false, 'error_num' => 404, 'message' => __('message.user_not_found')];

        if (!Hash::check($password, $user->password))
            return ['success' => false, 'error_num' => 400, 'message' => __('message.invalid_password')];

        if (!$user->is_active)
            return ['success' => false, 'error_num' => 403, 'message' => __('message.account_is_blocked')];

        if (!$user->email_verified_at)
            return ['success' => false, 'error_num' => 403, 'message' => __('message.email_not_verified')];

        $token = JWTAuth::fromUser($user);

        return ['success' => true, 'message' => __('message.login_success'), 'data' => [
            'user' => $user,
            'token' => $token,
        ]];
    }
}
