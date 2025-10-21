<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\ProjectResource;
use App\Services\Contracts\ProjectServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectServiceInterface $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Show project details for all users
     * 
     * Retrieve detailed information about a specific project. This endpoint is accessible
     * to all authenticated users (both clients and freelancers) with different access
     * controls based on user type. Freelancers can view projects to submit proposals,
     * while clients can view any project details. The endpoint includes validation
     * for freelancer-specific requirements like account status and verification.
     * 
     * @authenticated
     * @group Public Projects
     * 
     * @urlParam id integer required The ID of the project to retrieve. Example: 5
     * 
     * @response 200 scenario="Project details retrieved successfully" {
     *   "status": true,
     *   "error_num": 200,
     *   "message": "Success",
     *   "data": {
     *     "id": 5,
     *     "title": "E-commerce Website Development",
     *     "description": "I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized with modern design principles.",
     *     "category_id": "4",
     *     "subcategory_id": "5",
     *     "budget": "$1000-$2000",
     *     "deadline_unit": "days",
     *     "deadline": "12",
     *     "status": "active",
     *     "comments_enabled": true,
     *     "proposals_enabled": true,
     *     "submited_proposal_count": 8,
     *     "created_at": "2025-10-06T09:11:11.000000Z",
     *     "updated_at": "2025-10-06T09:11:11.000000Z",
     *     "category": {
     *       "id": 4,
     *       "name": "Programming",
     *       "image": "storage/categories/68dd364f26e71.svg",
     *       "parent_id": null,
     *       "created_at": "2025-09-07T08:44:46.000000Z",
     *       "updated_at": "2025-10-01T14:10:23.000000Z"
     *     },
     *     "subcategory": {
     *       "id": 5,
     *       "name": "Web Development",
     *       "image": null,
     *       "parent_id": 4,
     *       "created_at": "2025-09-07T08:44:46.000000Z",
     *       "updated_at": "2025-09-07T08:44:46.000000Z"
     *     },
     *     "attachments": [
     *       {
     *         "id": 2,
     *         "file_path": "storage/projects/68e3876bcc657.PNG",
     *         "user_id": 2,
     *         "project_id": 5,
     *         "created_at": "2025-10-06T09:10:03.000000Z",
     *         "updated_at": "2025-10-06T09:11:11.000000Z"
     *       },
     *       {
     *         "id": 3,
     *         "file_path": "storage/projects/68e3876bcc658.pdf",
     *         "user_id": 2,
     *         "project_id": 5,
     *         "created_at": "2025-10-06T09:10:05.000000Z",
     *         "updated_at": "2025-10-06T09:11:11.000000Z"
     *       }
     *     ],
     *     "user": {
     *       "id": 2,
     *       "name": "Ahmed Test",
     *       "email": "client@example.com",
     *       "type": "client",
     *       "is_active": true,
     *       "profile_picture": "storage/profiles/68d28083a3dd1.PNG",
     *       "company": "Tech Solutions Ltd",
     *       "country": "Egypt",
     *       "city": "Cairo",
     *       "is_verified": true,
     *       "user_verification_status": "approved",
     *       "created_at": "2025-09-03T11:34:36.000000Z",
     *       "updated_at": "2025-09-23T11:12:03.000000Z"
     *     },
     *     "can_submit_proposal": true,
     *     "time_remaining": "5 days left"
     *   }
     * }
     * 
     * @response 400 scenario="Proposals not enabled for freelancers" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Proposals are not enabled for this project"
     * }
     * 
     * @response 400 scenario="Freelancer account not active" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "User not active"
     * }
     * 
     * @response 400 scenario="Freelancer not verified" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "User not verified"
     * }
     * 
     * @response 404 scenario="Project not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Project not found"
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 400 scenario="Invalid project ID" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Invalid project ID provided"
     * }
     */
    public function show(string $id)
    {
        $result = $this->projectService->getByIdForAllUsers((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            200,
            BaseResource::make(ProjectResource::make($result['data']))
        );
    }
}
