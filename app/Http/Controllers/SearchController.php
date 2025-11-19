<?php

namespace App\Http\Controllers;

use App\Enum\SearchType;
use App\Http\Requests\Search\ClientSearchRequest;
use App\Http\Requests\Search\FreelancerSearchRequest;
use App\Http\Requests\Search\ProjectSearchRequest;
use App\Http\Requests\Search\ServiceSearchRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\FreelancerResource;
use App\Http\Resources\ServiceResource;
use App\Services\Search\Context\SearchContext;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Response;

class SearchController extends Controller
{
    protected $searchContext;

    public function __construct(SearchContext $searchContext)
    {
        $this->searchContext = $searchContext;
    }

    /**
     * Search services
     * 
     * Search and filter services based on various criteria including text search, category,
     * subcategory, hashtags, and price range. This endpoint provides comprehensive service
     * discovery functionality with multiple filtering options. Results are paginated with
     * 16 services per page.
     * 
     * @group Public Search
     * 
     * @bodyParam search string optional Search term to find services by title, description, or keywords (max 5000 characters). Example: wordpress website development
     * @bodyParam category_id integer optional Filter services by main category ID. Must be a valid category. Example: 4
     * @bodyParam subcategory_id integer optional Filter services by subcategory ID. Must be a valid subcategory. Example: 5
     * @bodyParam hashtag string optional Filter services by hashtag keyword. Search for services tagged with specific keywords. Example: php
     * @bodyParam price_min number optional Minimum price filter. Only services with price >= this value will be returned. Example: 100.00
     * @bodyParam price_max number optional Maximum price filter. Only services with price <= this value will be returned. Example: 1000.00
     * @bodyParam per_page integer optional Number of results to return per page. Must be between 1 and 50. Example: 10
     * 
     * @response 200 scenario="Services found successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 4,
     *         "title": "WordPress Website Development",
     *         "description": "I will create a professional WordPress website with custom design and functionality tailored to your business needs",
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
     *         "id": 8,
     *         "title": "E-commerce Website Development",
     *         "description": "I will build a complete e-commerce website with payment integration, product management, and admin dashboard",
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
     *         "delivery_time": 14,
     *         "delivery_time_unit": "days",
     *         "service_fees_type": "fixed",
     *         "price": "750.00",
     *         "cover_photo": "storage/services/68d3e4ae826ce.PNG",
     *         "faqs": null,
     *         "attachments": null,
     *         "hashtags": null,
     *         "user_id": 5,
     *         "created_at": "2025-09-25T09:15:30.000000Z",
     *         "updated_at": "2025-09-25T09:15:30.000000Z"
     *       }
     *     ],
     *     "first_page_url": "http://localhost/api/search/services?page=1",
     *     "from": 1,
     *     "last_page": 3,
     *     "last_page_url": "http://localhost/api/search/services?page=3",
     *     "links": [
     *       {
     *         "url": null,
     *         "label": "&laquo; Previous",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/search/services?page=1",
     *         "label": "1",
     *         "active": true
     *       },
     *       {
     *         "url": "http://localhost/api/search/services?page=2",
     *         "label": "2",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/search/services?page=3",
     *         "label": "3",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/search/services?page=2",
     *         "label": "Next &raquo;",
     *         "active": false
     *       }
     *     ],
     *     "next_page_url": "http://localhost/api/search/services?page=2",
     *     "path": "http://localhost/api/search/services",
     *     "per_page": 16,
     *     "prev_page_url": null,
     *     "to": 16,
     *     "total": 45
     *   }
     * }
     * 
     * @response 200 scenario="No services found" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [],
     *     "first_page_url": "http://localhost/api/search/services?page=1",
     *     "from": null,
     *     "last_page": 1,
     *     "last_page_url": "http://localhost/api/search/services?page=1",
     *     "links": [
     *       {
     *         "url": null,
     *         "label": "&laquo; Previous",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/search/services?page=1",
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
     *     "path": "http://localhost/api/search/services",
     *     "per_page": 16,
     *     "prev_page_url": null,
     *     "to": null,
     *     "total": 0
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
     * @response 400 scenario="Invalid hashtag" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected hashtag_ids.0 is invalid."
     * }
     * 
     * @response 400 scenario="Invalid price range" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The price min field must be at least 0."
     * }
     * 
     * @response 400 scenario="Search term too long" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The search field must not be greater than 5000 characters."
     * }
     */
    public function serviceSearch(ServiceSearchRequest $request)
    {
        $result = $this->searchContext->search(SearchType::SERVICE->value, [
            'search'         => $request->search,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'hashtag'        => $request->hashtag,
            'price_min'      => $request->price_min,
            'price_max'      => $request->price_max,
            'per_page'        => $request->per_page ?? 16,
        ]);

        return Response::api(
            __('message.success'),
            200,
            true,
            200,
            BaseResource::make(ServiceResource::collection($result))
        );
    }

