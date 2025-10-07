<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cilent\Project\StoreProjectRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ProjectResource;
use App\Services\Contracts\ProjectServiceInterface;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectServiceInterface $projectService)
    {
        $this->projectService = $projectService;
    }
    /**
     * List client projects
     * 
     * Retrieve a paginated list of projects belonging to the authenticated client.
     * This endpoint allows clients to view and filter their posted projects by status
     * with optional pagination control. Results include complete project details
     * with categories, attachments, and user information.
     * 
     * @authenticated
     * @group Client Project Management
     * 
     * @queryParam status string optional Filter projects by status. Available values: active, in_progress, completed. Example: active
     * @queryParam per_page integer optional Number of projects per page (default: 15, minimum: 1). Example: 10
     * 
     * @response 200 scenario="Projects retrieved successfully" {
     *   "status": true,
     *   "error_num": 200,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 5,
     *         "title": "E-commerce Website Development",
     *         "description": "I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized.",
     *         "category_id": "4",
     *         "subcategory_id": "5",
     *         "budget": "$1000-$2000",
     *         "deadline_unit": "days",
     *         "deadline": "12",
     *         "status": "active",
     *         "comments_enabled": true,
     *         "proposals_enabled": true,
     *         "created_at": "2025-10-06T09:11:11.000000Z",
     *         "updated_at": "2025-10-06T09:11:11.000000Z",
     *         "category": {
     *           "id": 4,
     *           "name": "Design",
     *           "image": "storage/categories/68dd364f26e71.svg",
     *           "parent_id": null,
     *           "created_at": "2025-09-07T08:44:46.000000Z",
     *           "updated_at": "2025-10-01T14:10:23.000000Z"
     *         },
     *         "subcategory": {
     *           "id": 5,
     *           "name": "Web",
     *           "image": null,
     *           "parent_id": 4,
     *           "created_at": "2025-09-07T08:44:46.000000Z",
     *           "updated_at": "2025-09-07T08:44:46.000000Z"
     *         },
     *         "attachments": [
     *           {
     *             "id": 2,
     *             "file_path": "storage/projects/68e3876bcc657.PNG",
     *             "user_id": 2,
     *             "project_id": 5,
     *             "created_at": "2025-10-06T09:10:03.000000Z",
     *             "updated_at": "2025-10-06T09:11:11.000000Z"
     *           }
     *         ],
     *         "user": {
     *           "id": 2,
     *           "name": "Ahmed test",
     *           "email": "freelancer2@gmail.com",
     *           "type": "client",
     *           "is_active": true,
     *           "profile_picture": "storage/profiles/68d28083a3dd1.PNG",
     *           "company": "شركة التقنيات المتقدمة",
     *           "country": "asd",
     *           "city": "asd",
     *           "is_verified": false,
     *           "user_verification_status": "approved",
     *           "created_at": "2025-09-03T11:34:36.000000Z",
     *           "updated_at": "2025-09-23T11:12:03.000000Z"
     *         }
     *       },
     *       {
     *         "id": 3,
     *         "title": "Mobile App UI/UX Design",
     *         "description": "Looking for a talented designer to create modern and user-friendly UI/UX design for a mobile application.",
     *         "category_id": "2",
     *         "subcategory_id": "6",
     *         "budget": "$500-$800",
     *         "deadline_unit": "days",
     *         "deadline": "7",
     *         "status": "in_progress",
     *         "comments_enabled": true,
     *         "proposals_enabled": false,
     *         "created_at": "2025-10-05T14:20:30.000000Z",
     *         "updated_at": "2025-10-06T08:15:45.000000Z",
     *         "category": {
     *           "id": 2,
     *           "name": "Design & Creative",
     *           "image": "storage/categories/68dd364f26e72.svg",
     *           "parent_id": null,
     *           "created_at": "2025-09-07T08:44:46.000000Z",
     *           "updated_at": "2025-10-01T14:10:23.000000Z"
     *         },
     *         "subcategory": {
     *           "id": 6,
     *           "name": "UI/UX Design",
     *           "image": null,
     *           "parent_id": 2,
     *           "created_at": "2025-09-07T08:44:46.000000Z",
     *           "updated_at": "2025-09-07T08:44:46.000000Z"
     *         },
     *       }
     *     ],
     *     "first_page_url": "http://localhost/api/clients/projects?page=1",
     *     "from": 1,
     *     "last_page": 2,
     *     "last_page_url": "http://localhost/api/clients/projects?page=2",
     *     "links": [
     *       {
     *         "url": null,
     *         "label": "&laquo; Previous",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/clients/projects?page=1",
     *         "label": "1",
     *         "active": true
     *       },
     *       {
     *         "url": "http://localhost/api/clients/projects?page=2",
     *         "label": "2",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/clients/projects?page=2",
     *         "label": "Next &raquo;",
     *         "active": false
     *       }
     *     ],
     *     "next_page_url": "http://localhost/api/clients/projects?page=2",
     *     "path": "http://localhost/api/clients/projects",
     *     "per_page": 15,
     *     "prev_page_url": null,
     *     "to": 15,
     *     "total": 23
     *   }
     * }
     * 
     * @response 200 scenario="No projects found" {
     *   "status": true,
     *   "error_num": 200,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [],
     *     "first_page_url": "http://localhost/api/clients/projects?page=1",
     *     "from": null,
     *     "last_page": 1,
     *     "last_page_url": "http://localhost/api/clients/projects?page=1",
     *     "links": [
     *       {
     *         "url": null,
     *         "label": "&laquo; Previous",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/clients/projects?page=1",
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
     *     "path": "http://localhost/api/clients/projects",
     *     "per_page": 15,
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
     *   "message": "The per page field must be at least 1."
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
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|string|in:active,in_progress,completed',
            'per_page' => 'nullable|integer|min:1'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);


        $result = $this->projectService->getByClientId(
            $request->status ?? null,
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
            BaseResource::make(ProjectResource::collection($result['data']))
        );
    }

    /**
     * Create new project
     * 
     * Create a new project posting for clients. This endpoint allows authenticated clients
     * to post new projects with detailed requirements including budget, deadline, 
     * attachments, and category specifications. The project will be visible to freelancers
     * who can then submit proposals.
     * 
     * @authenticated
     * @group Client Project Management
     * 
     * @bodyParam title string required Project title - A clear and descriptive name for your project. Example: E-commerce Website Development
     * @bodyParam description string required Detailed project description - Explain your project requirements, goals, and expectations (minimum characters required). Example: I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized.
     * @bodyParam category_id integer required Main category ID - Must be a valid parent category that matches your project type. Example: 4
     * @bodyParam subcategory_id integer optional Subcategory ID - Must belong to the selected main category for more specific categorization. Example: 5
     * @bodyParam budget string required Project budget - Specify your budget range or fixed amount for this project. Example: $1000-$2000
     * @bodyParam deadline_unit string required Time unit for project deadline - The unit of measurement for your deadline. Must be one of: hours, days, weeks, months. Example: days
     * @bodyParam deadline integer required Project deadline - Number of units (hours/days/weeks/months) for project completion. Example: 12
     * @bodyParam attachment_ids integer[] optional Array of attachment IDs - Files that provide additional project details (must be uploaded first using upload endpoint). Example: [2, 3, 4]
     * 
     * @response 200 scenario="Project created successfully" {
     *   "status": true,
     *   "error_num": 200,
     *   "message": "Project created successfully",
     *   "data": {
     *     "id": 5,
     *     "title": "E-commerce Website Development",
     *     "description": "I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized with modern design and user-friendly interface.",
     *     "category_id": "4",
     *     "subcategory_id": "5",
     *     "budget": "$1000-$2000",
     *     "deadline_unit": "days",
     *     "deadline": "12",
     *     "status": "active",
     *     "comments_enabled": true,
     *     "proposals_enabled": true,
     *     "created_at": "2025-10-06T09:11:11.000000Z",
     *     "updated_at": "2025-10-06T09:11:11.000000Z",
     *     "category": {
     *       "id": 4,
     *       "name": "Design",
     *       "image": "storage/categories/68dd364f26e71.svg",
     *       "parent_id": null,
     *       "created_at": "2025-09-07T08:44:46.000000Z",
     *       "updated_at": "2025-10-01T14:10:23.000000Z"
     *     },
     *     "subcategory": {
     *       "id": 5,
     *       "name": "Web",
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
     *       }
     *     ],
     *     "user": {
     *       "id": 2,
     *       "name": "Ahmed test",
     *       "email": "freelancer2@gmail.com",
     *       "email_verified_at": "2025-09-11T11:33:20.000000Z",
     *       "phone": "+966501234567",
     *       "country_code": null,
     *       "phone_number": null,
     *       "type": "client",
     *       "is_active": true,
     *       "about_me": "Professional Full Stack Developer",
     *       "profile_picture": "storage/profiles/68d28083a3dd1.PNG",
     *       "company": "شركة التقنيات المتقدمة",
     *       "country": "asd",
     *       "city": "asd",
     *       "is_verified": false,
     *       "user_verification_status": "approved",
     *       "created_at": "2025-09-03T11:34:36.000000Z",
     *       "updated_at": "2025-09-23T11:12:03.000000Z",
     *       "rate": 0,
     *       "languages": null,
     *       "reviews": null
     *     }
     *   }
     * }
     * 
     * @response 400 scenario="Invalid category" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected category id is invalid."
     * }
     * 
     * @response 400 scenario="Invalid subcategory" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected subcategory id is invalid."
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
     *   "message": "The title field is required."
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 400 scenario="Invalid deadline unit" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected deadline unit is invalid."
     * }
     */
    public function store(StoreProjectRequest $request)
    {

        $result = $this->projectService->create([
            'title'            => $request->title,
            'description'      => $request->description,
            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'budget'           => $request->budget,
            'deadline_unit'    => $request->deadline_unit,
            'deadline'         => $request->deadline,
            'attachment_ids'   => $request->attachment_ids,
            'user_id'          => auth('api')->id(),
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(ProjectResource::make($result['data']))
        );
    }

    /**
     * Show project details
     * 
     * Retrieve detailed information about a specific project by ID. This endpoint
     * is accessible to both clients (owners) and authenticated freelancers who want
     * to view project details for potential proposals. Returns complete project
     * information including categories, attachments, and client details.
     * 
     * @authenticated
     * @group Client Project Management
     * 
     * @urlParam id integer required Project ID to retrieve. Example: 5
     * 
     * @response 200 scenario="Project retrieved successfully" {
     *   "status": true,
     *   "error_num": 200,
     *   "message": "Success",
     *   "data": {
     *     "id": 5,
     *     "title": "E-commerce Website Development",
     *     "description": "I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized with modern design and user-friendly interface.",
     *     "category_id": "4",
     *     "subcategory_id": "5",
     *     "budget": "$1000-$2000",
     *     "deadline_unit": "days",
     *     "deadline": "12",
     *     "status": "active",
     *     "comments_enabled": true,
     *     "proposals_enabled": true,
     *     "created_at": "2025-10-06T09:11:11.000000Z",
     *     "updated_at": "2025-10-06T09:11:11.000000Z",
     *     "category": {
     *       "id": 4,
     *       "name": "Design",
     *       "image": "storage/categories/68dd364f26e71.svg",
     *       "parent_id": null,
     *       "created_at": "2025-09-07T08:44:46.000000Z",
     *       "updated_at": "2025-10-01T14:10:23.000000Z"
     *     },
     *     "subcategory": {
     *       "id": 5,
     *       "name": "Web",
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
     *         "file_path": "storage/projects/68e3876bcc658.PDF",
     *         "user_id": 2,
     *         "project_id": 5,
     *         "created_at": "2025-10-06T09:10:15.000000Z",
     *         "updated_at": "2025-10-06T09:11:11.000000Z"
     *       }
     *     ],
     *     "user": {
     *       "id": 2,
     *       "name": "Ahmed test",
     *       "email": "freelancer2@gmail.com",
     *       "email_verified_at": "2025-09-11T11:33:20.000000Z",
     *       "phone": "+966501234567",
     *       "country_code": null,
     *       "phone_number": null,
     *       "type": "client",
     *       "is_active": true,
     *       "about_me": "Professional Full Stack Developer",
     *       "profile_picture": "storage/profiles/68d28083a3dd1.PNG",
     *       "company": "شركة التقنيات المتقدمة",
     *       "country": "asd",
     *       "city": "asd",
     *       "is_verified": false,
     *       "user_verification_status": "approved",
     *       "created_at": "2025-09-03T11:34:36.000000Z",
     *       "updated_at": "2025-09-23T11:12:03.000000Z",
     *       "rate": 0,
     *       "languages": null,
     *       "reviews": null
     *     },
     *     "proposals_count": 12,
     *     "average_proposal_amount": "$1200",
     *     "project_visibility": "public"
     *   }
     * }
     * 
     * @response 404 scenario="Project not found" {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Project not found"
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 403 scenario="Access denied to private project" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You do not have permission to view this project"
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
        $result = $this->projectService->findById($id);

        if (!$result['status']) {
            return Response::api($result['message'], 404, false, 404);
        }

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(ProjectResource::make($result['data']))
        );
    }

    /**
     * End project
     * 
     * Mark a project as completed or ended by the client. This endpoint allows
     * the project owner (client) to close their project, stopping any further
     * proposal submissions and marking the project as finished. This action
     * is typically performed when the client has found a suitable freelancer
     * or decides to cancel the project.
     * 
     * @authenticated
     * @group Client Project Management
     * 
     * @urlParam id integer required The ID of the project to end. Must be owned by the authenticated client. Example: 5
     * 
     * @response 200 scenario="Project ended successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Project ended successfully"
     * }
     * 
     * @response 200 scenario="Project already ended" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Project is already ended"
     * }
     * 
     * @response 404 scenario="Project not found" {
     *   "status": false,
     *   "error_num": null,
     *   "message": "Project not found"
     * }
     * 
     * @response 403 scenario="Unauthorized - not project owner" {
     *   "status": false,
     *   "error_num": null,
     *   "message": "You are not authorized to end this project"
     * }
     * 
     * @response 400 scenario="Cannot end project in current status" {
     *   "status": false,
     *   "error_num": null,
     *   "message": "Project cannot be ended in current status"
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
     * 
     * @response 400 scenario="Invalid project ID" {
     *   "status": false,
     *   "error_num": null,
     *   "message": "Invalid project ID provided"
     * }
     */
    public function endProject(string $id)
    {
        $result = $this->projectService->endProject((int) $id, auth('api')->id());

        if (!$result['status'])
            return Response::api($result['message'], 200, true, null);

        return Response::api($result['message'], 200, true, null);
    }
}
