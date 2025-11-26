<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\BaseResource;
use App\Services\Contracts\Auth\AuthAdminServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @group Admin Authentication
 * 
 * APIs for admin authentication and authorization.
 * These endpoints handle admin login and session management.
 */
class AuthController extends Controller
{
    protected $authAdminService;

    public function __construct(AuthAdminServiceInterface $authAdminService)
    {
        $this->authAdminService = $authAdminService;
    }

    /**
     * Admin Login.
     * 
     * This endpoint authenticates administrators and returns a JWT token along with admin permissions.
     * Only users with admin privileges can access this endpoint.
     * 
     * @bodyParam email string required Admin email address. Example: admin@admin.com
     * @bodyParam password string required Admin password. Example: password123
     * 
     * @response 200 scenario="Login successful" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Login successful",
     *   "data": {
     *     "admin": {
     *       "id": 1,
     *       "email": "admin@admin.com",
     *       "permissions_with_role": {
     *         "permissions": [
     *           "admin.users.index",
     *           "admin.users.create",
     *           "admin.users.edit",
     *           "admin.users.delete",
     *           "freelancer.viewAny",
     *           "freelancer.view",
     *           "freelancer.create",
     *           "freelancer.delete",
     *           "freelancer.approveAndReject"
     *         ],
     *         "role": "super-admin"
     *       },
     *       "created_at": "2025-08-21T07:43:34.000000Z",
     *       "updated_at": "2025-08-21T07:43:34.000000Z"
     *     },
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
     *   }
     * }
     *
     * @response 404 scenario="Invalid email" {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "The selected email is invalid."
     * }
     *
     * @response 400 scenario="Invalid password" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Invalid password"
     * }
     *
     * @response 422 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email field is required."
     * }
     */
    public function login(LoginRequest $request)
    {
        $response = $this->authAdminService->login($request->email, $request->password);

        if (!$response['status']) {
            return Response::api($response['message'], $response['error_num'], false, $response['error_num']);
        }

        return Response::api(__('message.login_success'), 200, true, null, [
            'admin' => BaseResource::make(AdminResource::make($response['data']['admin'])),
            'token' => $response['data']['token'],
        ]);
    }

    /**
     * Change Admin Password.
     * 
     * This endpoint allows authenticated administrators to change their current password.
     * The admin must provide their current password for verification before setting a new one.
     * This is a security measure to ensure only the legitimate admin can change the password.
     * 
     * @authenticated
     * 
     * @bodyParam current_password string required The admin's current password for verification. Example: oldpassword123
     * @bodyParam new_password string required The new password to set. Must be at least 8 characters long and contain a mix of letters, numbers, and special characters. Example: newpassword456
     * @bodyParam new_password_confirmation string required Confirmation of the new password. Must match the new_password field. Example: newpassword456
     * 
     * @response 200 scenario="Password changed successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Password changed successfully"
     * }
     *
     * @response 400 scenario="Current password is incorrect" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Current password is incorrect"
     * }
     *
     * @response 400 scenario="New password validation failed" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The new password must be at least 8 characters."
     * }
     *
     * @response 400 scenario="Password confirmation doesn't match" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The new password confirmation does not match."
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
     *   "message": "The current password field is required."
     * }
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:8|confirmed|different:current_password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$٪\^&\*\)\(ـ\+])[A-Za-z\d!@#\$٪\^&\*\)\(ـ\+]{8,}$/u',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->authAdminService->changePassword(
            $request->current_password,
            $request->new_password
        );

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        return Response::api($result['message'], 200, true);
    }
}
