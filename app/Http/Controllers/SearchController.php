<?php

namespace App\Http\Controllers;

use App\Enum\SearchType;
use App\Http\Requests\Search\ProjectSearchRequest;
use App\Http\Requests\Search\ServiceSearchRequest;
use App\Http\Resources\BaseResource;
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
}
