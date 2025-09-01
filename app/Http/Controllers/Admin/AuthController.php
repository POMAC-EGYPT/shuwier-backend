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

class AuthController extends Controller
{
    protected $authAdminService;

    public function __construct(AuthAdminServiceInterface $authAdminService)
    {
        $this->authAdminService = $authAdminService;
    }

    /**
     * Admin Login.
     * @response 200 {
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
     *         ],
     *         "role": "super-admin",
     *       },
     *       "created_at": "2025-08-21T07:43:34.000000Z",
     *       "updated_at": "2025-08-21T07:43:34.000000Z"
     *     },
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
     *   }
     * }
     *
     * @response 404 {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "The Selected email was is invalid."
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Invalid password"
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
