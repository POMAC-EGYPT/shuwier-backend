<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HowItWorkRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\HowItWorkResource;
use App\Services\Contracts\HowItWorkServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @group Admin How It Works Management
 * 
 * APIs for managing "How It Works" content sections that explain platform functionality
 * to freelancers and clients. These endpoints allow administrators to create, update, 
 * and manage instructional content with multilingual support (English and Arabic).
 */
class HowItWorkController extends Controller
{
    protected $howItWorkService;

    public function __construct(HowItWorkServiceInterface $howItWorkService)
    {
        $this->howItWorkService = $howItWorkService;
    }

    /**
     * Get How It Works List.
     * 
     * Retrieve a paginated list of "How It Works" items with optional filtering by search term and user type.
     * This endpoint supports searching through titles and descriptions in both English and Arabic languages.
     * 
     * @authenticated
     * 
     * @queryParam search string optional Search term to filter items by title or description. Example: getting started
     * @queryParam type string optional Filter by user type (freelancer or client). Example: freelancer
     * @queryParam per_page integer optional Number of items per page (minimum 1). Example: 10
     * 
     * @response 200 scenario="Success with results" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "How it works retrieved successfully",
     *   "data": {
     *     "data": [
     *       {
     *         "id": 1,
     *         "title_en": "Getting Started",
     *         "title_ar": "البدء",
     *         "description_en": "Learn how to create your profile and start working",
     *         "description_ar": "تعلم كيفية إنشاء ملفك الشخصي وبدء العمل",
     *         "type": "freelancer",
     *         "image": "storage/how-it-works/getting-started.jpg",
     *         "created_at": "2025-11-09T10:00:00.000000Z",
     *         "updated_at": "2025-11-09T10:00:00.000000Z"
     *       }
     *     ],
     *     "current_page": 1,
     *     "last_page": 1,
     *     "per_page": 10,
     *     "total": 1
     *   }
     * }
     *
     * @response 400 scenario="Invalid parameters" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected type is invalid."
     * }
     *
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search'   => 'sometimes|nullable|string',
            'type'     => 'sometimes|in:freelancer,client',
            'per_page' => 'sometimes|integer|min:1'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->howItWorkService->getAllPaginated($request->search, $request->type, $request->per_page);

        if ($result['status'] === false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(HowItWorkResource::collection($result['data']))
        );
    }

    /**
     * Get How It Works Item Details.
     * 
     * Retrieve detailed information about a specific "How It Works" item by its ID.
     * This endpoint returns the complete item data including multilingual content and image.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The ID of the how-it-works item to retrieve. Example: 1
     * 
     * @response 200 scenario="Item found successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "How it works retrieved successfully",
     *   "data": {
     *     "id": 1,
     *     "title_en": "Getting Started",
     *     "title_ar": "البدء",
     *     "description_en": "Learn how to create your profile and start working",
     *     "description_ar": "تعلم كيفية إنشاء ملفك الشخصي وبدء العمل",
     *     "type": "freelancer",
     *     "image": "storage/how-it-works/getting-started.jpg",
     *     "created_at": "2025-11-09T10:00:00.000000Z",
     *     "updated_at": "2025-11-09T10:00:00.000000Z"
     *   }
     * }
     *
     * @response 400 scenario="Item not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "How it works not found"
     * }
     *
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function show(string $id)
    {
        $result = $this->howItWorkService->getById((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(HowItWorkResource::make($result['data']))
        );
    }

    /**
     * Update How It Works Item.
     * 
     * Update an existing "How It Works" item with new content. All fields are optional
     * and only provided fields will be updated. If no new image is provided, the existing image is kept.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The ID of the how-it-works item to update. Example: 1
     * @bodyParam title_en string optional English title for the how-it-works item. Example: Getting Started - Updated
     * @bodyParam title_ar string optional Arabic title for the how-it-works item. Example: البدء - محدث
     * @bodyParam description_en string optional English description explaining the process. Example: Updated: Learn how to create your profile and start working
     * @bodyParam description_ar string optional Arabic description explaining the process. Example: محدث: تعلم كيفية إنشاء ملفك الشخصي وبدء العمل
     * @bodyParam type string optional Target user type (freelancer or client). Example: client
     * @bodyParam image file optional New image file to replace existing one (max 2MB, jpg/png/svg). Example: No-example
     * 
     * @response 200 scenario="Item updated successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "How it works updated successfully"
     * }
     *
     * @response 400 scenario="Item not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "How it works not found"
     * }
     *
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The selected type is invalid."
     * }
     *
     * @response 400 scenario="Invalid image" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The image must be a file of type: jpeg, png, jpg, gif, svg."
     * }
     *
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function update(HowItWorkRequest $request, string $id)
    {
        $result = $this->howItWorkService->update((int) $id, [
            'title_en'       => $request->title_en,
            'title_ar'       => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'type'           => $request->type,
            'image'          => $request->image ?? null,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }
}
