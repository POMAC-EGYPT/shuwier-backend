<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\BaseResource;
use App\Models\Admin;
use App\Models\User;
use App\Services\Contracts\Auth\AuthAdminServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
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
}
