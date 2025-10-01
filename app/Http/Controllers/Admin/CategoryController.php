<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\GetCategoryRequest;
use App\Http\Requests\Admin\Category\StoreAllCategoryWithChildrensRequest;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\CategoryResource;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Support\Facades\Response;

/**
 * @group Admin Category Management
 *
 * APIs for managing categories in the admin panel.
 * These endpoints allow administrators to view, create, update, and delete categories,
 * including bulk creation with children and searching/filtering.
 */
class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * List categories with optional filters and pagination.
     *
     * This endpoint returns a paginated list of categories. You can filter by type and search by name.
     *
     * @authenticated
     * @queryParam type string Optional filter by category type. Example: parent. Possible values: parent, child
     * @queryParam search string Optional search by category name (Arabic or English). Example: تصميم
     * @queryParam per_page integer Number of items per page (default: 10). Example: 20
     * @queryParam page integer Page number for pagination (default: 1). Example: 2
     * @queryParam parent_id integer The parent category ID to filter by (only used when type is 'child'). Example: 2
     *
     * @response 200 scenario="Categories retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": [
     *     {
     *       "id": 1,
     *       "name_en": "Design",
     *       "name_ar": "تصميم",
     *       "parent_id": null,
     *       "created_at": "2025-09-07T10:30:00.000000Z",
     *       "updated_at": "2025-09-07T10:30:00.000000Z"
     *     }
     *   ],
     *   "current_page": 1,
     *   "last_page": 3,
     *   "per_page": 10,
     *   "total": 25
     * }
     */
    public function index(GetCategoryRequest $request)
    {
        $categories = $this->categoryService->getAllPaginated(
            $request->type,
            (int) $request->parent_id,
            $request->search,
            $request->per_page ?? 10
        );

        return Response::api(
            __('message.success'),
            200,
            true,
            null,
            BaseResource::make(CategoryResource::collection($categories))
        );
    }

    /**
     * Create a new category.
     *
     * This endpoint allows admins to create a new category. You can specify parent_id to create a subcategory.
     *
     * @authenticated
     * @bodyParam name_en string required Category name in English. Example: Design
     * @bodyParam name_ar string required Category name in Arabic. Example: تصميم
     * @bodyParam parent_id integer The parent category ID (for subcategories). Example: 2
     * @bodyParam image file required category image file.
     *
     * @response 201 scenario="Category created successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Category created successfully",
     *   "data": {
     *     "id": 5,
     *     "name_en": "Development",
     *     "name_ar": "تطوير",
     *     "image": "development.jpg",
     *     "parent_id": null,
     *     "created_at": "2025-09-07T10:30:00.000000Z",
     *     "updated_at": "2025-09-07T10:30:00.000000Z"
     *   }
     * }
     *
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The name_en field is required."
     * }
     */
    public function store(StoreCategoryRequest $request)
    {
        $result = $this->categoryService->create([
            'name_en'   => $request->name_en,
            'name_ar'   => $request->name_ar,
            'parent_id' => $request->parent_id,
            'image'     => $request->image,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            201,
            true,
            null,
            BaseResource::make(CategoryResource::make($result['data']))
        );
    }

    /**
     * Bulk create categories with children.
     *
     * This endpoint allows admins to create a category and its children in one request.
     * Useful for importing category trees.
     *
     * @authenticated
     * @bodyParam name_en string required Parent category name in English. Example: Programming
     * @bodyParam name_ar string required Parent category name in Arabic. Example: برمجة
     * @bodyParam childrens array Array of child categories (each with name_en, name_ar). Example: [{"name_en": "Web", "name_ar": "ويب"}]
     *
     * @response 201 scenario="Categories created successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Categories created successfully"
     * }
     *
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The childrens field must be an array."
     * }
     */
    public function storeAllWithChildrens(StoreAllCategoryWithChildrensRequest $request)
    {
        $result = $this->categoryService->createAllWithChildrens([
            'name_en'             => $request->name_en,
            'name_ar'             => $request->name_ar,
            'childrens'           => $request->childrens ?? null,
        ]);

        return Response::api($result['message'], 201, true, null);
    }

    /**
     * Show category details by ID.
     *
     * This endpoint returns details for a specific category by its ID.
     *
     * @authenticated
     * @urlParam id integer required The ID of the category to view. Example: 1
     *
     * @response 200 scenario="Category details retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "id": 1,
     *     "name_en": "Design",
     *     "name_ar": "تصميم",
     *     "image": null,
     *     "parent_id": null,
     *     "created_at": "2025-09-07T10:30:00.000000Z",
     *     "updated_at": "2025-09-07T10:30:00.000000Z"
     *   }
     * }
     *
     * @response 404 scenario="Category not found" {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Category not found"
     * }
     */
    public function show(string $id)
    {
        $category = $this->categoryService->getById((int) $id);

        return Response::api(
            __('message.success'),
            200,
            true,
            null,
            BaseResource::make(CategoryResource::make($category))
        );
    }

    /**
     * Update a category by ID.
     *
     * This endpoint allows admins to update the name of a category (English/Arabic).
     *
     * @authenticated
     * @urlParam id integer required The ID of the category to update. Example: 1
     * @bodyParam name_en string Category name in English. Example: Design
     * @bodyParam name_ar string Category name in Arabic. Example: تصميم
     * @bodyParam parent_id integer The parent category ID (for subcategories). Example: 2
     * @bodyParam image file Optional category image file. If not provided, the existing image will remain unchanged. Send a new image file to update it.
     *
     * @response 200 scenario="Category updated successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Category updated successfully",
     * }
     *
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The name_en field is required."
     * }
     *
     * @response 404 scenario="Category not found" {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Category not found"
     * }
     */
    public function update(StoreCategoryRequest $request, string $id)
    {
        $result = $this->categoryService->update((int) $id, [
            'name_en'   => $request->name_en ?? null,
            'name_ar'   => $request->name_ar ?? null,
            'parent_id' => $request->parent_id ?? null,
            'image'     => $request->image ?? null,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, $result['data']);
    }

    /**
     * Delete a category by ID.
     *
     * This endpoint allows admins to delete a category by its ID.
     *
     * @authenticated
     * @urlParam id integer required The ID of the category to delete. Example: 1
     *
     * @response 200 scenario="Category deleted successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Category deleted successfully"
     * }
     *
     * @response 404 scenario="Category not found" {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Category not found"
     * }
     */
    public function destroy(string $id)
    {
        $this->categoryService->delete((int) $id);

        return Response::api(__('message.category_deleted_successfully'), 200, true, null);
    }
}
