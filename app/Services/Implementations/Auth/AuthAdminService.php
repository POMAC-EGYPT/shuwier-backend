<?php

namespace App\Services\Implementations\Auth;

use App\Models\Admin;
use App\Repository\Contracts\AdminRepositoryInterface;
use App\Services\Contracts\Auth\AuthAdminServiceInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthAdminService implements AuthAdminServiceInterface
{
    public function __construct(protected AdminRepositoryInterface $adminRepo) {}

    public function login(string $email, string $password): array
    {
        $admin = Admin::where('email', $email)->first();

        if (!$admin)
            return ['status' => false, 'error_num' => 404, 'message' => __('message.email_not_found')];

        if (!Hash::check($password, $admin->password))
            return ['status' => false, 'error_num' => 400, 'message' => __('message.invalid_password')];

        $token = JWTAuth::fromUser($admin);

        return ['status' => true, 'data' => [
            'admin' => $admin,
            'token' => $token,
        ]];
    }

    public function changePassword(string $currentPassword, string $newPassword): array
    {
        $admin = auth('admin')->user();

        if (!Hash::check($currentPassword, $admin->password))
            return ['status' => false, 'error_num' => 400, 'message' => __('message.invalid_current_password')];

        $this->adminRepo->update($admin->id, [
            'password' => Hash::make($newPassword)
        ]);

        return ['status' => true, 'message' => __('message.password_changed_successfully')];
    }
}
