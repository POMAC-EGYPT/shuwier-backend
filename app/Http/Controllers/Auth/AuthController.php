<?php

namespace App\Http\Controllers\Auth;

use App\Enum\ApprovalStatus;
use App\Enum\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetEmail;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
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

/**
 * @group User Authentication
 * 
 * APIs for user registration, authentication, and account management.
 * These endpoints handle user registration with email verification, login, password reset,
 * and other authentication-related functionality for both clients and freelancers.
 */
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
     * 
     * This endpoint initiates the user registration process by sending a verification code to the provided email.
     * Users can register as either freelancers or clients. Freelancers need to provide additional professional information.
     * After successful validation, a 4-digit OTP code will be sent to the email for verification.
     * 
     * @bodyParam name string required User's full name (Arabic or English). Example: أحمد محمد
     * @bodyParam email string required User's email address (must be unique and valid). Example: ahmed@example.com
     * @bodyParam password string required Password (min 8 chars, must contain uppercase, lowercase, number, and special character). Example: Password123!
     * @bodyParam password_confirmation string required Password confirmation (must match password). Example: Password123!
     * @bodyParam type string required User type. Must be either "freelancer" or "client". Example: freelancer
     * @bodyParam linkedin_link string required_if:type,freelancer LinkedIn profile URL (required for freelancers). Example: https://linkedin.com/in/ahmed
     * @bodyParam twitter_link string required_if:type,freelancer Twitter profile URL (required for freelancers). Example: https://twitter.com/ahmed
     * @bodyParam other_freelance_platform_links array required_if:type,freelancer Array of other freelance platform URLs (1-3 links, required for freelancers). Example: ["https://upwork.com/freelancers/ahmed"]
     * @bodyParam other_freelance_platform_links.* string URL format for each freelance platform link. Example: https://upwork.com/freelancers/ahmed
     * @bodyParam portfolio_link string required_if:type,freelancer Portfolio website URL (required for freelancers). Example: https://ahmed-portfolio.com
     * 
     * @response 200 scenario="Verification code sent successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Verification code sent successfully"
     * }
     *
     * @response 400 scenario="Email already exists" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email has already been taken."
     * }
     *
     * @response 429 scenario="Too many attempts" {
     *   "status": false,
     *   "error_num": 429,
     *   "message": "Too many verification attempts. Please try again later."
     * }
     *
     * @response 422 scenario="Validation error" {
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
     * 
     * This endpoint resends the verification code to the user's email if they didn't receive it
     * or if the previous code expired. Rate limiting applies to prevent spam.
     * 
     * @bodyParam email string required The email address to resend the verification code to. Example: ahmed@example.com
     * 
     * @response 200 scenario="Code resent successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Verification code resent successfully"
     * }
     *
     * @response 400 scenario="Email not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Email not found or already verified"
     * }
     *
     * @response 400 scenario="Rate limit exceeded" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Please wait 60 seconds before requesting another code"
     * }
     *
     * @response 429 scenario="Too many attempts" {
     *   "status": false,
     *   "error_num": 429,
     *   "message": "Too many verification attempts. Please try again later."
     * }
     *
     * @response 422 scenario="Validation error" {
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
     *       "name": "John Doe",
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
     *       "name": "Jane Smith",
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
     * 
     * This endpoint allows users to change their email address during the registration process
     * if they have exceeded the maximum verification attempts. A new verification code will be sent
     * to the new email address.
     * 
     * @bodyParam old_email string required The current email address that needs to be changed. Example: oldemail@example.com
     * @bodyParam new_email string required The new email address (must be unique and valid). Example: newemail@example.com
     * 
     * @response 200 scenario="Email reset successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Verification code sent to new email address"
     * }
     *
     * @response 400 scenario="Old email not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Verification session expired or old email not found"
     * }
     *
     * @response 400 scenario="Cannot change email yet" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Cannot change email yet. Complete verification attempts first."
     * }
     *
     * @response 400 scenario="New email already exists" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The new email has already been taken."
     * }
     *
     * @response 422 scenario="Validation error" {
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
     *     "name": "Jane Smith",
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
     * 
     * This endpoint initiates the password reset process by sending a verification code to the user's email.
     * A reset token is also generated and returned for use in the password reset process.
     * 
     * @bodyParam email string required User's email address (must exist in the system). Example: user@example.com
     * @bodyParam type string required User type. Must be either "client" or "freelancer". Example: client
     * 
     * @response 200 scenario="Reset code sent successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Verification code sent successfully",
     *   "data": {
     *     "token": "abc123def456ghi789jkl012mno345pqr678stu901vwx234yz567890"
     *   }
     * }
     *
     * @response 400 scenario="Email not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected email is invalid."
     * }
     *
     * @response 429 scenario="Too many attempts" {
     *   "status": false,
     *   "error_num": 429,
     *   "message": "Too many verification attempts. Please try again later."
     * }
     *
     * @response 422 scenario="Validation error" {
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
     * 
     * This endpoint completes the password reset process using the verification code and reset token.
     * The user must first verify their email through the forget password flow before using this endpoint.
     * 
     * @bodyParam email string required User's email address. Example: user@example.com
     * @bodyParam password string required New password (min 8 chars, must contain uppercase, lowercase, number, and special character). Example: NewPassword123!
     * @bodyParam password_confirmation string required Password confirmation (must match password). Example: NewPassword123!
     * @bodyParam token string required Reset token received from forget password endpoint. Example: abc123def456ghi789
     * 
     * @response 200 scenario="Password reset successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Password reset successfully"
     * }
     *
     * @response 400 scenario="Verification session expired" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Verification session expired or not found"
     * }
     *
     * @response 400 scenario="Verification code not verified" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Email verification required before password reset"
     * }
     *
     * @response 400 scenario="Invalid token" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Invalid or expired reset token"
     * }
     *
     * @response 422 scenario="Validation error" {
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
     * 
     * This endpoint logs out the authenticated user by invalidating their JWT token.
     * After logout, the token cannot be used for authentication.
     * 
     * @authenticated
     * 
     * @response 200 scenario="Logout successful" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Logout successful"
     * }
     *
     * @response 401 scenario="Unauthenticated" {
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
     * 
     * This endpoint refreshes the user's JWT token, providing a new token with extended expiration time.
     * Use this endpoint to maintain user sessions without requiring re-authentication.
     * 
     * @authenticated
     * 
     * @response 200 scenario="Token refreshed successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Token refreshed successfully",
     *   "data": {
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
     *   }
     * }
     *
     * @response 401 scenario="Token invalid or expired" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Token could not be refreshed"
     * }
     *
     * @response 401 scenario="Unauthenticated" {
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

    /**
     * Get User Profile.
     * 
     * This endpoint retrieves the authenticated user's profile information.
     * Returns different data structures based on user type (freelancer or client).
     * Freelancers will get additional fields like skills, category, portfolio links, etc.
     * Clients will get basic profile information along with company details.
     * 
     * @authenticated
     * 
     * @response 200 scenario="Freelancer profile" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Profile retrieved successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "أحمد محمد",
     *     "email": "ahmed@example.com",
     *     "type": "freelancer",
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "phone": null,
     *     "is_active": true,
     *     "about_me": "مطور ويب محترف مع خبرة 5 سنوات",
     *     "profile_picture": "storage/profiles/ahmed_profile.jpg",
     *     "approval_status": "approved",
     *     "linkedin_link": "https://linkedin.com/in/ahmed",
     *     "twitter_link": "https://twitter.com/ahmed",
     *     "other_freelance_platform_links": ["https://upwork.com/freelancers/ahmed"],
     *     "portfolio_link": "https://ahmed-portfolio.com",
     *     "headline": "Full Stack Developer & UI/UX Designer",
     *     "description": "Experienced developer specializing in Laravel and React",
     *     "category": {
     *       "id": 1,
     *       "name": "Web Development"
     *     },
     *     "skills": [
     *       {"id": 1, "name": "PHP"},
     *       {"id": 2, "name": "Laravel"},
     *       {"id": 3, "name": "React"}
     *     ],
     *     "portfolios": [],
     *     "created_at": "2025-08-24T10:30:00.000000Z",
     *     "updated_at": "2025-08-24T10:30:00.000000Z"
     *   }
     * }
     *
     * @response 200 scenario="Client profile" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Profile retrieved successfully",
     *   "data": {
     *     "id": 2,
     *     "name": "Jane Smith",
     *     "email": "jane@example.com",
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "phone": "+1234567890",
     *     "type": "client",
     *     "is_active": true,
     *     "about_me": "Business owner looking for quality freelance services",
     *     "profile_picture": "storage/profiles/jane_profile.jpg",
     *     "company": "Tech Solutions Inc",
     *     "created_at": "2025-08-24T10:30:00.000000Z",
     *     "updated_at": "2025-08-24T10:30:00.000000Z"
     *   }
     * }
     *
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     *
     * @response 400 scenario="Profile retrieval failed" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Unable to retrieve profile information"
     * }
     */
    public function profile()
    {
        $result = $this->authUserService->getProfile();

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        $user = $result['data'];

        $resource = $user->type == UserType::FREELANCER->value
            ? FreelancerResource::make($user)
            : ClientResource::make($user);

        return Response::api($result['message'], 200, true, null, $resource);
    }

    /**
     * Update User Profile
     * 
     * Update the authenticated user's profile information. This endpoint supports both freelancers and clients
     * with different required fields based on user type. Freelancers cannot change their type to client.
     * 
     * **For Freelancers:**
     * - Required: type, name, about_me, headline, category_id, skill_ids, linkedin_link, twitter_link, other_freelance_platform_links, portfolio_link
     * - Optional: profile_picture
     * - Prohibited: company, phone
     * 
     * **For Clients:**
     * - Required: type, name, about_me, phone
     * - Optional: profile_picture, company
     * - Prohibited: headline, category_id, skill_ids, linkedin_link, twitter_link, other_freelance_platform_links, portfolio_link
     * 
     * @response 200 {
     *   "message": "Profile updated successfully",
     *   "status": true,
     *   "data": {
     *     "id": 1,
     *     "name": "أحمد محمد",
     *     "email": "ahmed@example.com",
     *     "type": "freelancer",
     *     "profile_picture": "storage/profiles/new_image.jpg",
     *     "about_me": "مطور ويب محترف",
     *     "headline": "Full Stack Developer",
     *     "category": {
     *       "id": 1,
     *       "name": "Web Development"
     *     },
     *     "skills": [
     *       {"id": 1, "name": "PHP"},
     *       {"id": 2, "name": "Laravel"}
     *     ]
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "Cannot change user type from freelancer to client",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @response 400 {
     *   "message": "This category is not a parent category",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @authenticated
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $result = $this->authUserService->updateProfile([
            'type'                             => $request->type,
            'name'                             => $request->name,
            'profile_picture'                  => $request->profile_picture,
            'about_me'                         => $request->about_me,
            'headline'                         => $request->headline,
            'category_id'                      => $request->category_id,
            'skill_ids'                        => $request->skill_ids ?? [],
            'company'                          => $request->company,
            'phone'                            => $request->phone,
            'linkedin_link'                    => $request->linkedin_link,
            'twitter_link'                     => $request->twitter_link,
            'other_freelance_platform_links'   => $request->other_freelance_platform_links ?? [],
            'portfolio_link'                   => $request->portfolio_link,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        $user = $result['data'];

        $resource = $user->type == UserType::FREELANCER->value
            ? FreelancerResource::make($user)
            : ClientResource::make($user);

        return Response::api($result['message'], 200, true, null, $resource);
    }
}
