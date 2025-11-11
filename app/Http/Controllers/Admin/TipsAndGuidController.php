<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TipsAndGuidRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\TipsAndGuidResource;
use App\Services\Contracts\TipsAndGuidServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @group Admin Tips & Guides Management
 * 
 * APIs for managing tips and guides content that provide helpful advice and best practices
 * for platform users. These endpoints allow administrators to create, update, and manage
 * educational content with multilingual support (English and Arabic).
 */
class TipsAndGuidController extends Controller
{
    protected $tipsAndGuidService;

    public function __construct(TipsAndGuidServiceInterface $tipsAndGuidService)
    {
        $this->tipsAndGuidService = $tipsAndGuidService;
    }

    /**
     * Get Tips & Guides List.
     * 
     * Retrieve a paginated list of tips and guides with optional search filtering.
     * This endpoint supports searching through titles and descriptions in both English and Arabic languages.
     * 
     * @authenticated
     * 
     * @queryParam search string optional Search term to filter items by title or description. Example: freelancing tips
     * @queryParam per_page integer optional Number of items per page (minimum 1). Example: 10
     * 
     * @response 200 scenario="Success with results" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Tips and guides retrieved successfully",
     *   "data": {
     *     "data": [
     *       {
     *         "id": 1,
     *         "title_en": "Best Freelancing Practices",
     *         "title_ar": "أفضل ممارسات العمل الحر",
     *         "description_en": "Learn the essential tips for successful freelancing career",
     *         "description_ar": "تعلم النصائح الأساسية لمهنة ناجحة في العمل الحر",
     *         "image": "storage/tips-guides/freelancing-tips.jpg",
     *         "is_popular": false,
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
     *   "message": "The per_page must be at least 1."
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
            'per_page' => 'sometimes|integer|min:1'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->tipsAndGuidService->getAllPaginated($request->search, $request->per_page);

        if ($result['status'] == false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(TipsAndGuidResource::collection($result['data']))
        );
    }

    /**
     * Create Tips & Guides Item.
     * 
     * Create a new tip or guide item with multilingual content and required image.
     * This endpoint allows administrators to add educational and helpful content for platform users.
     * 
     * @authenticated
     * 
     * @bodyParam title_en string required English title for the tip or guide. Example: Best Freelancing Practices
     * @bodyParam title_ar string required Arabic title for the tip or guide. Example: أفضل ممارسات العمل الحر
     * @bodyParam description_en string required English description with detailed advice. Example: Learn the essential tips for successful freelancing career
     * @bodyParam description_ar string required Arabic description with detailed advice. Example: تعلم النصائح الأساسية لمهنة ناجحة في العمل الحر
     * @bodyParam image file required Image file to illustrate the tip or guide (max 2MB, jpg/png/svg). Example: No-example
     * 
     * @response 201 scenario="Item created successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Tips and guide created successfully",
     *   "data": {
     *     "id": 1,
     *     "title_en": "Best Freelancing Practices",
     *     "title_ar": "أفضل ممارسات العمل الحر",
     *     "description_en": "Learn the essential tips for successful freelancing career",
     *     "description_ar": "تعلم النصائح الأساسية لمهنة ناجحة في العمل الحر",
     *     "image": "storage/tips-guides/freelancing-tips.jpg",
     *     "is_popular": false,
     *     "created_at": "2025-11-09T10:00:00.000000Z",
     *     "updated_at": "2025-11-09T10:00:00.000000Z"
     *   }
     * }
     *
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The title_en field is required."
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
    public function store(TipsAndGuidRequest $request)
    {
        $result = $this->tipsAndGuidService->create([
            'title_en'       => $request->title_en,
            'title_ar'       => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'image'          => $request->image ?? null,
        ]);

        if ($result['status'] == false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            201,
            true,
            null,
            BaseResource::make(TipsAndGuidResource::make($result['data']))
        );
    }

    /**
     * Get Tips & Guides Item Details.
     * 
     * Retrieve detailed information about a specific tip or guide item by its ID.
     * This endpoint returns the complete item data including multilingual content and image.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The ID of the tips and guides item to retrieve. Example: 1
     * 
     * @response 200 scenario="Item found successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Tips and guide retrieved successfully",
     *   "data": {
     *     "id": 1,
     *     "title_en": "Best Freelancing Practices",
     *     "title_ar": "أفضل ممارسات العمل الحر",
     *     "description_en": "Learn the essential tips for successful freelancing career",
     *     "description_ar": "تعلم النصائح الأساسية لمهنة ناجحة في العمل الحر",
     *     "image": "storage/tips-guides/freelancing-tips.jpg",
     *     "is_popular": false,
     *     "created_at": "2025-11-09T10:00:00.000000Z",
     *     "updated_at": "2025-11-09T10:00:00.000000Z"
     *   }
     * }
     *
     * @response 400 scenario="Item not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Tips and guide not found"
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
        $result = $this->tipsAndGuidService->getById((int) $id);

        if ($result['status'] == false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(TipsAndGuidResource::make($result['data']))
        );
    }

    /**
     * Update Tips & Guides Item.
     * 
     * Update an existing tip or guide item with new content. All fields are optional
     * and only provided fields will be updated. If no new image is provided, the existing image is kept.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The ID of the tips and guides item to update. Example: 1
     * @bodyParam title_en string optional English title for the tip or guide. Example: Best Freelancing Practices - Updated
     * @bodyParam title_ar string optional Arabic title for the tip or guide. Example: أفضل ممارسات العمل الحر - محدث
     * @bodyParam description_en string optional English description with detailed advice. Example: Updated: Learn the essential tips for successful freelancing career
     * @bodyParam description_ar string optional Arabic description with detailed advice. Example: محدث: تعلم النصائح الأساسية لمهنة ناجحة في العمل الحر
     * @bodyParam image file optional New image file to replace existing one (max 2MB, jpg/png/svg). Example: No-example
     * 
     * @response 200 scenario="Item updated successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Tips and guide updated successfully"
     * }
     *
     * @response 400 scenario="Item not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Tips and guide not found"
     * }
     *
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The title_en must be a string."
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
    public function update(TipsAndGuidRequest $request, string $id)
    {
        $result = $this->tipsAndGuidService->update((int) $id, [
            'title_en'       => $request->title_en,
            'title_ar'       => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'image'          => $request->image ?? null,
        ]);

        if ($result['status'] == false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }

    /**
     * Delete Tips & Guides Item.
     * 
     * Permanently delete a tip or guide item from the system. This action cannot be undone.
     * The associated image file will also be removed from storage.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The ID of the tips and guides item to delete. Example: 1
     * 
     * @response 200 scenario="Item deleted successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Tips and guide deleted successfully"
     * }
     *
     * @response 400 scenario="Item not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Tips and guide not found"
     * }
     *
     * @response 400 scenario="Cannot delete" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Cannot delete this tips and guide item"
     * }
     *
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function destroy(string $id)
    {
        $result = $this->tipsAndGuidService->delete((int) $id);

        if ($result['status'] == false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }
}
