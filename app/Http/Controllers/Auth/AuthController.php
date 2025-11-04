<?php

namespace App\Http\Controllers\Auth;

use App\Enum\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetEmail;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\FreelancerResource;
use App\Rules\EmailRule;
use App\Services\Contracts\Auth\AuthUserServiceInterface;
use App\Services\Contracts\Auth\EmailVerificationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
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
     * Check Registration Fields.
     * 
     * This endpoint validates user registration data without actually creating the user account.
     * It's useful for frontend validation and checking field availability (like email uniqueness)
     * before proceeding with the full registration process. This helps provide immediate feedback
     * to users about any validation issues with their registration data.
     * 
     * @bodyParam name string required User's full name (Arabic or English characters only). Example: أحمد محمد
     * @bodyParam email string required User's email address (must be unique and valid). Example: ahmed@example.com
     * @bodyParam password string required Password (min 8 chars, must contain uppercase, lowercase, number, and special character). Example: Password123!
     * @bodyParam password_confirmation string required Password confirmation (must match password). Example: Password123!
     * @bodyParam type string required User type. Must be either "freelancer" or "client". Example: freelancer
     * @bodyParam other_links array sometimes Array of other freelance platform URLs (max 3 links, optional). Example: ["https://upwork.com/freelancers/ahmed"]
     * @bodyParam other_links.* string URL format for each freelance platform link. Example: https://upwork.com/freelancers/ahmed
     * @bodyParam portfolio_link string required_if:type,freelancer Portfolio website URL (required for freelancers). Example: https://ahmed-portfolio.com
     * 
     * @response 200 scenario="All fields are valid" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success"
     * }
     *
     * @response 400 scenario="Email already exists" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email has already been taken."
     * }
     *
     * @response 400 scenario="Invalid name format" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The name format is invalid."
     * }
     *
     * @response 400 scenario="Password too weak" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character."
     * }
     *
     * @response 400 scenario="Password confirmation mismatch" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The password confirmation does not match."
     * }
     *
     * @response 400 scenario="Invalid user type" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected type is invalid."
     * }
     *
     * @response 400 scenario="Portfolio link missing for freelancer" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The portfolio link field is required when type is freelancer."
     * }
     *
     * @response 400 scenario="Too many other links" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The other links may not have more than 3 items."
     * }
     *
     * @response 400 scenario="Invalid URL format" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The other_links.0 format is invalid."
     * }
     */
    public function checkRegisterFields(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => [
                'required',
                'max:255',
                'regex:/^(?:[ء-ي]+(?:\s[ء-ي]+)*)$|^(?:[a-zA-Z]+(?:\s[a-zA-Z]+)*)$/u'
            ],
            'email'         => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users',
                new EmailRule,
            ],
            'password'       => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$٪\^&\*\)\(ـ\+])[A-Za-z\d!@#\$٪\^&\*\)\(ـ\+]{8,}$/u',
            'type'           => 'required|string|in:freelancer,client',
            'other_links'    => 'nullable|array|max:3',
            'other_links.*'  => 'url',
            'portfolio_link' => 'required_if:type,freelancer|url',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);


        return Response::api(__('message.success'), 200, true, null);
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
     * @bodyParam other_links array required_if:type,freelancer Array of other freelance platform URLs (1-3 links, required for freelancers). Example: ["https://upwork.com/freelancers/ahmed"]
     * @bodyParam other_links.* string URL format for each freelance platform link. Example: https://upwork.com/freelancers/ahmed
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
     * @response 400 scenario="Email in invitation list" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email is already in the invitation list."
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
            'name'           => $request->name,
            'username'       => $request->username,
            'email'          => $request->email,
            'password'       => $request->password,
            'type'           => $request->type,
            'other_links'    => $request->other_links ?? [],
            'portfolio_link' => $request->portfolio_link,
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
     * 
     * **Approval Status Logic:**
     * - **Clients**: Always approved immediately and ready to use
     * - **Freelancers with invitation**: If the email has a pending invitation from admin, the freelancer will be approved immediately without admin review
     * - **Regular freelancers**: Account created with "requested" approval status and requires admin approval
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
     *       "other_links": ["https://upwork.com/freelancers/johndoe"],
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
     * @response 200 scenario="Invited freelancer registration completed (pre-approved)" {
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
     *       "approval_status": "approved",
     *       "other_links": ["https://upwork.com/freelancers/johndoe"],
     *       "portfolio_link": "https://johndoe.com",
     *       "headline": null,
     *       "description": null,
     *       "created_at": "2025-08-24T10:30:00.000000Z",
     *       "updated_at": "2025-08-24T10:30:00.000000Z"
     *     },
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
     *   }
     * }
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
     * @bodyParam new_email string required The new email address (must be unique in both users and invitations, and valid). Example: newemail@example.com
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
     * @response 400 scenario="New email in invitation list" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The new email is already in the invitation list."
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
        $result = $this->authUserService->login($request->email, $request->password);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        if ($result['data']['user']['type'] == 'freelancer')
            return Response::api($result['message'], 200, true, null, [
                'user'  => BaseResource::make(FreelancerResource::make($result['data']['user'])),
                'token' => $result['data']['token'],
            ]);

        return Response::api($result['message'], 200, true, null, [
            'user'  => BaseResource::make(ClientResource::make($result['data']['user'])),
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
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->authUserService->forgetPassword($request->email);

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
     *
     * @response 200 scenario="Client token refreshed" {
     *    "status": true,
     *    "error_num": null,
     *    "message": "Token Refreshed Successfully",
     *    "data": {
     *        "user": {
     *            "id": 2,
     *            "name": "Ahmed test",
     *            "email": "freelancer2@gmail.com",
     *            "email_verified_at": "2025-09-11T11:33:20.000000Z",
     *            "phone": "+966501234567",
     *            "country_code": null,
     *            "phone_number": null,
     *            "type": "client",
     *            "is_active": true,
     *            "about_me": "Professional Full Stack Developer",
     *            "profile_picture": "storage/profiles/68d28083a3dd1.PNG",
     *            "company": "شركة التقنيات المتقدمة",
     *            "country": "asd",
     *            "city": "asd",
     *            "is_verified": false,
     *            "user_verification_status": "approved",
     *            "created_at": "2025-09-03T11:34:36.000000Z",
     *            "updated_at": "2025-09-23T11:12:03.000000Z",
     *            "rate": 0,
     *            "languages": null,
     *            "reviews": null
     *        },
     *        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvcmVmcmVzaCIsImlhdCI6MTc2MDg2OTYwOCwiZXhwIjoxNzYwODczMjMzLCJuYmYiOjE3NjA4Njk2MzMsImp0aSI6ImZmM2s5ZDJaS1Rmams4SDUiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Yhn36E5bG42bkrahNv8cOoQqpSyqHV-UHL_QB7GyfRE"
     *    }
     * }
     * 
     * @response 200 scenario="Freelancer token refreshed" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Token Refreshed Successfully",
     *   "data": {
     *       "user": {
     *           "id": 3,
     *           "name": "Ahmed test",
     *           "email": "freelancer3@gmail.com",
     *           "type": "freelancer",
     *           "email_verified_at": "2025-09-21T09:56:16.000000Z",
     *           "phone": "1234567893",
     *           "is_active": true,
     *           "about_me": "Experienced freelancer with skills in various domains.",
     *           "profile_picture": "storage/profiles/68d27bc809cf4.png",
     *           "approval_status": "approved",
     *           "country": null,
     *           "city": null,
     *           "other_links": [],
     *           "portfolio_link": "https://portfolio.freelancer3.com",
     *           "headline": "Professional Freelancer",
     *           "is_verified": false,
     *           "user_verification_status": null,
     *           "rate": 4.67,
     *           "created_at": "2025-09-03T11:34:37.000000Z",
     *           "updated_at": "2025-09-23T10:51:52.000000Z",
     *           "category": {
     *               "id": 4,
     *               "name": "Design",
     *               "image": "storage/categories/68dd364f26e71.svg",
     *               "parent_id": null,
     *               "created_at": "2025-09-07T08:44:46.000000Z",
     *               "updated_at": "2025-10-01T14:10:23.000000Z"
     *           },
     *           "languages": null,
     *           "reviews": [
     *               {
     *                   "id": 3,
     *                   "user_id": 2,
     *                   "rating": 5,
     *                   "comment": "Excellent freelancer! Very professional and delivered high-quality work on time. Great communication skills and attention to detail. Highly recommended for WordPress development projects.",
     *                   "user": {
     *                       "id": 2,
     *                       "name": "Ahmed test",
     *                       "email": "freelancer2@gmail.com",
     *                       "email_verified_at": "2025-09-11T11:33:20.000000Z",
     *                       "phone": "+966501234567",
     *                       "country_code": null,
     *                       "phone_number": null,
     *                       "type": "client",
     *                       "is_active": true,
     *                       "about_me": "Professional Full Stack Developer",
     *                       "profile_picture": "storage/profiles/68d28083a3dd1.PNG",
     *                       "company": "شركة التقنيات المتقدمة",
     *                       "country": "asd",
     *                       "city": "asd",
     *                       "is_verified": false,
     *                       "user_verification_status": "approved",
     *                       "created_at": "2025-09-03T11:34:36.000000Z",
     *                       "updated_at": "2025-09-23T11:12:03.000000Z",
     *                       "rate": 0,
     *                       "languages": null,
     *                       "reviews": null
     *                   },
     *                   "created_at": "2025-10-05T12:47:53.000000Z",
     *                   "updated_at": "2025-10-05T12:47:53.000000Z"
     *               },
     *               {
     *                   "id": 4,
     *                   "user_id": 4,
     *                   "rating": 4,
     *                   "comment": "Good work overall. The project was completed within the deadline and met most of our requirements. Would work with this freelancer again.",
     *                   "user": {
     *                       "id": 4,
     *                       "name": "Freelancer4",
     *                       "email": "freelancer4@example.com",
     *                       "email_verified_at": null,
     *                       "phone": "1234567894",
     *                       "country_code": null,
     *                       "phone_number": null,
     *                       "type": "freelancer",
     *                       "is_active": true,
     *                       "about_me": "Experienced freelancer with skills in various domains.",
     *                       "profile_picture": null,
     *                       "company": null,
     *                       "country": null,
     *                       "city": null,
     *                       "is_verified": false,
     *                       "user_verification_status": null,
     *                       "created_at": "2025-09-03T11:34:37.000000Z",
     *                       "updated_at": "2025-09-03T11:34:37.000000Z",
     *                       "rate": 0,
     *                       "languages": null,
     *                       "reviews": null
     *                   },
     *                   "created_at": "2025-10-05T12:48:33.000000Z",
     *                   "updated_at": "2025-10-05T12:48:33.000000Z"
     *               },
     *               {
     *                   "id": 5,
     *                   "user_id": 7,
     *                   "rating": 5,
     *                   "comment": "Outstanding developer! Exceeded expectations with creative solutions and clean code. Fast delivery and excellent communication throughout the project.",
     *                   "user": {
     *                       "id": 7,
     *                       "name": "Freelancer7",
     *                       "email": "freelancer7@example.com",
     *                       "email_verified_at": null,
     *                       "phone": "1234567897",
     *                       "country_code": null,
     *                       "phone_number": null,
     *                       "type": "freelancer",
     *                       "is_active": true,
     *                       "about_me": "Experienced freelancer with skills in various domains.",
     *                       "profile_picture": null,
     *                       "company": null,
     *                       "country": null,
     *                       "city": null,
     *                       "is_verified": false,
     *                       "user_verification_status": null,
     *                       "created_at": "2025-09-03T11:34:38.000000Z",
     *                       "updated_at": "2025-09-03T11:34:38.000000Z",
     *                       "rate": 0,
     *                       "languages": null,
     *                       "reviews": null
     *                   },
     *                   "created_at": "2025-10-05T12:48:33.000000Z",
     *                   "updated_at": "2025-10-05T12:48:33.000000Z"
     *               }
     *           ]
     *       },
     *       "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvcmVmcmVzaCIsImlhdCI6MTc2MDg2OTc4MywiZXhwIjoxNzYwODczMzk5LCJuYmYiOjE3NjA4Njk3OTksImp0aSI6IjRIdXlldnY2UjZCZXpSWHIiLCJzdWIiOiIzIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.akONhVkZTCjGyFVdEuF4QjI-uybIVlSkc84-H18oNJs"
     *   }
     * }
     */
    public function refresh()
    {
        // TODO: change response structure to the old one with only token in data

        $result = $this->authUserService->refreshToken();

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        if ($result['data']['user']['type'] == 'freelancer')
            return Response::api($result['message'], 200, true, null, [
                'user'  => BaseResource::make(FreelancerResource::make($result['data']['user'])),
                'token' => $result['data']['token'],
            ]);

        return Response::api($result['message'], 200, true, null, [
            'user'  => BaseResource::make(ClientResource::make($result['data']['user'])),
            'token' => $result['data']['token'],
        ]);
    }

    /**
     * Update User Profile.
     * 
     * This endpoint allows authenticated users to update their profile information.
     * The endpoint supports both freelancers and clients with different validation rules based on user type.
     * Uses request filtering to only accept valid fields for each user type.
     * 
     * **For Freelancers:**
     * - Allowed fields: name, profile_picture, about_me, country, city, languages, headline, category_id, skill_ids
     * - Optional fields: name, profile_picture, about_me, country, city, languages, headline, category_id, skill_ids
     * - Prohibited fields: company, phone
     * 
     * **For Clients:**
     * - Allowed fields: name, profile_picture, about_me, country, city, languages, company, phone
     * - Optional fields: name, profile_picture, about_me, country, city, languages, company, phone
     * - Prohibited fields: headline, category_id, skill_ids
     * 
     * @authenticated
     * 
     * @bodyParam name string sometimes User's full name (Arabic or English characters only). Example: أحمد محمد
     * @bodyParam profile_picture file sometimes Profile picture image file (max 2MB). Example: No-example
     * @bodyParam about_me string sometimes About me description (max 500 characters, optional). Example: مطور ويب محترف مع خبرة 5 سنوات
     * @bodyParam country string sometimes User country (max 100 characters, optional). Example: Saudi Arabia
     * @bodyParam city string sometimes User city (max 100 characters, optional). Example: Riyadh
     * @bodyParam languages array sometimes Array of user languages (optional). Example: [{"language_id": 1, "language_level": "native"}, {"language_id": 2, "language_level": "advanced"}]
     * @bodyParam languages.*.language_id integer Language ID (must exist in languages table). Example: 1
     * @bodyParam languages.*.language_level string Language proficiency level (basic, intermediate, advanced, native). Example: advanced
     * @bodyParam headline string sometimes Professional headline (for freelancers only, optional). Example: Full Stack Developer
     * @bodyParam category_id integer sometimes Main category ID (for freelancers only, optional, must exist in categories). Example: 1
     * @bodyParam skill_ids array sometimes Array of skill IDs (for freelancers only, optional). Example: [1, 2, 3]
     * @bodyParam skill_ids.* integer Each skill ID must exist in skills table. Example: 1
     * @bodyParam company string sometimes Company name (for clients only, optional, max 255 characters). Example: Tech Solutions Inc
     * @bodyParam phone string sometimes Phone number in Saudi format (for clients only, optional). Example: +966501234567
     * 
     * @response 200 scenario="Freelancer profile updated" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Profile updated successfully",
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
     *     "other_links": ["https://upwork.com/freelancers/ahmed"],
     *     "portfolio_link": "https://ahmed-portfolio.com",
     *     "headline": "Full Stack Developer",
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
     * @response 200 scenario="Client profile updated" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Profile updated successfully",
     *   "data": {
     *     "id": 2,
     *     "name": "Jane Smith",
     *     "email": "jane@example.com",
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "phone": "+966501234567",
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
     * @response 400 scenario="Freelancer not approved" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "You are not an approved freelancer"
     * }
     *
     * @response 400 scenario="Invalid category" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "This category is not a parent category"
     * }
     *
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     *
     * @response 400 scenario="Validation error - Name format" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The name format is invalid."
     * }
     *
     * @response 400 scenario="Validation error - Prohibited field" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The company field is prohibited."
     * }
     *
     * @response 400 scenario="Validation error - File too large" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The profile picture may not be greater than 2048 kilobytes."
     * }
     *
     * @response 400 scenario="Validation error - Invalid skill" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected skill_ids.0 is invalid."
     * }
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $result = $this->authUserService->updateProfile($request->only([
            'name',
            'profile_picture',
            'about_me',
            'headline',
            'category_id',
            'skill_ids',
            'company',
            'phone',
            'country_code',
            'phone_number',
            'country',
            'city',
            'languages',
        ]));


        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        $user = $result['data'];

        $resource = $user->type == UserType::FREELANCER->value
            ? FreelancerResource::make($user)
            : ClientResource::make($user);

        return Response::api($result['message'], 200, true, null, $resource);
    }

    /**
     * Change User Password.
     * 
     * This endpoint allows authenticated users to change their password by providing their current password
     * and a new password. The current password must be verified before the new password is set.
     * This is a secure way for users to update their passwords while logged in.
     * 
     * @authenticated
     * 
     * @bodyParam current_password string required User's current password for verification. Example: CurrentPassword123!
     * @bodyParam new_password string required New password (min 8 chars, must contain uppercase, lowercase, number, and special character). Example: NewPassword123!
     * @bodyParam new_password_confirmation string required Password confirmation (must match new_password). Example: NewPassword123!
     * 
     * @response 200 scenario="Password changed successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Password changed successfully"
     * }
     *
     * @response 400 scenario="Current password incorrect" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Current password is incorrect"
     * }
     *
     * @response 400 scenario="Password change failed" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Failed to change password. Please try again."
     * }
     *
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     *
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The current_password field is required."
     * }
     *
     * @response 400 scenario="Password confirmation mismatch" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The new_password confirmation does not match."
     * }
     *
     * @response 400 scenario="Password too weak" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The new_password must contain at least one uppercase letter, one lowercase letter, one number, and one special character."
     * }
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $result = $this->authUserService->changePassword($request->current_password, $request->new_password);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true);
    }

    /**
     * Change Email Address.
     * 
     * This endpoint allows authenticated users to change their email address by providing a new email 
     * and confirming their current password. A verification code will be sent to the new email address 
     * for verification. The user must then use the verifyChangeEmail endpoint to complete the email change.
     * **Rate Limiting:** This endpoint is limited to 3 attempts per week per user to prevent abuse.
     * 
     * @authenticated
     * 
     * @bodyParam email string required The new email address (must be unique and valid). Example: newemail@example.com
     * @bodyParam email_confirmation string required Email confirmation (must match email). Example: newemail@example.com
     * @bodyParam password string required Current password confirmation (min 8 chars, must contain uppercase, lowercase, number, and special character). Example: CurrentPassword123!
     *
     * @response 200 scenario="Email change initiated successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Verification code sent to new email address"
     * }
     *
     * @response 400 scenario="Current password incorrect" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Current password is incorrect"
     * }
     *
     * @response 400 scenario="New email already exists" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email has already been taken."
     * }
     *
     * @response 400 scenario="New email in invitation list" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email is already in the invitation list."
     * }
     *
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     *
     * @response 400 scenario="Validation error - Password confirmation mismatch" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The password confirmation does not match."
     * }
     *
     * @response 400 scenario="Validation error - Invalid email format" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email must be a valid email address."
     * }
     *
     * @response 400 scenario="Validation error - Missing fields" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email field is required."
     * }
     */
    public function changeEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:users,email',
                'unique:invitation_users,email',
                'confirmed',
                new EmailRule
            ],
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->authUserService->changeEmail($request->email, $request->password);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true, null);
    }

    /**
     * Verify Email Change.
     * 
     * This endpoint verifies the OTP code sent to the new email address during the email change process.
     * Users must first initiate an email change using the changeEmail endpoint, then use this endpoint
     * to verify the new email address with the 4-digit OTP code sent to the new email.
     * 
     * @authenticated
     * 
     * @bodyParam email string required The new email address to verify (must be the same email used in changeEmail). Example: newemail@example.com
     * @bodyParam otp string required The 4-digit verification code sent to the new email address. Example: 1234
     * 
     * @response 200 scenario="Email change verified successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Email changed successfully"
     * }
     *
     * @response 400 scenario="Invalid or expired OTP" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Invalid or expired verification code"
     * }
     *
     * @response 400 scenario="Email change session expired" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Email change session expired or not found"
     * }
     *
     * @response 400 scenario="Email verification not initiated" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "No email change request found for this email"
     * }
     *
     * @response 401 scenario="Unauthenticated" {
     * "status"   : false,
     * "error_num": 401,
     * "message"  : "Unauthenticated"
     * }
     *
     * @response 400 scenario="Validation error - Invalid email format" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email must be a valid email address."
     * }
     *
     * @response 400 scenario="Validation error - Invalid OTP format" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The otp must be 4 digits."
     * }
     *
     * @response 400 scenario="Validation error - Missing fields" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email field is required."
     * }
     */

    public function verifyChangeEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email:rfc,dns',
                new EmailRule
            ],
            'otp'   => 'required|digits:4',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->authUserService->verifyChangeEmail($request->email, $request->otp);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true, null, ['email' => $result['email']]);
    }
}
