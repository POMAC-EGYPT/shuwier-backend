<?php

namespace App\Http\Controllers\Admin;

use App\Enum\ApprovalStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\FreelancerResource;
use App\Mail\FreelanceApproveMail;
use App\Models\User;
use App\Traits\AuthorizesAdminActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class FreelancerController extends Controller
{
    use AuthorizesAdminActions;

    /**
     * Display a listing of freelancers with optional filters.
     * @authenticated
     * @queryParam approval_status string Optional filter by approval status (requested, approved). Example: requested
     * @queryParam is_active integer Optional filter by active status (0 or 1). Example: 1
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
     *       "linkedin_link": "https://linkedin.com/in/johndoe",
     *       "twitter_link": "https://twitter.com/johndoe",
     *       "other_freelance_platform_links": ["https://upwork.com/freelancers/johndoe"],
     *       "portfolio_link": "https://johndoe.com",
     *       "is_active": true,
     *       "approval_status": "requested",
     *       "rate": null,
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
            'is_active' => 'nullable|in:0,1'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $freelancers = User::freelancers()
            ->when($request->approval_status, function ($query) use ($request) {
                return $query->where('approval_status', $request->approval_status);
            })->when($request->has('is_active') && $request->is_active != '', function ($query) use ($request) {
                return $query->where('is_active', $request->is_active);
            })->paginate(10);

        return Response::api(
            __('message.success'),
            200,
            true,
            null,
            BaseResource::make(FreelancerResource::collection($freelancers))
        );
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

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
     *     "approval_status": "requested",
     *     "is_active": 1,
     *     "linkedin_link": "https://linkedin.com/in/johndoe",
     *     "twitter_link": "https://twitter.com/johndoe",
     *     "portfolio_link": "https://johndoe.com",
     *     "other_freelance_platform_links": ["https://upwork.com/freelancers/johndoe"],
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
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
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }


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
     *     "linkedin_link": "https://www.linkedin.com/in/muhammed-yousry96?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base%3BXWDAHlI8QB2HsM6PFNaclA%3D%3D",
     *     "twitter_link": "https://www.facebook.com/ahmedhosni516",
     *     "other_freelance_platform_links": [
     *       "https://www.google.com",
     *       "https://www.google.com"
     *     ],
     *     "portfolio_link": "https://www.facebook.com/ahmedhosni516",
     *     "is_active": true,
     *     "approval_status": "approved",
     *     "rate": null,
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

        $freelancer = User::freelancers()->findOrFail($id);

        if ($freelancer->approval_status === ApprovalStatus::APPROVED)
            return Response::api(__('message.freelancer_already_approved'), 400, false);

        if ($request->action == 'reject') {
            $freelancer->delete();
            return Response::api(__('message.freelancer_rejected_success'), 200, true, null);
        } elseif ($request->action === 'approve') {
            $freelancer->approval_status = ApprovalStatus::APPROVED;
            $freelancer->save();

            Mail::to($freelancer->email)->send(new FreelanceApproveMail($freelancer));

            return Response::api(
                __('message.freelancer_approved_success'),
                200,
                true,
                null,
                BaseResource::make(FreelancerResource::make($freelancer))
            );
        }
    }
}
