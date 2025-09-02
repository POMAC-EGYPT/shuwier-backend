<?php

namespace App\Services\Implementations\Auth;

use App\Enum\ApprovalStatus;
use App\Enum\UserType;
use App\Repository\Contracts\FreelancerProfileRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\Auth\AuthUserServiceInterface;
use App\Services\Contracts\Auth\EmailVerificationServiceInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthUserService implements AuthUserServiceInterface
{
    protected $userRepo;
    protected $verifyService;
    protected $freelancerRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        EmailVerificationServiceInterface $verifyService,
        FreelancerProfileRepositoryInterface $freelancerRepo
    ) {
        $this->userRepo = $userRepo;
        $this->verifyService = $verifyService;
        $this->freelancerRepo = $freelancerRepo;
    }

    public function register(array $data): array
    {
        $result = $this->verifyService->sendVerificationCode([
            'name'                             => $data['name'],
            'email'                            => $data['email'],
            'password'                         => $data['password'],
            'type'                             => $data['type'],
            'linkedin_link'                    => $data['linkedin_link'],
            'twitter_link'                     => $data['twitter_link'],
            'other_freelance_platform_links'   => $data['other_freelance_platform_links'],
            'portfolio_link'                   => $data['portfolio_link'],
        ]);

        if (!$result['status'])
            return ['status' => false, 'error_num' => $result['error_num'], 'message' => $result['message']];

        return ['status' => true, 'message' => $result['message']];
    }

    public function resendCode(string $email): array
    {
        $result = $this->verifyService->resendVerificationCode($email);

        if (!$result['status'])
            return ['status' => false, 'error_num' => $result['error_num'], 'message' => $result['message']];

        return ['status' => true, 'message' => $result['message']];
    }

    public function verifyEmail(string $email, string $otp): array
    {
        $result = $this->verifyService->verifyCode($email, $otp);

        if (!$result['status'])
            return ['status' => false, 'error_num' => $result['error_num'], 'message' => $result['message']];

        if ($result['data']['type'] != 'forget_password') {
            if ($result['data']['type'] == 'freelancer')
                $result['data']['other_freelance_platform_links'] = array_values($result['data']['other_freelance_platform_links']);

            $user = $this->userRepo->create([
                'first_name'                      => $result['data']['name'],
                'email'                           => $result['data']['email'],
                'password'                        => Hash::make($result['data']['password']),
                'type'                            => $result['data']['type'],
                'email_verified_at'               => now(),
                'is_active'                       => 1,
                'approval_status'                 => $result['data']['type'] == UserType::FREELANCER->value ? ApprovalStatus::REQUESTED : ApprovalStatus::APPROVED,
            ]);

            if ($result['data']['type'] == UserType::FREELANCER->value) {
                $this->freelancerRepo->create([
                    'user_id'                         => $user->id,
                    'linkedin_link'                   => $result['data']['linkedin_link'],
                    'twitter_link'                    => $result['data']['twitter_link'],
                    'other_freelance_platform_links'  => json_encode($result['data']['other_freelance_platform_links']),
                    'portfolio_link'                  => $result['data']['portfolio_link'],
                ]);
            }

            $user->load('freelancerProfile');

            return ['status' => true, 'message' => __('message.user_registered'), 'data' => [
                'user' => $user,
                'token' => JWTAuth::fromUser($user),
            ]];
        } else {
            return ['status' => true, 'message' => __('message.email_verification_success'), 'data' => null];
        }
    }

    public function resetEmail(string $oldEmail, string $newEmail): array
    {
        $result = $this->verifyService->resetEmail($oldEmail, $newEmail);

        if (!$result['status'])
            return ['status' => false, 'error_num' => $result['error_num'], 'message' => $result['message']];

        return ['status' => true, 'message' => $result['message']];
    }

    public function login(string $email, string $password, string $type): array
    {
        $user = $this->userRepo->findByEmailAndType($email, $type . 's');

        if (!$user)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.user_not_found')];

        if (!Hash::check($password, $user->password))
            return ['status' => false, 'error_num' => 400, 'message' => __('message.invalid_password')];

        if (!$user->is_active)
            return ['status' => false, 'error_num' => 403, 'message' => __('message.account_is_blocked')];

        if (!$user->email_verified_at)
            return ['status' => false, 'error_num' => 403, 'message' => __('message.email_not_verified')];

        $token = JWTAuth::fromUser($user);

        if ($user->type == UserType::FREELANCER)
            $user->load(['freelancerProfile']);

        return ['status' => true, 'message' => __('message.login_success'), 'data' => [
            'user' => $user,
            'token' => $token,
        ]];
    }

    public function forgetPassword(string $email, string $type): array
    {
        $user = $this->userRepo->findByEmailAndType($email, $type . 's');

        if (!$user)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.user_not_found')];

        $token = Str::random(60);

        $result = $this->verifyService->sendVerificationCode([
            'email'   => $user->email,
            'type'    => 'forget_password',
            'user_id' => $user->id,
            'token'   => $token,
        ]);

        if (!$result['status'])
            return ['status' => false, 'error_num' => $result['error_num'], 'message' => $result['message']];

        Cache::put('forget_password_' . $user->email, [
            'email'   => $user->email,
            'type'    => 'forget_password',
            'user_id' => $user->id,
            'token'   => $token,
        ]);

        return ['status' => true, 'message' => $result['message'], 'token' => $token];
    }

    public function resetPassword(string $email, string $password, string $token): array
    {
        $cached = Cache::get('forget_password_' . $email);

        if (!$cached)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.verification_session_expired')];

        if (!isset($cached['is_verified_forget_password']) || !$cached['is_verified_forget_password'])
            return ['status' => false, 'error_num' => 400, 'message' => __('message.verification_code_not_verified')];

        if ($cached['token'] != $token)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.invalid_token')];

        $user = $this->userRepo->find($cached['user_id']);

        $this->userRepo->update($user->id, [
            'password' => Hash::make($password)
        ]);

        Cache::forget('forget_password_' . $user->email);

        return ['status' => true, 'message' => __('message.password_reset_success')];
    }
}