    /**
     * Project Search
     * 
     * Retrieve personalized homepage data for authenticated freelancers. This endpoint provides
     * a curated list of available projects that match the freelancer's skills and interests.
     * Projects can be filtered by search terms, categories, and budget ranges to help freelancers
     * find relevant opportunities to bid on.
     * 
     * @group Public Search
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
     */
    public function projectSearch(ProjectSearchRequest $request)
    {
        $result = $this->searchContext->search(SearchType::PROJECT->value, [
            'search'       => $request->search,
            'category_ids' => $request->category_ids,
            'budgets'      => $request->budgets,
            'per_page'     => $request->per_page ?? 15
        ]);

        return Response::api(
            __('message.success'),
            200,
            true,
            null,
            BaseResource::make(ProjectResource::collection($result))
        );
    }

    /**
     * Client Search
     * 
     * Search and filter clients based on name, username, and average rating. This endpoint allows
     * searching for clients with specific rating ranges to help freelancers find quality clients
     * to work with. Results include client profile information and their average rating from previous
     * projects.
     * 
     * @group Public Search
     * 
     * @bodyParam search string optional Search term to find clients by name or username. Example: john smith
     * @bodyParam rates integer[] optional Array of rating values to filter clients. If single value provided (e.g., [3]), returns clients with ratings from 3.0 to 3.99. If multiple values provided (e.g., [3,5]), returns clients with ratings between 3 and 5. Example: [4]
     * @bodyParam per_page integer optional Number of results to return per page. Must be between 1 and 50. Default is 15. Example: 10
     * 
     * @response 200 scenario="Clients found successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 15,
     *         "name": "John Smith",
     *         "username": "johnsmith_client",
     *         "email": "john.smith@example.com",
     *         "type": "client",
     *         "is_active": true,
     *         "profile_picture": "storage/profiles/client_15.jpg",
     *         "company": "Tech Solutions Inc.",
     *         "country": "United States",
     *         "city": "New York",
     *         "is_verified": true,
     *         "user_verification_status": "approved",
     *         "rate": 4.2,
     *         "rate_count": 18,
     *         "created_at": "2025-08-15T10:30:00.000000Z",
     *         "updated_at": "2025-11-10T14:20:00.000000Z"
     *       },
     *       {
     *         "id": 23,
     *         "name": "Sarah Johnson",
     *         "username": "sarah_j_client",
     *         "email": "sarah.j@business.com",
     *         "type": "client",
     *         "is_active": true,
     *         "profile_picture": "storage/profiles/client_23.jpg",
     *         "company": "Digital Marketing Pro",
     *         "country": "Canada",
     *         "city": "Toronto",
     *         "is_verified": true,
     *         "user_verification_status": "approved",
     *         "rate": 4.7,
     *         "rate_count": 25,
     *         "created_at": "2025-09-02T09:15:00.000000Z",
     *         "updated_at": "2025-11-18T11:45:00.000000Z"
     *       }
     *     ],
     *     "first_page_url": "http://localhost/api/search/clients?page=1",
     *     "from": 1,
     *     "last_page": 3,
     *     "last_page_url": "http://localhost/api/search/clients?page=3",
     *     "next_page_url": "http://localhost/api/search/clients?page=2",
     *     "path": "http://localhost/api/search/clients",
     *     "per_page": 15,
     *     "prev_page_url": null,
     *     "to": 15,
     *     "total": 42
     *   }
     * }
     * 
     * @response 200 scenario="No clients found" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [],
     *     "first_page_url": "http://localhost/api/search/clients?page=1",
     *     "from": null,
     *     "last_page": 1,
     *     "last_page_url": "http://localhost/api/search/clients?page=1",
     *     "next_page_url": null,
     *     "path": "http://localhost/api/search/clients",
     *     "per_page": 15,
     *     "prev_page_url": null,
     *     "to": null,
     *     "total": 0
     *   }
     * }
     * 
     * @response 400 scenario="Invalid rating values" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The rates.0 field must be at least 1."
     * }
     * 
     * @response 400 scenario="Invalid search parameters" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The search field must not be greater than 255 characters."
     * }
     */
    public function clientSearch(ClientSearchRequest $request)
    {
        $result = $this->searchContext->search(SearchType::CLIENT->value, [
            'search'   => $request->search,
            'rates'    => $request->rates,
            'per_page' => $request->per_page ?? 15
        ]);

        return Response::api(
            __('message.success'),
            200,
            true,
            null,
            BaseResource::make(ClientResource::collection($result))
        );
    }

