<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Freelancer\PortfolioRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\PortfolioResource;
use App\Services\Contracts\PortfolioServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * @group Freelancer Portfolio
 * 
 * APIs for managing freelancer portfolios
 */
class PortfolioController extends Controller
{
    protected $portfolioService;

    public function __construct(PortfolioServiceInterface $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }

    /**
     * Get user portfolios
     * 
     * Retrieve all portfolios for the authenticated freelancer with pagination.
     * 
     * @queryParam per_page integer Number of portfolios per page. Default is 10. Example: 15
     * 
     * @response 200 {
     *   "message": "Success",
     *   "status": true,
     *   "data": {
     *     "data": [
     *       {
     *         "id": 1,
     *         "title": "E-commerce Website",
     *         "description": "Modern responsive e-commerce website",
     *     "cover_photo": "storage/portfolios/68ee0f54b6ee8.PNG",
     *         "category": {
     *           "id": 1,
     *           "name": "Web Development"
     *         },
     *         "subcategory": {
     *           "id": 2,
     *           "name": "Frontend"
     *         },
     *         "hashtags": ["#react", "#ecommerce"],
     *         "attachments": [
     *           {
     *             "id": 1,
     *             "file_path": "storage/portfolios/image1.jpg"
     *           }
     *         ]
     *       }
     *     ],
     *     "current_page": 1,
     *     "per_page": 10,
     *     "total": 25
     *   }
     * }
     * 
     * @authenticated
     */
    public function index(Request $request)
    {
        $userId = auth('api')->id();

        $result = $this->portfolioService->listPortfoliosByUserId($userId, $request->per_page ?? 10);

        return Response::api($result['message'], 200, true, null, BaseResource::make(PortfolioResource::collection($result['data'])));
    }

