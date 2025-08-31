<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\BaseResource;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
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
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin)
            return Response::api(__('message.email_not_found'), 404, false, 404);

        if (!Hash::check($request->password, $admin->password))
            return Response::api(__('message.invalid_password'), 400, false, 400);

        $token = JWTAuth::fromUser($admin);

        return Response::api(__('message.login_success'), 200, true, null, [
            'admin' => BaseResource::make(AdminResource::make($admin)),
            'token' => $token,
        ]);
    }
}
