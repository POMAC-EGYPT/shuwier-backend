<?php

namespace App\Services\Implementations\Auth;

use App\Enum\ApprovalStatus;
use App\Enum\UserType;
use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\FreelancerProfileRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\Auth\AuthUserServiceInterface;
use App\Services\Contracts\Auth\EmailVerificationServiceInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ImageHelpers;
use App\Repository\Contracts\InvitationFreelancerRepositoryInterface;
use App\Repository\Contracts\UserLanguageRepositoryInterface;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthUserService implements AuthUserServiceInterface
{
    protected $userRepo;
    protected $verifyService;
    protected $freelancerRepo;
    protected $categoryRepo;
    protected $userLanguageRepo;
    protected $invitationUserRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        EmailVerificationServiceInterface $verifyService,
        FreelancerProfileRepositoryInterface $freelancerRepo,
        CategoryRepositoryInterface $categoryRepo,
        UserLanguageRepositoryInterface $userLanguageRepo,
        InvitationFreelancerRepositoryInterface $invitationUserRepo

    ) {
        $this->userRepo = $userRepo;
        $this->verifyService = $verifyService;
        $this->freelancerRepo = $freelancerRepo;
        $this->categoryRepo = $categoryRepo;
        $this->userLanguageRepo = $userLanguageRepo;
        $this->invitationUserRepo = $invitationUserRepo;
    }

    public function register(array $data): array
    {
        // Check if user already exists in invitation users table and user registered as client
        $user = $this->invitationUserRepo->getByEmail($data['email']);

        if ($user && $data['type'] == UserType::CLIENT->value)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.user_already_registered')];

        $result = $this->verifyService->sendVerificationCode([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'type' => $data['type'],
            'linkedin_link' => $data['linkedin_link'],
            'twitter_link' => $data['twitter_link'],
            'other_freelance_platform_links' => $data['other_freelance_platform_links'],
            'portfolio_link' => $data['portfolio_link'],
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

            $invitation = $this->invitationUserRepo->getByEmail($result['data']['email']);

            $user = $this->userRepo->create([
                'name' => $result['data']['name'],
                'email' => $result['data']['email'],
                'password' => Hash::make($result['data']['password']),
                'type' => $result['data']['type'],
                'email_verified_at' => now(),
                'is_active' => 1,
                'approval_status' => (
                    $result['data']['type'] == UserType::CLIENT->value
                    || (
                        $invitation != null && $invitation->status == 'pending' && $result['data']['type'] == UserType::FREELANCER->value
                    )
                ) ? ApprovalStatus::APPROVED : ApprovalStatus::REQUESTED,
            ]);

            if ($result['data']['type'] == UserType::FREELANCER->value) {
                $this->freelancerRepo->create([
                    'user_id' => $user->id,
                    'linkedin_link' => $result['data']['linkedin_link'],
                    'twitter_link' => $result['data']['twitter_link'],
                    'other_freelance_platform_links' => json_encode($result['data']['other_freelance_platform_links']),
                    'portfolio_link' => $result['data']['portfolio_link'],
                ]);
            }
            if ($invitation && $invitation->status == 'pending')
                $this->invitationUserRepo->delete($invitation->id);

            $user->load('freelancerProfile');

            return [
                'status' => true,
                'message' => __('message.user_registered'),
                'data' => [
                    'user' => $user,
                    'token' => JWTAuth::fromUser($user),
                ]
            ];
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

    public function login(string $email, string $password): array
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.user_not_found')];

        if (!Hash::check($password, hashedValue: $user->password))
            return ['status' => false, 'error_num' => 400, 'message' => __('message.invalid_password')];

        if (!$user->is_active)
            return ['status' => false, 'error_num' => 403, 'message' => __('message.account_is_blocked')];

        if (!$user->email_verified_at)
            return ['status' => false, 'error_num' => 403, 'message' => __('message.email_not_verified')];

        $token = JWTAuth::fromUser($user);

        return [
            'status' => true,
            'message' => __('message.login_success'),
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ];
    }

    public function forgetPassword(string $email): array
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.user_not_found')];

        $token = Str::random(60);

        $result = $this->verifyService->sendVerificationCode([
            'email' => $user->email,
            'type' => 'forget_password',
            'user_id' => $user->id,
            'token' => $token,
        ]);

        if (!$result['status'])
            return ['status' => false, 'error_num' => $result['error_num'], 'message' => $result['message']];

        Cache::put('forget_password_' . $user->email, [
            'email' => $user->email,
            'type' => 'forget_password',
            'user_id' => $user->id,
            'token' => $token,
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

    public function getProfile(): array
    {
        $user = auth('api')->user();

        $user->load(['freelancerProfile', 'freelancerProfile.category', 'skills', 'portfolios', 'languages']);

        return ['status' => true, 'message' => __('message.success'), 'data' => $user];
    }

    public function updateProfile(array $data): array
    {
        $user = auth('api')->user();

        if ($user->type == UserType::FREELANCER->value && $user->approval_status != ApprovalStatus::APPROVED)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.you_are_not_approved_freelancer')];

        $profilePicturePath = null;
        if (isset($data['profile_picture']) && $data['profile_picture'] instanceof \Illuminate\Http\UploadedFile)
            $profilePicturePath = $user->profile_picture ?
                ImageHelpers::updateImage($data['profile_picture'], $user->profile_picture, 'profiles')
                : ImageHelpers::addImage($data['profile_picture'], 'profiles');

        if ($user->type == UserType::FREELANCER->value) {
            if (isset($data['category_id'])) {
                $category = $this->categoryRepo->find($data['category_id']);

                if ($category->parent_id != null)
                    return ['status' => false, 'error_num' => 400, 'message' => __('message.this_category_is_not_a_parent_category')];
            }

            $userTransaction = DB::transaction(function () use ($user, $data, $profilePicturePath) {
                $userData = [];
                $freelancerData = [];

                if (array_key_exists('name', $data))
                    $userData['name'] = $data['name'];

                if (array_key_exists('about_me', $data))
                    $userData['about_me'] = $data['about_me'];

                if (array_key_exists('profile_picture', $data))
                    $userData['profile_picture'] = $profilePicturePath ?? $user->profile_picture;

                if (array_key_exists('country', $data))
                    $userData['country'] = $data['country'];

                if (array_key_exists('city', $data))
                    $userData['city'] = $data['city'];

                $this->userRepo->update($user->id, $userData);

                if (array_key_exists('headline', $data))
                    $freelancerData['headline'] = $data['headline'];

                if (array_key_exists('category_id', $data))
                    $freelancerData['category_id'] = $data['category_id'];

                $this->freelancerRepo->updateByUserId($user->id, $freelancerData);

                if (array_key_exists('skill_ids', $data))
                    $user->skills()->sync($data['skill_ids']);

                if (array_key_exists('languages', $data))
                    $this->userLanguageRepo->syncUserLanguages($user->id, $data['languages']);

                $user->refresh();

                $user->load(['freelancerProfile', 'freelancerProfile.category', 'skills', 'portfolios', 'languages']);

                return $user;
            });
        } elseif ($user->type == UserType::CLIENT->value) {
            $userTransaction = DB::transaction(function () use ($user, $data) {
                $userData = [];

                if (array_key_exists('name', $data))
                    $userData['name'] = $data['name'];

                if (array_key_exists('about_me', $data))
                    $userData['about_me'] = $data['about_me'];

                if (array_key_exists('company', $data))
                    $userData['company'] = $data['company'];

                if (array_key_exists('phone', $data))
                    $userData['phone'] = $data['phone'];

                if (array_key_exists('profile_picture', $data))
                    $userData['profile_picture'] = $profilePicturePath ?? $user->profile_picture;

                if (array_key_exists('country', $data))
                    $userData['country'] = $data['country'];

                if (array_key_exists('city', $data))
                    $userData['city'] = $data['city'];

                if (array_key_exists('languages', $data))
                    $this->userLanguageRepo->syncUserLanguages($user->id, $data['languages']);

                $this->userRepo->update($user->id, $userData);

                $user->refresh();

                $user->load(['freelancerProfile', 'freelancerProfile.category', 'skills', 'portfolios', 'languages']);

                return $user;
            });
        }

        return ['status' => true, 'message' => __('message.profile_updated_successfully'), 'data' => $userTransaction];
    }

    public function changePassword(string $currentPassword, string $newPassword): array
    {
        $user = auth('api')->user();

        if (!Hash::check($currentPassword, $user->password))
            return ['status' => false, 'error_num' => 400, 'message' => __('message.invalid_current_password')];

        $this->userRepo->update($user->id, [
            'password' => Hash::make($newPassword)
        ]);

        return ['status' => true, 'message' => __('message.password_changed_successfully')];
    }

    public function changeEmail(string $email, string $password): array
    {
        $user = auth('api')->user();

        if ($user->email == $email)
            return ['status' => false, 'error_num' => 400, 'message' => __('message.new_email_must_be_different')];

        if (!Hash::check($user->password, $password))
            return ['status' => false, 'error_num' => 400, 'message' => __('message.invalid_password')];

        $result = $this->verifyService->sendVerificationCode([
            'email' => $email,
            'type' => 'change_email',
            'old_email' => $user->email,
        ]);

        if (!$result['status'])
            return ['status' => false, 'error_num' => $result['error_num'], 'message' => $result['message']];

        return ['status' => true, 'message' => $result['message']];
    }

    public function verifyChangeEmail(string $email, string $otp): array
    {
        $user = auth('api')->user();

        $result = $this->verifyService->verifyCode($email, $otp);

        if (!$result['status'])
            return ['status' => false, 'error_num' => $result['error_num'], 'message' => $result['message']];

        $this->userRepo->update($user->id, [
            'email' => $email,
            'email_verified_at' => now(),
        ]);

        return ['status' => true, 'message' => __('message.email_changed_successfully')];
    }
}
