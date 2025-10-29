<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\FreelancerResource;
use App\Services\Contracts\FreelancerServiceInterface;
use App\Traits\AuthorizesAdminActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @group Admin Freelancer Management
 * 
 * APIs for managing freelancers in the admin panel.
 * These endpoints allow administrators to view, create, delete, and manage freelancer accounts,
 * including approving or rejecting freelancer applications.
 */
class FreelancerController extends Controller
{
    use AuthorizesAdminActions;
    protected $freelancerService;

    public function __construct(FreelancerServiceInterface $freelancerService)
    {
        $this->freelancerService = $freelancerService;
    }

    /**
     * Display a listing of freelancers with optional filters.
     * 
     * This endpoint returns a paginated list of all freelancers in the system.
     * Results can be filtered by approval status, active status, and name.
     * The response includes pagination metadata for easy navigation.
     * 
     * @authenticated
     * @queryParam approval_status string Optional filter by approval status. Must be "requested" or "approved". Example: requested
     * @queryParam is_active integer Optional filter by active status. Must be 0 (inactive) or 1 (active). Example: 1
     * @queryParam name string Optional filter by freelancer name (searches in name). Example: أحمد
     * @queryParam page integer Optional page number for pagination (default: 1). Example: 2
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": [
     *     {
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
     *     }
     *   ],
     *   "current_page": 1,
     *   "from": 1,
     *   "last_page": 5,
     *   "per_page": 10,
     *   "to": 10,
     *   "total": 50,
     *   "links": {
     *     "first": "http://localhost/api/admin/freelancers?page=1",
     *     "last": "http://localhost/api/admin/freelancers?page=5",
     *     "prev": null,
     *     "next": "http://localhost/api/admin/freelancers?page=2"
     *   }
     * }
     *
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The approval_status field must be one of: requested, approved."
     * }
     *
     * @response 403 {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this resource"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function index(Request $request)
    {
        $this->checkPermission('freelancer.viewAny');

        $validator = Validator::make($request->all(), [
            'approval_status' => 'nullable|in:requested,approved',
            'is_active'       => 'nullable|in:0,1',
            'name'            => 'nullable|string|max:255'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->freelancerService->list(
            $request->approval_status,
            $request->is_active,
            $request->name,
            10
        );

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(FreelancerResource::collection($result['data']))
        );
    }

    // /**
    //  * Display the specified resource.
    //  */
    /**
     * Display the specified freelancer details.
     * @authenticated
     * @urlParam id integer required The ID of the freelancer to view. Example: 1
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "id": 1,
     *     "name": "John Doe",
     *     "email": "john@example.com",
     *     "type": "freelancer",
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "phone": null,
     *     "is_active": true,
     *     "about_me": null,
     *     "profile_picture": null,
     *     "approval_status": "requested",
     *     "other_links": ["https://upwork.com/freelancers/johndoe"],
     *     "portfolio_link": "https://johndoe.com",
     *     "headline": null,
     *     "description": null,
     *     "created_at": "2025-08-24T10:30:00.000000Z",
     *     "updated_at": "2025-08-24T10:30:00.000000Z"
     *   }
     * }
     *
     * @response 404 {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Freelancer not found"
     * }
     *
     * @response 403 {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this resource"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function show(string $id)
    {
        $this->checkPermission('freelancer.view');

        $result = $this->freelancerService->getFreelancerById((int) $id);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(new FreelancerResource($result['data']))
        );
    }

    /**
     * Update an existing freelancer account.
     * 
     * This endpoint allows admins to update freelancer account information.
     * Only provided fields will be updated, other fields will remain unchanged.
     * 
     * @authenticated
     * @urlParam id integer required The ID of the freelancer to update. Example: 1
     * @bodyParam name string The freelancer's full name. Example: أحمد محمد
     * @bodyParam email string The freelancer's email address (must be unique). Example: ahmed@example.com
     * @bodyParam phone string The freelancer's phone number. Example: +201234567890
     * @bodyParam is_active boolean Whether the freelancer account is active. Example: true
     * @bodyParam about_me string A brief description about the freelancer. Example: خبير في تطوير المواقع
     * @bodyParam profile_picture file The freelancer's profile picture.
     * @bodyParam approval_status string The approval status. Must be "requested" or "approved". Example: approved
     * @bodyParam other_links array An array of other freelance platform URLs. Example: ["https://upwork.com/freelancers/ahmed"]
     * @bodyParam portfolio_link string The freelancer's portfolio website URL. Example: https://ahmed-portfolio.com
     * @bodyParam headline string A short professional headline. Example: Full Stack Developer
     * 
     * @response 200 scenario="Freelancer updated successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Freelancer updated successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "أحمد محمد",
     *     "email": "ahmed@example.com",
     *     "type": "freelancer",
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "phone": "+201234567890",
     *     "is_active": true,
     *     "about_me": "خبير في تطوير المواقع الإلكترونية",
     *     "profile_picture": null,
     *     "approval_status": "approved",
     *     "other_links": ["https://upwork.com/freelancers/ahmed"],
     *     "portfolio_link": "https://ahmed-portfolio.com",
     *     "headline": "Full Stack Developer",
     *     "description": null,
     *     "created_at": "2025-08-24T10:30:00.000000Z",
     *     "updated_at": "2025-09-02T10:30:00.000000Z"
     *   }
     * }
     *
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The email field must be a valid email address."
     * }
     *
     * @response 404 {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Freelancer not found"
     * }
     *
     * @response 403 {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this resource"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Delete a freelancer account permanently.
     * 
     * This endpoint allows admins to permanently delete a freelancer account from the system.
     * This action cannot be undone and will remove all associated data including profile information.
     * Use with caution as this is a destructive operation.
     * 
     * @authenticated
     * @urlParam id integer required The ID of the freelancer to delete. Example: 5
     * 
     * @response 200 scenario="Freelancer deleted successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Freelancer deleted successfully"
     * }
     *
     * @response 404 {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Freelancer not found"
     * }
     *
     * @response 403 {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this resource"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function destroy(string $id)
    {
        $this->checkPermission('freelancer.delete');

        $result = $this->freelancerService->delete((int) $id);

        return Response::api($result['message'], 200, true, null);
    }


    /**
     * Approve or Reject a freelancer application.
     * 
     * This endpoint allows admins to approve or reject freelancer applications.
     * When approving, the freelancer receives an email notification and can start working.
     * When rejecting, the freelancer account is permanently deleted.
     * 
     * @authenticated
     * @urlParam id integer required The ID of the freelancer to approve/reject. Example: 1
     * @bodyParam action string required The action to perform. Must be either "approve" or "reject". Example: approve
     * 
     * @response 200 scenario="Freelancer approved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Freelancer approved successfully",
     *   "data": {
     *     "id": 14,
     *     "name": "احمد حسني",
     *     "email": "abdelrahmanelghonemypomac@gmail.com",
     *     "type": "freelancer",
     *     "email_verified_at": "2025-08-26T09:09:53.000000Z",
     *     "phone": null,
     *     "is_active": true,
     *     "about_me": null,
     *     "profile_picture": null,
     *     "approval_status": "approved",
     *     "other_links": [
     *       "https://www.google.com",
     *       "https://www.google.com"
     *     ],
     *     "portfolio_link": "https://www.facebook.com/ahmedhosni516",
     *     "headline": null,
     *     "description": null,
     *     "created_at": "2025-08-26T09:09:53.000000Z",
     *     "updated_at": "2025-08-27T08:49:50.000000Z"
     *   }
     * }
     *
     * @response 200 scenario="Freelancer rejected successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Freelancer rejected successfully"
     * }
     *
     * @response 400 scenario="Freelancer already approved" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Freelancer already approved"
     * }
     *
     * @response 400 scenario="Invalid action parameter" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The action field is required."
     * }
     *
     * @response 404 {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Freelancer not found"
     * }
     *
     * @response 403 {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this resource"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function approveAndReject(string $id, Request $request)
    {
        $this->checkPermission('freelancer.approveAndReject');

        $validator = Validator::make($request->all(), [
            'action' => 'required|in:approve,reject'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->freelancerService->approveOrReject($id, $request->action);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        if (isset($result['data']))
            return Response::api(
                $result['message'],
                200,
                true,
                null,
                BaseResource::make(FreelancerResource::make($result['data']))
            );

        return Response::api($result['message'], 200, true, null);
    }

    /**
     * Block or Unblock a freelancer account.
     * 
     * This endpoint allows admins to toggle the active status of a freelancer account.
     * When blocked (is_active = false), the freelancer cannot log in or access the platform.
     * When unblocked (is_active = true), the freelancer can resume normal platform activities.
     * This is a reversible action unlike deletion.
     * 
     * @authenticated
     * @urlParam id integer required The ID of the freelancer to block/unblock. Example: 3
     * 
     * @response 200 scenario="Freelancer blocked successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Freelancer blocked successfully"
     * }
     *
     * @response 200 scenario="Freelancer unblocked successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Freelancer unblocked successfully"
     * }
     *
     * @response 404 {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Freelancer not found"
     * }
     *
     * @response 400 scenario="Freelancer not approved yet" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Cannot block/unblock unapproved freelancer"
     * }
     *
     * @response 403 {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this resource"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function blockAndUnblock(string $id)
    {
        $result = $this->freelancerService->blockAndUnblock($id);

        return Response::api($result['message'], 200, true, null);
    }
}
