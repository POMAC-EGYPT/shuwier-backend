<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\UserVerificationResource;
use App\Services\Contracts\UserVerificationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserVerificationController extends Controller
{
    /**
     * @group Admin User Verification Management
     * 
     * APIs for managing user verification requests in the admin panel.
     * Allows administrators to view, filter, approve, and reject user verification submissions.
     */
    protected $userVerificationService;
    public function __construct(UserVerificationServiceInterface $userVerificationService)
    {
        $this->userVerificationService = $userVerificationService;
    }

    /**
     * Get User Verification Requests
     * 
     * Retrieve a paginated list of user verification requests with optional status filtering.
     * 
     * @group Admin User Verification
     * 
     * @queryParam status string Filter by verification status. Allowed values: pending, approved. Example: pending
     * @queryParam search string Optional search term to filter requests by user name or email. Example: john
     * 
     * @response 200 {
     *   "message": "User verification requests retrieved successfully",
     *   "status": true,
     *   "error_num": null,
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 1,
     *         "user_id": 1,
     *         "document_one": "path/to/document1.pdf",
     *         "document_two": "path/to/document2.pdf",
     *         "status": "pending",
     *         "created_at": "2025-09-15T10:00:00.000000Z"
     *       }
     *     ],
     *     "per_page": 10,
     *     "total": 1
     *   }
     * }
     * @response 400 {
     *   "message": "Invalid status parameter",
     *   "status": false,
     *   "error_num": 400
     * }
     */
    public function index(Request $request)
    {
        $validator = validator($request->all(), [
            'status' => 'sometimes|nullable|in:pending,approved',
            'search' => 'sometimes|nullable|string',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->userVerificationService->getAllWithFilterPaginated($request->status, 10, $request->search);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);


        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(UserVerificationResource::collection($result['data']))
        );
    }

    /**
     * Accept or Reject User Verification
     * 
     * Approve or reject a user verification request by ID.
     * 
     * @group Admin User Verification
     * @urlParam id integer required The ID of the user verification request. Example: 1
     * @bodyParam action string required The action to perform. Allowed values: approved, rejected. Example: approved
     * @response 200 {
     *   "message": "User verification request updated successfully",
     *   "status": true,
     *   "error_num": null
     * }
     * @response 400 {
     *   "message": "Invalid action parameter",
     *   "status": false,
     *   "error_num": 400
     * }
     * @response 404 {
     *   "message": "not found",
     *   "status": false,
     *   "error_num": 404
     * }
     */
    public function acceptAndReject(Request $request, string $id)
    {
        $validator = validator($request->all(), [
            'action' => 'required|in:approved,rejected',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->userVerificationService->acceptOrReject($id, $request->action);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }
}
