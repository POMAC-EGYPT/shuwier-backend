<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ProposalResource;
use App\Services\Contracts\ProposalServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProposalController extends Controller
{
    protected $proposalService;

    public function __construct(ProposalServiceInterface $proposalService)
    {
        $this->proposalService = $proposalService;
    }

    /**
     * List project proposals
     * 
     * Retrieve a paginated list of proposals submitted for a specific project owned by the client.
     * This endpoint allows clients to view all proposals received for their projects,
     * helping them evaluate and compare different freelancer offers. Each proposal includes
     * freelancer information, bid details, attachments, and reviews.
     * 
     * @authenticated
     * @group Client Proposal Management
     * 
     * @urlParam projectId integer required The ID of the project to get proposals for. Must be owned by the authenticated client. Example: 5
     * 
     * @response 200 scenario="Proposals retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 1,
     *         "cover_letter": "I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I have built similar platforms with payment integration and can deliver this project within your timeline.",
     *         "estimated_time_unit": "days",
     *         "estimated_time": 14,
     *         "fees_type": "fixed",
     *         "bid_amount": "1500.00",
     *         "status": "pending",
     *         "created_at": "2025-10-07T10:36:03.000000Z",
     *         "updated_at": "2025-10-07T10:37:27.000000Z",
     *         "freelancer": {
     *           "id": 3,
     *           "name": "Ahmed test",
     *           "email": "freelancer3@gmail.com",
     *           "profile_picture": "storage/profiles/68d27bc809cf4.png",
     *           "headline": "Professional Freelancer",
     *           "rate": 4.67,
     *           "approval_status": "approved",
     *           "category": {
     *             "id": 4,
     *             "name": "Design",
     *             "image": "storage/categories/68dd364f26e71.svg"
     *           },
     *           "reviews_count": 3,
     *           "completed_projects": 15
     *         },
     *         "attachments": [
     *           {
     *             "id": 1,
     *             "file_path": "storage/proposals/68e4ed13c9536.PNG",
     *             "created_at": "2025-10-07T10:36:03.000000Z"
     *           }
     *         ]
     *       }
     *     ],
     *     "first_page_url": "http://localhost/api/clients/projects/5/proposals?page=1",
     *     "from": 1,
     *     "last_page": 2,
     *     "last_page_url": "http://localhost/api/clients/projects/5/proposals?page=2",
     *     "links": [
     *       {
     *         "url": null,
     *         "label": "&laquo; Previous",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/clients/projects/5/proposals?page=1",
     *         "label": "1",
     *         "active": true
     *       },
     *       {
     *         "url": "http://localhost/api/clients/projects/5/proposals?page=2",
     *         "label": "2",
     *         "active": false
     *       }
     *     ],
     *     "next_page_url": "http://localhost/api/clients/projects/5/proposals?page=2",
     *     "path": "http://localhost/api/clients/projects/5/proposals",
     *     "per_page": 15,
     *     "prev_page_url": null,
     *     "to": 15,
     *     "total": 28
     *   }
     * }
     * 
     * @response 200 scenario="No proposals found" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "No proposals found for this project",
     *   "data": {
     *     "current_page": 1,
     *     "data": [],
     *     "first_page_url": "http://localhost/api/clients/projects/5/proposals?page=1",
     *     "from": null,
     *     "last_page": 1,
     *     "last_page_url": "http://localhost/api/clients/projects/5/proposals?page=1",
     *     "next_page_url": null,
     *     "path": "http://localhost/api/clients/projects/5/proposals",
     *     "per_page": 15,
     *     "prev_page_url": null,
     *     "to": null,
     *     "total": 0
     *   }
     * }
     * 
     * @response 404 scenario="Project not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Project not found"
     * }
     * 
     * @response 403 scenario="Not project owner" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "You are not authorized to view proposals for this project"
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
     * @response 403 scenario="Not a client" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Access denied. Client role required."
     * }
     */
    public function index(Request $request, int $projectId)
    {
        $validator = Validator::make($request->all(), [
            'per_page' => 'nullable|integer|min:1|max:50'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->proposalService->getByProjectIdPaginated(
            $projectId,
            auth('api')->id(),
            $request->per_page ?? 15
        );

        if (!$result['status']) {
            return Response::api($result['message'], 400, false, 400);
        }

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(ProposalResource::collection($result['data']))
        );
    }

    /**
     * Show proposal details
     * 
     * Retrieve detailed information about a specific proposal submitted to the client's project.
     * This endpoint provides comprehensive proposal details including cover letter, bid amount,
     * freelancer profile with reviews, attachments, and project information. Clients use this
     * to evaluate individual proposals and make hiring decisions.
     * 
     * @authenticated
     * @group Client Proposal Management
     * 
     * @urlParam id integer required The ID of the proposal to retrieve. Must be for a project owned by the authenticated client. Example: 1
     * 
     * @response 200 scenario="Proposal details retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "id": 1,
     *     "cover_letter": "I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I have built similar platforms with payment integration and can deliver this project within your timeline.",
     *     "estimated_time_unit": "days",
     *     "estimated_time": 14,
     *     "fees_type": "fixed",
     *     "bid_amount": "1500.00",
     *     "project_id": 5,
     *     "status": "viewed",
     *     "created_at": "2025-10-07T10:36:03.000000Z",
     *     "updated_at": "2025-10-07T10:37:27.000000Z",
     *     "project": {
     *       "id": 5,
     *       "title": "E-commerce Website Development",
     *       "description": "I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized.",
     *       "category_id": 4,
     *       "subcategory_id": 5,
     *       "budget": "$1000-$2000",
     *       "deadline_unit": "days",
     *       "deadline": 12,
     *       "status": "active",
     *       "comments_enabled": true,
     *       "proposals_enabled": true,
     *       "submited_proposal_count": 8,
     *       "created_at": "2025-10-06T09:11:11.000000Z",
     *       "updated_at": "2025-10-06T09:11:11.000000Z"
     *     },
     *     "attachments": [
     *       {
     *         "id": 1,
     *         "file_path": "storage/proposals/68e4ed13c9536.PNG",
     *         "user_id": 3,
     *         "proposal_id": 1,
     *         "created_at": "2025-10-07T10:36:03.000000Z",
     *         "updated_at": "2025-10-07T10:37:27.000000Z"
     *       },
     *       {
     *         "id": 2,
     *         "file_path": "storage/proposals/68e4ed166e064.PNG",
     *         "user_id": 3,
     *         "proposal_id": 1,
     *         "created_at": "2025-10-07T10:36:06.000000Z",
     *         "updated_at": "2025-10-07T10:37:27.000000Z"
     *       }
     *     ],
     *     "user": {
     *       "id": 3,
     *       "name": "Ahmed test",
     *       "email": "freelancer3@gmail.com",
     *       "type": "freelancer",
     *       "email_verified_at": "2025-09-21T09:56:16.000000Z",
     *       "phone": "1234567893",
     *       "is_active": true,
     *       "about_me": "Experienced freelancer with skills in various domains.",
     *       "profile_picture": "storage/profiles/68d27bc809cf4.png",
     *       "approval_status": "approved",
     *       "country": null,
     *       "city": null,
     *       "linkedin_link": "https://linkedin.com/in/freelancer3",
     *       "twitter_link": null,
     *       "other_freelance_platform_links": [],
     *       "portfolio_link": "https://portfolio.freelancer3.com",
     *       "headline": "Professional Freelancer",
     *       "is_verified": false,
     *       "user_verification_status": null,
     *       "rate": 4.67,
     *       "created_at": "2025-09-03T11:34:37.000000Z",
     *       "updated_at": "2025-09-23T10:51:52.000000Z",
     *       "category": {
     *         "id": 4,
     *         "name": "Design",
     *         "image": "storage/categories/68dd364f26e71.svg",
     *         "parent_id": null,
     *         "created_at": "2025-09-07T08:44:46.000000Z",
     *         "updated_at": "2025-10-01T14:10:23.000000Z"
     *       },
     *       "languages": null,
     *       "reviews": [
     *         {
     *           "id": 3,
     *           "user_id": 2,
     *           "rating": 5,
     *           "comment": "Excellent freelancer! Very professional and delivered high-quality work on time. Great communication skills and attention to detail. Highly recommended for WordPress development projects.",
     *           "user": {
     *             "id": 2,
     *             "name": "Ahmed test",
     *             "email": "freelancer2@gmail.com",
     *             "type": "client",
     *             "profile_picture": "storage/profiles/68d28083a3dd1.PNG",
     *             "company": "شركة التقنيات المتقدمة",
     *             "created_at": "2025-09-03T11:34:36.000000Z"
     *           },
     *           "created_at": "2025-10-05T12:47:53.000000Z",
     *           "updated_at": "2025-10-05T12:47:53.000000Z"
     *         },
     *         {
     *           "id": 4,
     *           "user_id": 4,
     *           "rating": 4,
     *           "comment": "Good work overall. The project was completed within the deadline and met most of our requirements. Would work with this freelancer again.",
     *           "user": {
     *             "id": 4,
     *             "name": "Freelancer4",
     *             "email": "freelancer4@example.com",
     *             "type": "freelancer",
     *             "created_at": "2025-09-03T11:34:37.000000Z"
     *           },
     *           "created_at": "2025-10-05T12:48:33.000000Z",
     *           "updated_at": "2025-10-05T12:48:33.000000Z"
     *         },
     *         {
     *           "id": 5,
     *           "user_id": 7,
     *           "rating": 5,
     *           "comment": "Outstanding developer! Exceeded expectations with creative solutions and clean code. Fast delivery and excellent communication throughout the project.",
     *           "user": {
     *             "id": 7,
     *             "name": "Freelancer7",
     *             "email": "freelancer7@example.com",
     *             "type": "freelancer",
     *             "created_at": "2025-09-03T11:34:38.000000Z"
     *           },
     *           "created_at": "2025-10-05T12:48:33.000000Z",
     *           "updated_at": "2025-10-05T12:48:33.000000Z"
     *         }
     *       ]
     *     }
     *   }
     * }
     * 
     * @response 404 scenario="Proposal not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Proposal not found"
     * }
     * 
     * @response 403 scenario="Not authorized to view proposal" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "You are not authorized to view this proposal"
     * }
     * 
     * @response 400 scenario="Invalid proposal ID" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Invalid proposal ID provided"
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 403 scenario="Not a client" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Access denied. Client role required."
     * }
     */
    public function show(int $id)
    {
        $result = $this->proposalService->getByIdToClient($id, auth('api')->id());

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
