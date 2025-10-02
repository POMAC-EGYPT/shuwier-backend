<?php

namespace App\Http\Controllers;

use App\Enum\SearchType;
use App\Http\Requests\Search\ServiceSearchRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ServiceResource;
use App\Services\Search\Context\SearchContext;
use Illuminate\Http\Request;
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
     * @bodyParam hashtag_ids integer[] optional Array of hashtag IDs to filter services. Services matching any hashtag will be returned. Example: [11, 25, 30]
     * @bodyParam priceMin number optional Minimum price filter. Only services with price >= this value will be returned. Example: 100.00
     * @bodyParam priceMax number optional Maximum price filter. Only services with price <= this value will be returned. Example: 1000.00
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
            'hashtag_ids'    => $request->hashtag_ids,
            'priceMin'       => $request->priceMin,
            'priceMax'       => $request->priceMax,
            'perPage'        => 16,
        ]);

        return Response::api(
            __('message.success'),
            200,
            true,
            200,
            BaseResource::make(ServiceResource::collection($result))
        );
    }
}
