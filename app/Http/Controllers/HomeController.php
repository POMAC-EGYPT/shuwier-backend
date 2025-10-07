<?php

namespace App\Http\Controllers;

use App\Http\Requests\FreelancerHomeRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ServiceResource;
use App\Services\Contracts\HomeServiceInterface;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    protected $homeService;
    public function __construct(HomeServiceInterface $homeService)
    {
        $this->homeService = $homeService;
    }
    /**
     * Guest home page
     * 
     * Retrieve the homepage data for guest (non-authenticated) users. This endpoint provides
     * curated content including best-selling categories and top-performing services to showcase
     * the platform's offerings. This data helps visitors discover popular services and categories
     * without requiring authentication.
     * 
     * @group Public Home Page
     * 
     * @response 200 scenario="Home page data retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "best_seller_categories": [
     *       {
     *         "id": 4,
     *         "name": "Programming",
     *         "parent_id": null,
     *         "created_at": "2025-09-07T08:44:46.000000Z",
     *         "updated_at": "2025-09-07T08:44:46.000000Z"
     *       },
     *       {
     *         "id": 2,
     *         "name": "Design & Creative",
     *         "parent_id": null,
     *         "created_at": "2025-09-07T08:44:46.000000Z",
     *         "updated_at": "2025-09-07T08:44:46.000000Z"
     *       }
     *     ],
     *     "best_seller_services": [
     *       {
     *         "id": 4,
     *         "title": "WordPress Website Development",
     *         "description": "I will create a professional WordPress website with custom design and functionality tailored to your business needs with modern features and responsive design",
     *         "category_id": 4,
     *         "subcategory_id": 5,
     *         "category": {
     *           "id": 4,
     *           "name": "Programming",
     *           "parent_id": null,
     *           "created_at": "2025-09-07T08:44:46.000000Z",
     *           "updated_at": "2025-09-07T08:44:46.000000Z"
     *         },
     *         "subcategory": {
     *           "id": 5,
     *           "name": "Web",
     *           "parent_id": 4,
     *           "created_at": "2025-09-07T08:44:46.000000Z",
     *           "updated_at": "2025-09-07T08:44:46.000000Z"
     *         },
     *         "delivery_time": 7,
     *         "delivery_time_unit": "days",
     *         "service_fees_type": "fixed",
     *         "price": "500.00",
     *         "cover_photo": "storage/services/68d3e4ae826cd.PNG",
     *         "faqs": null,
     *         "attachments": null,
     *         "hashtags": null,
     *         "user_id": 3,
     *         "created_at": "2025-09-24T12:31:42.000000Z",
     *         "updated_at": "2025-09-24T12:31:42.000000Z"
     *       },
     *       {
     *         "id": 3,
     *         "title": "Mobile App Development",
     *         "description": "I will develop a custom mobile application for iOS and Android platforms using React Native with modern UI and seamless performance",
     *         "category_id": 4,
     *         "subcategory_id": 5,
     *         "category": {
     *           "id": 4,
     *           "name": "Programming",
     *           "parent_id": null,
     *           "created_at": "2025-09-07T08:44:46.000000Z",
     *           "updated_at": "2025-09-07T08:44:46.000000Z"
     *         },
     *         "subcategory": {
     *           "id": 5,
     *           "name": "Web",
     *           "parent_id": 4,
     *           "created_at": "2025-09-07T08:44:46.000000Z",
     *           "updated_at": "2025-09-07T08:44:46.000000Z"
     *         },
     *         "delivery_time": 7,
     *         "delivery_time_unit": "days",
     *         "service_fees_type": "fixed",
     *         "price": "500.00",
     *         "cover_photo": "storage/services/68d3e46824cdc.PNG",
     *         "faqs": null,
     *         "attachments": null,
     *         "hashtags": null,
     *         "user_id": 3,
     *         "created_at": "2025-09-24T12:30:32.000000Z",
     *         "updated_at": "2025-09-24T12:30:32.000000Z"
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 400 scenario="Service unavailable" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Unable to retrieve home page data"
     * }
     */
    public function guestHome()
    {
        $result = $this->homeService->guestHome();

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, [
            'best_seller_categories' => BaseResource::make(
                CategoryResource::collection($result['data']['best_seller_categories'])
            ),
            'best_seller_services' => BaseResource::make(
                ServiceResource::collection($result['data']['best_seller_services'])
            )
        ]);
    }


    /**
     * Freelancer Home Page
     * 
     * Retrieve personalized homepage data for authenticated freelancers. This endpoint provides
     * a curated list of available projects that match the freelancer's skills and interests.
     * Projects can be filtered by search terms, categories, and budget ranges to help freelancers
     * find relevant opportunities to bid on.
     * 
     * @authenticated
     * @group Public Home Page
     * 
     * @bodyParam search string optional Search term to filter projects by title, description, or keywords. Example: website development
     * @bodyParam category_ids integer[] optional Array of category IDs to filter projects by specific categories. Example: [4, 2]
     * @bodyParam budgets string[] optional Array of budget ranges to filter projects. Example: ["$100-$500", "$500-$1000"]
     * @bodyParam per_page integer optional Number of projects per page (default: 10). Example: 15
     * 
     * @response 200 scenario="Freelancer homepage data retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
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
     *           "name": "Programming",
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
     *         },
     *         "proposals_count": 8,
     *         "time_remaining": "5 days left"
     *       },
     *       {
     *         "id": 7,
     *         "title": "Mobile App UI/UX Design",
     *         "description": "Looking for a talented designer to create modern and user-friendly UI/UX design for a fitness tracking mobile application.",
     *         "category_id": "2",
     *         "subcategory_id": "6",
     *         "budget": "$500-$800",
     *         "deadline_unit": "days",
     *         "deadline": "10",
     *         "status": "active",
     *         "comments_enabled": true,
     *         "proposals_enabled": true,
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
     *         "attachments": [],
     *         "user": {
     *           "id": 8,
     *           "name": "Sarah Johnson",
     *           "email": "sarah.client@example.com",
     *           "type": "client",
     *           "is_active": true,
     *           "profile_picture": "storage/profiles/68d28083a3dd2.PNG",
     *           "company": "FitTech Solutions",
     *           "country": "USA",
     *           "city": "San Francisco",
     *           "is_verified": true,
     *           "user_verification_status": "approved",
     *           "created_at": "2025-09-15T09:20:15.000000Z",
     *           "updated_at": "2025-10-01T16:45:30.000000Z"
     *         },
     *       }
     *     ],
     *     "first_page_url": "http://localhost/api/freelancer/home?page=1",
     *     "from": 1,
     *     "last_page": 4,
     *     "last_page_url": "http://localhost/api/freelancer/home?page=4",
     *     "links": [
     *       {
     *         "url": null,
     *         "label": "&laquo; Previous",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/freelancer/home?page=1",
     *         "label": "1",
     *         "active": true
     *       },
     *       {
     *         "url": "http://localhost/api/freelancer/home?page=2",
     *         "label": "2",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/freelancer/home?page=2",
     *         "label": "Next &raquo;",
     *         "active": false
     *       }
     *     ],
     *     "next_page_url": "http://localhost/api/freelancer/home?page=2",
     *     "path": "http://localhost/api/freelancer/home",
     *     "per_page": 10,
     *     "prev_page_url": null,
     *     "to": 10,
     *     "total": 35
     *   }
     * }
     * 
     * @response 200 scenario="No projects found" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [],
     *     "first_page_url": "http://localhost/api/freelancer/home?page=1",
     *     "from": null,
     *     "last_page": 1,
     *     "last_page_url": "http://localhost/api/freelancer/home?page=1",
     *     "links": [
     *       {
     *         "url": null,
     *         "label": "&laquo; Previous",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/freelancer/home?page=1",
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
     *     "path": "http://localhost/api/freelancer/home",
     *     "per_page": 10,
     *     "prev_page_url": null,
     *     "to": null,
     *     "total": 0
     *   }
     * }
     * 
     * @response 400 scenario="Invalid parameters" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Invalid filter parameters provided"
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function freelancerHome(FreelancerHomeRequest $request)
    {
        $result = $this->homeService->freelancerHome(
            $request->search,
            $request->category_ids,
            $request->budgets,
            $request->per_page ?? 15
        );

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(ProjectResource::collection($result['data']))
        );
    }

    /**
     * Client homepage
     * 
     * Retrieve personalized dashboard data for authenticated clients. This endpoint provides
     * an overview of the client's posted projects, active proposals, and platform statistics
     * relevant to their hiring needs. The dashboard helps clients manage their projects
     * and track the progress of their hiring activities.
     * 
     * @authenticated
     * @group Public Home Page
     * 
     * @response 200 scenario="Client dashboard data retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "projects_overview": {
     *       "total_projects": 12,
     *       "active_projects": 5,
     *       "completed_projects": 6,
     *       "pending_projects": 1,
     *       "total_proposals_received": 84
     *     },
     *     "recent_projects": [
     *       {
     *         "id": 15,
     *         "title": "Mobile App Development",
     *         "budget": "$2000-$3000",
     *         "status": "active",
     *         "proposals_count": 12,
     *         "deadline": "15 days",
     *         "created_at": "2025-10-06T10:30:00.000000Z",
     *         "category": {
     *           "id": 4,
     *           "name": "Programming"
     *         }
     *       },
     *       {
     *         "id": 14,
     *         "title": "Logo Design for Startup",
     *         "budget": "$200-$400",
     *         "status": "completed",
     *         "proposals_count": 8,
     *         "deadline": "completed",
     *         "created_at": "2025-09-28T14:20:00.000000Z",
     *         "category": {
     *           "id": 2,
     *           "name": "Design & Creative"
     *         }
     *       }
     *     ],
     *     "recent_proposals": [
     *       {
     *         "id": 45,
     *         "project_id": 15,
     *         "project_title": "Mobile App Development",
     *         "freelancer": {
     *           "id": 7,
     *           "name": "Mohammad Ali",
     *           "profile_picture": "storage/profiles/68d28083a3dd3.PNG",
     *           "rating": 4.8,
     *           "completed_projects": 23
     *         },
     *         "proposal_amount": "$2500",
     *         "delivery_time": "20 days",
     *         "status": "pending",
     *         "submitted_at": "2025-10-06T12:15:00.000000Z"
     *       },
     *       {
     *         "id": 44,
     *         "project_id": 15,
     *         "project_title": "Mobile App Development",
     *         "freelancer": {
     *           "id": 9,
     *           "name": "Fatima Hassan",
     *           "profile_picture": "storage/profiles/68d28083a3dd4.PNG",
     *           "rating": 4.9,
     *           "completed_projects": 31
     *         },
     *         "proposal_amount": "$2800",
     *         "delivery_time": "18 days",
     *         "status": "pending",
     *         "submitted_at": "2025-10-06T11:45:00.000000Z"
     *       }
     *     ],
     *     "platform_stats": {
     *       "total_freelancers": 1250,
     *       "active_freelancers": 892,
     *       "average_project_completion_time": "12 days",
     *       "client_satisfaction_rate": "96%"
     *     },
     *     "recommended_categories": [
     *       {
     *         "id": 4,
     *         "name": "Programming",
     *         "image": "storage/categories/68dd364f26e71.svg",
     *         "projects_count": 234,
     *         "avg_budget": "$1200"
     *       },
     *       {
     *         "id": 2,
     *         "name": "Design & Creative",
     *         "image": "storage/categories/68dd364f26e72.svg",
     *         "projects_count": 189,
     *         "avg_budget": "$450"
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 200 scenario="New client with no projects" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "projects_overview": {
     *       "total_projects": 0,
     *       "active_projects": 0,
     *       "completed_projects": 0,
     *       "pending_projects": 0,
     *       "total_proposals_received": 0
     *     },
     *     "recent_projects": [],
     *     "recent_proposals": [],
     *     "platform_stats": {
     *       "total_freelancers": 1250,
     *       "active_freelancers": 892,
     *       "average_project_completion_time": "12 days",
     *       "client_satisfaction_rate": "96%"
     *     },
     *     "recommended_categories": [
     *       {
     *         "id": 4,
     *         "name": "Programming",
     *         "image": "storage/categories/68dd364f26e71.svg",
     *         "projects_count": 234,
     *         "avg_budget": "$1200"
     *       },
     *       {
     *         "id": 2,
     *         "name": "Design & Creative",
     *         "image": "storage/categories/68dd364f26e72.svg",
     *         "projects_count": 189,
     *         "avg_budget": "$450"
     *       },
     *       {
     *         "id": 1,
     *         "name": "Writing & Translation",
     *         "image": "storage/categories/68dd364f26e73.svg",
     *         "projects_count": 156,
     *         "avg_budget": "$280"
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 403 scenario="Access denied - not a client" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "Access denied. This endpoint is only available for clients."
     * }
     */
    public function clientHome()
    {
        //
    }
}
