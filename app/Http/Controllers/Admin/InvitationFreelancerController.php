<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Rules\EmailRule;
use App\Services\Contracts\InvitationFreelancerServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class InvitationFreelancerController extends Controller
{
    /**
     * @group Admin Freelancer Invitations
     * APIs for managing freelancer invitations.
     */

    protected $invitationService;
    public function __construct(InvitationFreelancerServiceInterface $invitationService)
    {
        $this->invitationService = $invitationService;
    }

    /**
     * Get All Freelancer Invitations
     * 
     * Retrieve a paginated list of all freelancer invitations sent by the admin.
     * 
     * @authenticated
     * @queryParam per_page integer optional Number of items per page. Minimum: 1. Example: 15
     * @response 200 {
     *   "message": "Success",
     *   "status": true,
     *   "error_num": null,
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 1,
     *         "email": "freelancer@example.com",
     *         "expired_at": "2025-09-23T10:00:00.000000Z",
     *         "created_at": "2025-09-16T10:00:00.000000Z",
     *         "updated_at": "2025-09-16T10:00:00.000000Z"
     *       }
     *     ],
     *     "per_page": 10,
     *     "total": 1
     *   }
     * }
     * @response 400 {
     *   "message": "Validation error",
     *   "status": false,
     *   "error_num": 400
     * }
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'per_page' => 'sometimes|integer|min:1'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->invitationService->getAllPaginated($request->per_page ?? null);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make($result['data']));
    }

    /**
     * Send Freelancer Invitation
     * 
     * Send an invitation email to a potential freelancer. The email must be unique and not already registered.
     * 
     * @authenticated
     * @bodyParam email string required A valid email address for the freelancer invitation. Must be unique and not already registered. Example: freelancer@example.com
     * @response 200 {
     *   "message": "Invitation sent successfully",
     *   "status": true,
     *   "error_num": null
     * }
     * @response 400 {
     *   "message": "The email field is required.",
     *   "status": false,
     *   "error_num": 400
     * }
     * @response 400 {
     *   "message": "The email has already been taken.",
     *   "status": false,
     *   "error_num": 400
     * }
     * @response 400 {
     *   "message": "User already registered",
     *   "status": false,
     *   "error_num": 400
     * }
     */
    public function sendInvitation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:invitation_users',
                new EmailRule,
            ],
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        // Logic to send invitation email goes here.
        // This could involve creating a record in the database and sending an email.
        $result = $this->invitationService->sendInvitation($request->email);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }
}
