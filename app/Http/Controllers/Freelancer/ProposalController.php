<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Freelancer\Proposal\ProposalSearchRequest;
use App\Http\Requests\Freelancer\Proposal\StoreProposalRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ProposalResource;
use App\Services\Contracts\ProposalServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProposalController extends Controller
{
    protected $proposalService;

    public function __construct(ProposalServiceInterface $proposalService)
    {
        $this->proposalService = $proposalService;
    }

    /**
     * List freelancer proposals
     * 
     * Retrieve a paginated list of proposals submitted by the authenticated freelancer.
     * This endpoint allows freelancers to view and filter their submitted proposals
     * with search functionality and status filtering. Results include complete proposal
     * details with associated project information, status updates, and client responses.
     * 
     * @authenticated
     * @group Freelancer Proposals
     * 
     * @queryParam status array optional Filter proposals by status. Available values: submitted, viewed, accepted, rejected, withdrawn. Example: ["viewed","accepted"]
     * @queryParam search string optional Search proposals by project title, cover letter content, or project description keywords. Example: website development
     * @queryParam per_page integer optional Number of proposals per page (default: 16, minimum: 1, maximum: 50). Example: 10
     * 
     * @response 200 scenario="Proposals retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Proposals retrieved successfully",
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 15,
     *         "cover_letter": "I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I've built similar platforms with payment integration and can deliver this project within your timeline.",
     *         "estimated_time_unit": "days",
     *         "estimated_time": 14,
     *         "fees_type": "fixed",
     *         "bid_amount": "1500.00",
     *         "status": "pending",
     *         "created_at": "2025-10-07T10:30:00.000000Z",
     *         "updated_at": "2025-10-07T10:30:00.000000Z",
     *         "project": {
     *           "id": 5,
     *           "title": "E-commerce Website Development",
     *           "description": "I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard.",
     *           "budget": "$1000-$2000",
     *           "deadline_unit": "days",
     *           "deadline": "12",
     *           "status": "active",
     *           "proposals_count": 8,
     *           "category": {
     *             "id": 4,
     *             "name": "Programming"
     *           },
     *           "user": {
     *             "id": 2,
     *             "name": "Ahmed Test",
     *             "company": "Tech Solutions Ltd",
     *             "profile_picture": "storage/profiles/68d28083a3dd1.PNG",
     *             "is_verified": true
     *           }
     *         },
     *         "attachments": [
     *           {
     *             "id": 2,
     *             "file_path": "storage/proposals/68e3876bcc657.PDF",
     *             "file_name": "portfolio_sample.pdf",
     *             "created_at": "2025-10-07T10:29:45.000000Z"
     *           }
     *         ],
     *         "response_received": false,
     *         "days_since_submission": 2,
     *         "competition_level": "medium"
     *       },
     *       {
     *         "id": 12,
     *         "cover_letter": "I'm a UI/UX designer with expertise in mobile app design. I can create a modern, user-friendly interface that will enhance user experience.",
     *         "estimated_time_unit": "days",
     *         "estimated_time": 7,
     *         "fees_type": "fixed",
     *         "bid_amount": "750.00",
     *         "status": "accepted",
     *         "created_at": "2025-10-05T14:20:00.000000Z",
     *         "updated_at": "2025-10-06T16:45:00.000000Z",
     *         "project": {
     *           "id": 3,
     *           "title": "Mobile App UI/UX Design",
     *           "description": "Looking for a talented designer to create modern and user-friendly UI/UX design for a mobile application.",
     *           "budget": "$500-$800",
     *           "deadline_unit": "days",
     *           "deadline": "7",
     *           "status": "in_progress",
     *           "proposals_count": 5,
     *           "category": {
     *             "id": 2,
     *             "name": "Design & Creative"
     *           },
     *           "user": {
     *             "id": 8,
     *             "name": "Sarah Johnson",
     *             "company": "FitTech Solutions",
     *             "profile_picture": "storage/profiles/68d28083a3dd2.PNG",
     *             "is_verified": true
     *           }
     *         },
     *         "attachments": [],
     *         "response_received": true,
     *         "days_since_submission": 5,
     *         "competition_level": "low"
     *       }
     *     ],
     *     "first_page_url": "http://localhost/api/freelancers/proposals?page=1",
     *     "from": 1,
     *     "last_page": 3,
     *     "last_page_url": "http://localhost/api/freelancers/proposals?page=3",
     *     "links": [
     *       {
     *         "url": null,
     *         "label": "&laquo; Previous",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/freelancers/proposals?page=1",
     *         "label": "1",
     *         "active": true
     *       },
     *       {
     *         "url": "http://localhost/api/freelancers/proposals?page=2",
     *         "label": "2",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/freelancers/proposals?page=2",
     *         "label": "Next &raquo;",
     *         "active": false
     *       }
     *     ],
     *     "next_page_url": "http://localhost/api/freelancers/proposals?page=2",
     *     "path": "http://localhost/api/freelancers/proposals",
     *     "per_page": 16,
     *     "prev_page_url": null,
     *     "to": 16,
     *     "total": 42
     *   }
     * }
     * 
     * @response 200 scenario="No proposals found" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "No proposals found",
     *   "data": {
     *     "current_page": 1,
     *     "data": [],
     *     "first_page_url": "http://localhost/api/freelancers/proposals?page=1",
     *     "from": null,
     *     "last_page": 1,
     *     "last_page_url": "http://localhost/api/freelancers/proposals?page=1",
     *     "links": [
     *       {
     *         "url": null,
     *         "label": "&laquo; Previous",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/freelancers/proposals?page=1",
     *         "label": "1",
     *         "active": true
     *       },
     *       {
     *         "url": null,
     *         "label": "Next &raquo;",
     *         "active": false
     *       }
     *     ],
     *     "next_page_url": null,
     *     "path": "http://localhost/api/freelancers/proposals",
     *     "per_page": 16,
     *     "prev_page_url": null,
     *     "to": null,
     *     "total": 0
     *   }
     * }
     * 
     * @response 400 scenario="Invalid status filter" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected status is invalid."
     * }
     * 
     * @response 400 scenario="Invalid per_page parameter" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The per page field must be between 1 and 50."
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 403 scenario="Not a freelancer" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Access denied. Freelancer role required."
     * }
     * 
     * @response 403 scenario="Freelancer not approved" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Your freelancer account is not approved yet."
     * }
     */
    public function index(ProposalSearchRequest $request)
    {
        $result = $this->proposalService->getAllByFreelancerIdPaginated(
            auth('api')->id(),
            $request->status,
            $request->search,
            $request->per_page ?? 16

        );

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(ProposalResource::collection($result['data']))
        );
    }

    /**
     * Store Proposal
     * 
     * Submit a proposal for a specific project. This endpoint allows authenticated freelancers
     * to submit their bid and proposal details for client projects. The proposal includes
     * cover letter, estimated time, bid amount, and optional attachments. Freelancers can
     * only submit one proposal per project, and the project must be accepting proposals.
     * 
     * @authenticated
     * @group Freelancer Proposals
     * 
     * @bodyParam cover_letter string required Detailed cover letter explaining your approach, experience, and why you're the best fit for this project. Example: I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I've built similar platforms with payment integration and can deliver this project within your timeline.
     * @bodyParam estimated_time_unit string required Time unit for delivery estimate. Must be one of: hours, days, weeks, months. Example: days
     * @bodyParam estimated_time integer required Number of time units needed to complete the project. Example: 14
     * @bodyParam fees_type string required Type of pricing structure. Must be one of: fixed, hourly. Example: fixed
     * @bodyParam bid_amount numeric required Your bid amount for the project in USD. Must be a positive number. Example: 1500.00
     * @bodyParam project_id integer required ID of the project you're submitting a proposal for. Must be an active project accepting proposals. Example: 5
     * @bodyParam attachment_ids integer[] optional Array of attachment IDs to include with your proposal (portfolio samples, certificates, etc.). Files must be uploaded first using upload endpoint. Example: [2, 3, 4]
     * 
     * @response 200 scenario="Proposal submitted successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Proposal submitted successfully",
     *   "data": {
     *     "id": 15,
     *     "cover_letter": "I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I've built similar platforms with payment integration and can deliver this project within your timeline. My portfolio includes 12+ successful e-commerce projects.",
     *     "estimated_time_unit": "days",
     *     "estimated_time": 14,
     *     "fees_type": "fixed",
     *     "bid_amount": "1500.00",
     *     "status": "submitted",
     *     "created_at": "2025-10-07T10:30:00.000000Z",
     *     "updated_at": "2025-10-07T10:30:00.000000Z",
     *     "project": {
     *       "id": 5,
     *       "title": "E-commerce Website Development",
     *       "budget": "$1000-$2000",
     *       "deadline_unit": "days",
     *       "deadline": "12",
     *       "status": "active",
     *       "category": {
     *         "id": 4,
     *         "name": "Programming"
     *       }
     *     },
     *     "user": {
     *       "id": 7,
     *       "name": "Mohammad Ali",
     *       "profile_picture": "storage/profiles/68d28083a3dd3.PNG",
     *       "rating": 4.8,
     *       "completed_projects": 23,
     *       "location": "Cairo, Egypt"
     *     },
     *     "attachments": [
     *       {
     *         "id": 2,
     *         "file_path": "storage/proposals/68e3876bcc657.PDF",
     *         "file_name": "portfolio_sample.pdf",
     *         "user_id": 7,
     *         "proposal_id": 15,
     *         "created_at": "2025-10-07T10:29:45.000000Z",
     *         "updated_at": "2025-10-07T10:30:00.000000Z"
     *       }
     *     ],
     *   }
     * }
     * 
     * @response 400 scenario="Already submitted proposal" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "You have already submitted a proposal for this project"
     * }
     * 
     * @response 400 scenario="Project not accepting proposals" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "This project is no longer accepting proposals"
     * }
     * 
     * @response 400 scenario="Invalid project" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected project id is invalid."
     * }
     * 
     * @response 400 scenario="Own project" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "You cannot submit a proposal for your own project"
     * }
     * 
     * @response 400 scenario="Invalid attachment" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected attachment_ids.0 is invalid."
     * }
     * 
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The cover letter field is required."
     * }
     * 
     * @response 400 scenario="Invalid bid amount" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The bid amount must be a positive number."
     * }
     * 
     * @response 400 scenario="Invalid fees type" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected fees type is invalid."
     * }
     * 
     * @response 400 scenario="Invalid time unit" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected estimated time unit is invalid."
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 403 scenario="Not a freelancer" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Access denied. Freelancer role required."
     * }
     * 
     * @response 403 scenario="Freelancer not approved" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Your freelancer account is not approved yet."
     * }
     */
    public function store(StoreProposalRequest $request)
    {
        $result = $this->proposalService->create([
            'cover_letter' => $request->cover_letter,
            'estimated_time_unit' => $request->estimated_time_unit,
            'estimated_time' => $request->estimated_time,
            'fees_type' => $request->fees_type,
            'bid_amount' => $request->bid_amount,
            'project_id' => $request->project_id,
            'attachment_ids' => $request->attachment_ids,
            'user_id' => auth('api')->id(),
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(ProposalResource::make($result['data']))
        );
    }

    public function show(string $id)
    {
        $result = $this->proposalService->getByIdAndFreelancerId((int) $id, auth('api')->id());

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(ProposalResource::make($result['data']))
        );
    }
}
