<?php

namespace App\Http\Controllers\Auth;

use App\Enum\ApprovalStatus;
use App\Enum\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetEmail;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ClientResource;

use App\Http\Resources\FreelancerResource;
use App\Models\User;
use App\Rules\EmailRule;
use App\Services\Contracts\EmailVerificationServiceInterface;
use App\Services\Contracts\LoginServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    protected $verifyService;
    protected $loginService;

    public function __construct(EmailVerificationServiceInterface $verifyService, LoginServiceInterface $loginService)
    {
        $this->verifyService = $verifyService;
        $this->loginService = $loginService;
    }

    /**
     * User Registration.
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Verification code sent successfully",
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Email already exists"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email field is required."
     * }
     */
    public function register(RegisterRequest $request)
    {
        $result = $this->verifyService->sendVerificationCode([
            'name'                             => $request->name,
            'email'                            => $request->email,
            'password'                         => $request->password,
            'type'                             => $request->type,
            'linkedin_link'                    => $request->linkedin_link,
            'twitter_link'                     => $request->twitter_link,
            'other_freelance_platform_links'   => $request->other_freelance_platform_links,
            'portfolio_link'                   => $request->portfolio_link,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true, null);
    }

    /**
     * Resend Verification Code.
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Verification code resent successfully"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Email not found or already verified"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email field is required."
     * }
     */
    public function resendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email:rfc,dns',
                new EmailRule,
            ],
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->verifyService->resendVerificationCode($request->email);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true, null);
    }

    /**
     * Verify Email and Complete Registration.
     * 
     * This endpoint verifies the email OTP code sent during registration and completes the user account creation.
     * For freelancers, the account will be created with "requested" approval status and require admin approval.
     * For clients, the account will be immediately approved and ready to use.
     * 
     * @bodyParam email string required The email address to verify. Example: user@example.com
     * @bodyParam otp string required The 4-digit verification code sent to email. Example: 1234
     * 
     * @response 200 scenario="Freelancer registration completed" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "User registered successfully",
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "name": "John Doe",
     *       "email": "john@example.com",
     *       "type": "freelancer",
     *       "approval_status": "requested",
     *       "is_active": 1,
     *       "linkedin_link": "https://linkedin.com/in/johndoe",
     *       "twitter_link": "https://twitter.com/johndoe",
     *       "portfolio_link": "https://johndoe.com",
     *       "other_freelance_platform_links": ["https://upwork.com/freelancers/johndoe"],
     *       "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *       "created_at": "2025-08-24T10:30:00.000000Z",
     *       "updated_at": "2025-08-24T10:30:00.000000Z"
     *     },
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
     *   }
     * }
     *
     * @response 200 scenario="Client registration completed" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "User registered successfully",
     *   "data": {
     *     "user": {
     *       "id": 2,
     *       "name": "Jane Smith",
     *       "email": "jane@example.com",
     *       "type": "client",
     *       "approval_status": "approved",
     *       "is_active": 1,
     *       "linkedin_link": null,
     *       "twitter_link": null,
     *       "portfolio_link": null,
     *       "other_freelance_platform_links": null,
     *       "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *       "created_at": "2025-08-24T10:30:00.000000Z",
     *       "updated_at": "2025-08-24T10:30:00.000000Z"
     *     },
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
     *   }
     * }
     *
     * @response 200 scenario="Password reset verification" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Email verification successful"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Invalid or expired verification code"
     * }
     *
     * @response 422 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The otp field is required."
     * }
     */
    public function verifyEmail(VerifyEmailRequest $request)
    {
        $result = $this->verifyService->verifyCode($request->email, $request->otp);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        if ($result['data']['type'] != 'forget_password') {
            if ($result['data']['type'] == 'freelancer')
                $result['data']['other_freelance_platform_links'] = array_values($result['data']['other_freelance_platform_links']);

            $user = User::create([
                'name'                            => $result['data']['name'],
                'email'                           => $result['data']['email'],
                'password'                        => Hash::make($result['data']['password']),
                'type'                            => $result['data']['type'],
                'email_verified_at'               => now(),
                'linkedin_link'                   => $result['data']['type'] == UserType::FREELANCER->value ? $result['data']['linkedin_link'] : null,
                'twitter_link'                    => $result['data']['type'] == UserType::FREELANCER->value ? $result['data']['twitter_link'] : null,
                'other_freelance_platform_links'  => $result['data']['type'] == UserType::FREELANCER->value ? json_encode($result['data']['other_freelance_platform_links']) : null,
                'portfolio_link'                  => $result['data']['type'] == UserType::FREELANCER->value ? $result['data']['portfolio_link'] : null,
                'is_active'                       => 1,
                'approval_status'                 => $result['data']['type'] == UserType::FREELANCER->value ? ApprovalStatus::REQUESTED->value : ApprovalStatus::APPROVED->value,
            ]);

            if ($result['data']['type'] == UserType::FREELANCER->value)
                return Response::api(__('message.user_registered'), 200, true, null, [
                    'user' => BaseResource::make(FreelancerResource::make($user)),
                    'token' => JWTAuth::fromUser($user),
                ]);

            return Response::api(__('message.user_registered'), 200, true, null, [
                'user' => BaseResource::make(ClientResource::make($user)),
                'token' => JWTAuth::fromUser($user),
            ]);
        } else {
            return Response::api($result['message'], 200, true, null);
        }
    }

    /**
     * Reset Email Address.
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Email reset successfully",
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Old email not found or new email already exists"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The old_email field is required."
     * }
     */
    public function resetEmail(ResetEmail $request)
    {
        $result = $this->verifyService->resetEmail($request->old_email, $request->new_email);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true, null);
    }

    /**
     * Client Login.
     * 
     * This endpoint authenticates client users and returns a JWT token.
     * 
     * @bodyParam email string required Client email address. Example: client@example.com
     * @bodyParam password string required Client password (minimum 6 characters). Example: password123
     * 
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Login successful",
     *   "user": {
     *     "id": 2,
     *     "name": "Jane Smith",
     *     "email": "jane@example.com",
     *     "type": "client",
     *     "approval_status": "approved",
     *     "is_active": 1,
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "created_at": "2025-08-24T10:30:00.000000Z",
     *     "updated_at": "2025-08-24T10:30:00.000000Z"
     *   },
     *   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Invalid password"
     * }
     *
     * @response 403 scenario="Account blocked" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Account is blocked"
     * }
     *
     * @response 403 scenario="Email not verified" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Email is not verified"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email field is required."
     * }
     */
    public function loginClient(LoginRequest $request)
    {
        $result = $this->loginService->login($request->email, $request->password, UserType::CLIENT->value . 's');


        if (!$result['success'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api(__('message.login_success'), 200, true, null, [
            'user' => BaseResource::make(ClientResource::make($result['data']['user'])),
            'token' => $result['data']['token'],
        ]);
    }

    /**
     * Freelancer Login.
     * 
     * This endpoint authenticates freelancer users and returns a JWT token.
     * 
     * @bodyParam email string required Freelancer email address. Example: freelancer@example.com
     * @bodyParam password string required Freelancer password (minimum 6 characters). Example: password123
     * 
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Login successful",
     *   "user": {
     *     "id": 1,
     *     "name": "John Doe",
     *     "email": "john@example.com",
     *     "type": "freelancer",
     *     "approval_status": "approved",
     *     "is_active": 1,
     *     "linkedin_link": "https://linkedin.com/in/johndoe",
     *     "twitter_link": "https://twitter.com/johndoe",
     *     "portfolio_link": "https://johndoe.com",
     *     "other_freelance_platform_links": ["https://upwork.com/freelancers/johndoe"],
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "created_at": "2025-08-24T10:30:00.000000Z",
     *     "updated_at": "2025-08-24T10:30:00.000000Z"
     *   },
     *   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Invalid password"
     * }
     *
     * @response 403 scenario="Account blocked" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Account is blocked"
     * }
     *
     * @response 403 scenario="Email not verified" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Email is not verified"
     * }
     *
     * @response 403 scenario="Freelancer not approved" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Your account is pending admin approval"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email field is required."
     * }
     */
    public function loginFreelancer(LoginRequest $request)
    {
        $result = $this->loginService->login($request->email, $request->password, UserType::FREELANCER->value . 's');

        if (!$result['success'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api(__('message.login_success'), 200, true, null, [
            'user' => BaseResource::make(FreelancerResource::make($result['data']['user'])),
            'token' => $result['data']['token'],
        ]);
    }

    /**
     * Forget Password - Send Reset Code.
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Verification code sent successfully",
     *   "data": {
     *     "token": "abc123def456ghi789jkl012mno345pqr678stu901vwx234yz567890"
     *   }
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Email not found"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email field is required."
     * }
     */
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email:rfc,dns',
                'exists:users,email',

            ],
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $user = User::where('email', $request->email)->first();

        $token = Str::random(60);

        $result = $this->verifyService->sendVerificationCode([
            'email'   => $user->email,
            'type'    => 'forget_password',
            'user_id' => $user->id,
            'token'   => $token,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);


        Cache::put('forget_password_' . $user->email, [
            'email'   => $user->email,
            'type'    => 'forget_password',
            'user_id' => $user->id,
            'token'   => $token,
        ]);

        return Response::api($result['message'], 200, true, null, ['token' => $token]);
    }

    /**
     * Reset Password.
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Password reset successfully"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Verification session expired"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Verification code not verified"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Invalid token"
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email field is required."
     * }
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $cached = Cache::get('forget_password_' . $request->email);

        if (!$cached)
            return Response::api(__('message.verification_session_expired'), 400, false, 400);

        if (!isset($cached['is_verified_forget_password']) || !$cached['is_verified_forget_password'])
            return Response::api(__('message.verification_code_not_verified'), 400, false, 400);

        if ($cached['token'] != $request->token)
            return Response::api(__('message.invalid_token'), 400, false, 400);

        $user = User::find($cached['user_id']);

        $user->password = Hash::make($request->password);
        $user->save();

        Cache::forget('forget_password_' . $user->email);

        return Response::api(__('message.password_reset_success'), 200, true, null);
    }

    /**
     * User Logout.
     * @authenticated
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Logout successful"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return Response::api(__('message.logout_success'), 200, true, null);
    }

    /**
     * Refresh Token.
     * @authenticated
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Token refreshed successfully",
     *   "data": {
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
     *   }
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function refresh()
    {
        $token = JWTAuth::refresh(JWTAuth::getToken());

        return Response::api(__('message.token_refreshed'), 200, true, null, [
            'token' => $token,
        ]);
    }
}
