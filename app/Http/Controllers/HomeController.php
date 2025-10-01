<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ServiceResource;
use App\Services\Contracts\HomeServiceInterface;
use Illuminate\Http\Request;
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

    public function freelancerHome()
    {
        //
    }

    public function clientHome()
    {
        //
    }
}