    /**
     * Freelancer Search
     * 
     * Search and filter freelancers based on multiple criteria including name, category, skills,
     * and average rating. This comprehensive search helps clients find qualified freelancers
     * for their projects. Results include freelancer profiles, skills, categories, and ratings
     * from previous work.
     * 
     * @group Public Search
     * 
     * @bodyParam search string optional Search term to find freelancers by name or username. Example: ahmed developer
     * @bodyParam category_ids integer[] optional Array of category IDs to filter freelancers by their specialization categories. Must be valid category IDs. Example: [4, 2]
     * @bodyParam skill_ids integer[] optional Array of skill IDs to filter freelancers who have these specific skills. Must be valid skill IDs. Example: [15, 23, 8]
     * @bodyParam rates integer[] optional Array of rating values to filter freelancers. If single value provided (e.g., [4]), returns freelancers with ratings from 4.0 to 4.99. If multiple values provided (e.g., [3,5]), returns freelancers with ratings between 3 and 5. Example: [4, 5]
     * @bodyParam per_page integer optional Number of results to return per page. Must be between 1 and 50. Default is 15. Example: 10
     * 
     * @response 200 scenario="Freelancers found successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 12,
     *         "name": "Ahmed Hassan",
     *         "username": "ahmed_dev",
     *         "email": "ahmed.hassan@freelancer.com",
     *         "type": "freelancer",
     *         "is_active": true,
     *         "profile_picture": "storage/profiles/freelancer_12.jpg",
     *         "about_me": "Experienced full-stack developer with 5+ years in web development",
     *         "country": "Egypt",
     *         "city": "Cairo",
     *         "is_verified": true,
     *         "user_verification_status": "approved",
     *         "rate": 4.8,
     *         "rate_count": 32,
     *         "freelancer_profile": {
     *           "id": 8,
     *           "user_id": 12,
     *           "category_id": 4,
     *           "hourly_rate": "25.00",
     *           "availability": "full_time",
     *           "experience_years": 5,
     *           "category": {
     *             "id": 4,
     *             "name": "Programming & Development",
     *             "parent_id": null
     *           }
     *         },
     *         "skills": [
     *           {
     *             "id": 15,
     *             "name": "Laravel",
     *             "created_at": "2025-09-01T10:00:00.000000Z"
     *           },
     *           {
     *             "id": 23,
     *             "name": "Vue.js",
     *             "created_at": "2025-09-01T10:05:00.000000Z"
     *           },
     *           {
     *             "id": 8,
     *             "name": "MySQL",
     *             "created_at": "2025-09-01T09:30:00.000000Z"
     *           }
     *         ],
     *         "created_at": "2025-07-20T08:15:00.000000Z",
     *         "updated_at": "2025-11-15T16:30:00.000000Z"
     *       },
     *       {
     *         "id": 18,
     *         "name": "Fatima Al-Zahra",
     *         "username": "fatima_design",
     *         "email": "fatima.design@creative.com",
     *         "type": "freelancer",
     *         "is_active": true,
     *         "profile_picture": "storage/profiles/freelancer_18.jpg",
     *         "about_me": "Creative UI/UX designer passionate about user-centered design",
     *         "country": "Morocco",
     *         "city": "Casablanca",
     *         "is_verified": true,
     *         "user_verification_status": "approved",
     *         "rate": 4.6,
     *         "rate_count": 28,
     *         "freelancer_profile": {
     *           "id": 12,
     *           "user_id": 18,
     *           "category_id": 2,
     *           "hourly_rate": "30.00",
     *           "availability": "part_time",
     *           "experience_years": 4,
     *           "category": {
     *             "id": 2,
     *             "name": "Design & Creative",
     *             "parent_id": null
     *           }
     *         },
     *         "skills": [
     *           {
     *             "id": 45,
     *             "name": "UI Design",
     *             "created_at": "2025-09-01T11:00:00.000000Z"
     *           },
     *           {
     *             "id": 46,
     *             "name": "UX Design",
     *             "created_at": "2025-09-01T11:05:00.000000Z"
     *           }
     *         ],
     *         "created_at": "2025-08-10T12:20:00.000000Z",
     *         "updated_at": "2025-11-12T09:45:00.000000Z"
     *       }
     *     ],
     *     "first_page_url": "http://localhost/api/search/freelancers?page=1",
     *     "from": 1,
     *     "last_page": 5,
     *     "last_page_url": "http://localhost/api/search/freelancers?page=5",
     *     "next_page_url": "http://localhost/api/search/freelancers?page=2",
     *     "path": "http://localhost/api/search/freelancers",
     *     "per_page": 15,
     *     "prev_page_url": null,
     *     "to": 15,
     *     "total": 73
     *   }
     * }
     * 
     * @response 200 scenario="No freelancers found" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [],
     *     "first_page_url": "http://localhost/api/search/freelancers?page=1",
     *     "from": null,
     *     "last_page": 1,
     *     "last_page_url": "http://localhost/api/search/freelancers?page=1",
     *     "next_page_url": null,
     *     "path": "http://localhost/api/search/freelancers",
     *     "per_page": 15,
     *     "prev_page_url": null,
     *     "to": null,
     *     "total": 0
     *   }
     * }
     * 
     * @response 400 scenario="Invalid category ID" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected category_ids.0 is invalid."
     * }
     * 
     * @response 400 scenario="Invalid skill ID" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected skill_ids.0 is invalid."
     * }
     * 
     * @response 400 scenario="Invalid rating values" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The rates.0 field must be at least 1."
     * }
     * 
     * @response 400 scenario="Invalid search parameters" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The search field must not be greater than 255 characters."
     * }
     */
    public function freelancerSearch(FreelancerSearchRequest $request)
    {
        $result = $this->searchContext->search(SearchType::FREELANCER->value, [
            'search'       => $request->search,
            'category_ids' => $request->category_ids,
            'skill_ids'    => $request->skill_ids,
            'rates'        => $request->rates,
            'per_page'     => $request->per_page ?? 15
        ]);

        return Response::api(
            __('message.success'),
            200,
            true,
            null,
            BaseResource::make(FreelancerResource::collection($result))
        );
    }
}
