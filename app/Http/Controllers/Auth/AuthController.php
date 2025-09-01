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
use App\Services\Contracts\Auth\AuthUserServiceInterface;
use App\Services\Contracts\Auth\EmailVerificationServiceInterface;
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
    protected $authUserService;

    public function __construct(EmailVerificationServiceInterface $verifyService, AuthUserServiceInterface $authUserService)
    {
        $this->verifyService = $verifyService;
        $this->authUserService = $authUserService;
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
        $result = $this->authUserService->register([
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

        $result = $this->authUserService->resendCode($request->email);

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
     *       "first_name": "John",
     *       "last_name": "Doe",
     *       "email": "john@example.com",
     *       "type": "freelancer",
     *       "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *       "phone": null,
     *       "is_active": true,
     *       "about_me": null,
     *       "profile_picture": null,
     *       "approval_status": "requested",
     *       "linkedin_link": "https://linkedin.com/in/johndoe",
     *       "twitter_link": "https://twitter.com/johndoe",
     *       "other_freelance_platform_links": ["https://upwork.com/freelancers/johndoe"],
     *       "portfolio_link": "https://johndoe.com",
     *       "headline": null,
     *       "description": null,
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
     *       "first_name": "Jane",
     *       "last_name": "Smith",
     *       "email": "jane@example.com",
     *       "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *       "phone": null,
     *       "type": "client",
     *       "is_active": true,
     *       "about_me": null,
     *       "profile_picture": null,
     *       "company": null,
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
        $result = $this->authUserService->verifyEmail($request->email, $request->otp);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        $user = $result['data']['user'] ?? null;

        if ($user) {
            $resource = $user->type == UserType::FREELANCER->value
                ? FreelancerResource::make($user)
                : ClientResource::make($user);

            return Response::api(
                $result['message'],
                200,
                true,
                null,
                [
                    'user'  => $resource,
                    'token' => $result['data']['token'],
                ]
            );
        }

        return Response::api($result['message'], 200, true, null);
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
        $result = $this->authUserService->resetEmail($request->old_email, $request->new_email);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true, null);
    }

    /**
     * Login.
     * 
     * This endpoint authenticates users and returns a JWT token.
     *
     * @bodyParam email string required User email address. Example: user@example.com
     * @bodyParam password string required User password (minimum 6 characters). Example: password123
     * @bodyParam type string required User type (client or freelancer). Example: client
     *
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Login successful",
     *   "user": {
     *     "id": 2,
     *     "first_name": "Jane",
     *     "last_name": "Smith",
     *     "email": "jane@example.com",
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "phone": null,
     *     "type": "client",
     *     "is_active": true,
     *     "about_me": null,
     *     "profile_picture": null,
     *     "company": null,
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
    public function login(LoginRequest $request)
    {
        $result = $this->authUserService->login($request->email, $request->password, $request->type);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        if ($result['data']['user']['type'] == 'freelancer')
            return Response::api($result['message'], 200, true, null, [
                'user' => BaseResource::make(FreelancerResource::make($result['data']['user'])),
                'token' => $result['data']['token'],
            ]);

        return Response::api($result['message'], 200, true, null, [
            'user' => BaseResource::make(ClientResource::make($result['data']['user'])),
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
            'type' => 'required|string|in:client,freelancer',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->authUserService->forgetPassword($request->email, $request->type);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true, null, ['token' => $result['token']]);
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
        $result = $this->authUserService->resetPassword($request->email, $request->password, $request->token);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true, null);
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