    /**
     * Create new portfolio
     * 
     * Create a new portfolio for the authenticated freelancer.
     * 
     * @bodyParam title string required The portfolio title (max 255 characters). Example: "E-commerce Website"
     * @bodyParam description string required The portfolio description. Example: "A modern responsive e-commerce website built with React and Laravel"
     * @bodyParam category_id integer required The main category ID (must be a parent category). Example: 1
     * @bodyParam subcategory_id integer optional The subcategory ID (must belong to the selected category). Example: 2
     * @bodyParam attachment_ids integer[] optional Array of attachment IDs from uploaded files (max 8 files). Use /api/upload endpoint first to upload files and get IDs. Example: [15, 16, 17]
     * @bodyParam cover_photo file optional The portfolio cover photo (required for creation, optional for updates). Accepted formats: jpeg, png, jpg, webp. Max size: 5MB
     * @bodyParam hashtags string[] optional Array of hashtag strings (max 255 characters each). Example: ["react", "ecommerce", "laravel"]
     * 
     * @response 200 {
     *   "message": "Portfolio created successfully",
     *   "status": true,
     *   "data": {
     *     "id": 1,
     *     "title": "E-commerce Website",
     *     "description": "A modern responsive e-commerce website",
     *     "cover_photo": "storage/portfolios/68ee0f54b6ee8.PNG",
     *     "category": {
     *       "id": 1,
     *       "name": "Web Development"
     *     },
     *     "subcategory": {
     *       "id": 2,
     *       "name": "Frontend"
     *     },
     *     "hashtags": ["#react", "#ecommerce"],
     *     "attachments": [
     *       {
     *         "id": 1,
     *         "file_path": "storage/portfolios/image1.jpg"
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "This category is not a parent category",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @response 400 {
     *   "message": "This subcategory does not belong to the selected category",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @authenticated
     */
    public function store(PortfolioRequest $request)
    {
        $result = $this->portfolioService->create([
            'title'             => $request->title,
            'description'       => $request->description,
            'category_id'       => $request->category_id,
            'subcategory_id'    => $request->subcategory_id ?? null,
            'attachment_ids'    => $request->attachment_ids ?? [],
            'cover_photo'       => $request->cover_photo,
            'hashtags'          => $request->hashtags ?? null,
            'user_id'           => auth('api')->id(),
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(PortfolioResource::make($result['data'])));
    }

    /**
     * Get specific portfolio
     * 
     * Retrieve a specific portfolio by its ID with all related data.
     * 
     * @urlParam id integer required The portfolio ID. Example: 1
     * 
     * @response 200 {
     *   "message": "Success",
     *   "status": true,
     *   "data": {
     *     "id": 1,
     *     "title": "E-commerce Website",
     *     "description": "A modern responsive e-commerce website",
     *     "cover_photo": "storage/portfolios/68ee0f54b6ee8.PNG",
     *     "category": {
     *       "id": 1,
     *       "name": "Web Development"
     *     },
     *     "subcategory": {
     *       "id": 2,
     *       "name": "Frontend"
     *     },
     *     "hashtags": ["#react", "#ecommerce"],
     *     "attachments": [
     *       {
     *         "id": 1,
     *         "file_path": "storage/portfolios/image1.jpg"
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "Portfolio not found",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @authenticated
     */
    public function show(string $id)
    {
        $result = $this->portfolioService->getPortfolioByUserIdAndPortfolioId(auth('api')->id(), (int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(PortfolioResource::make($result['data'])));
    }

    /**
     * Update portfolio
     * 
     * Update an existing portfolio. **Important behavior notes:**
     * 
     * **For Attachments:**
     * - If you send `attachment_ids` parameter (even as empty array), ALL existing attachments will be detached and replaced with the new ones
     * - If you don't send `attachment_ids` parameter at all, existing attachments will remain unchanged
     * - You need to upload files first using /api/upload endpoint to get attachment IDs
     * - Example: To change attachments, send new attachment IDs: `"attachment_ids": [20, 21, 22]`
     * 
     * **For Hashtags:**
     * - If you send `hashtags` parameter (even as empty array), ALL existing hashtags will be replaced with the new ones
     * - If you don't send `hashtags` parameter at all, existing hashtags will remain unchanged
     * - To remove all hashtags, send an empty array: `"hashtags": []`
     * 
     * @urlParam id integer required The portfolio ID to update. Example: 1
     * @bodyParam title string required The portfolio title (max 255 characters). Example: "Updated E-commerce Website"
     * @bodyParam description string required The portfolio description. Example: "An updated modern responsive e-commerce website"
     * @bodyParam category_id integer required The main category ID (must be a parent category). Example: 1
     * @bodyParam subcategory_id integer optional The subcategory ID (must belong to the selected category). Set to null to remove subcategory. Example: 2
     * @bodyParam attachment_ids integer[] optional Array of attachment IDs from uploaded files (max 8 files). **CAUTION:** If provided, ALL existing attachments will be detached first. Example: [20, 21, 22]
     * @bodyParam cover_photo file optional The portfolio cover photo (required for creation, optional for updates). Accepted formats: jpeg, png, jpg, webp. Max size: 5MB
     * @bodyParam hashtags string[] optional Array of hashtag strings. **CAUTION:** If provided, ALL existing hashtags will be replaced. Example: ["react", "updated", "laravel"]
     * 
     * @response 200 {
     *   "message": "Portfolio updated successfully",
     *   "status": true,
     *   "data": {
     *     "id": 1,
     *     "title": "Updated E-commerce Website",
     *     "description": "An updated modern responsive e-commerce website",
     *     "cover_photo": "storage/portfolios/68ee0f54b6ee8.PNG",
     *     "category": {
     *       "id": 1,
     *       "name": "Web Development"
     *     },
     *     "subcategory": {
     *       "id": 2,
     *       "name": "Frontend"
     *     },
     *     "hashtags": ["#react", "#updated"],
     *     "attachments": [
     *       {
     *         "id": 2,
     *         "file_path": "storage/portfolios/new_image.jpg"
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "This category is not a parent category",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @response 400 {
     *   "message": "This attachment is already used",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @response 400 {
     *   "message": "This attachment does not belong to the user",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     * @authenticated
     */
    public function update(PortfolioRequest $request, string $id)
    {
        $result = $this->portfolioService->update(auth('api')->id(), (int) $id, [
            'title'             => $request->title,
            'description'       => $request->description,
            'category_id'       => $request->category_id,
            'subcategory_id'    => $request->subcategory_id ?? null,
            'attachment_ids'    => $request->attachment_ids ?? [],
            'cover_photo'       => $request->cover_photo ?? null,
            'hashtags'          => $request->hashtags ?? [],
            'user_id'           => auth('api')->id(),
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(PortfolioResource::make($result['data'])));
    }

    /**
     * Delete portfolio
     * 
     * Permanently delete a portfolio and all its associated data including attachments and hashtag relationships.
     * **Warning:** This action cannot be undone. All uploaded files will also be deleted from storage.
     * 
     * @urlParam id integer required The portfolio ID to delete. Example: 1
     * 
     * @response 200 {
     *   "message": "Portfolio deleted successfully",
     *   "status": true,
     *   "data": null
     * }
     * 
     * @response 404 {
     *   "message": "Portfolio not found",
     *   "status": false,
     *   "error_code": 404
     * }
     * 
     * @authenticated
     */
    public function destroy(string $id)
    {
        $result = $this->portfolioService->delete(auth('api')->id(), (int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }
}
