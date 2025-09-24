<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\CategoryResource;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * @group Categories
 * 
 * APIs for managing categories and retrieving category data
 */
class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Get all parent categories
     * 
     * Retrieve all parent categories available in the system. These are the main categories 
     * that can contain subcategories. Use this endpoint to populate category dropdowns 
     * in forms or display category lists.
     * 
     * @response 200 {
     *   "message": "Success",
     *   "status": true,
     *   "data": {
     *     "data": [
     *       {
     *         "id": 1,
     *         "name": "Web Development",
     *         "description": "Website and web application development",
     *         "parent_id": null,
     *         "subcategories": []
     *       },
     *       {
     *         "id": 2,
     *         "name": "Mobile Development",
     *         "description": "Mobile application development for iOS and Android",
     *         "parent_id": null,
     *         "subcategories": []
     *       },
     *       {
     *         "id": 3,
     *         "name": "Graphic Design",
     *         "description": "Visual design and graphic arts",
     *         "parent_id": null,
     *         "subcategories": []
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "An error occurred while retrieving categories",
     *   "status": false,
     *   "error_num": 400
     * }
     */
    public function index()
    {
        $result = $this->categoryService->getParentCategories();

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(CategoryResource::collection($result['data'])));
    }


    /**
     * Get subcategories
     * 
     * Retrieve all subcategories that belong to a specific parent category. This endpoint is used
     * to get the child categories when a user selects a main category, allowing for hierarchical
     * category selection in forms and filters.
     * 
     * @urlParam id integer required The parent category ID to get subcategories for. Example: 1
     * 
     * @response 200 scenario="Subcategories found successfully" {
     *   "message": "Success",
     *   "status": true,
     *   "data": {
     *     "data": [
     *       {
     *         "id": 4,
     *         "name": "Frontend Development",
     *         "parent_id": 1,
     *       },
     *       {
     *         "id": 5,
     *         "name": "Backend Development",
     *         "description": "Server-side development and API creation",
     *         "parent_id": 1,
     *       },
     *       {
     *         "id": 6,
     *         "name": "Full Stack Development",
     *         "description": "Complete web application development",
     *         "parent_id": 1,
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 200 scenario="No subcategories found" {
     *   "message": "Success",
     *   "status": true,
     *   "data": {
     *     "data": []
     *   }
     * }
     * 
     * @response 400 scenario="Invalid parent category ID" {
     *   "message": "Category not found",
     *   "status": false,
     *   "error_num": 400
     * }
     * 
     * @response 400 scenario="Server error" {
     *   "message": "An error occurred while retrieving subcategories",
     *   "status": false,
     *   "error_num": 400
     * }
     */
    public function getChildCategories($id)
    {
        $result = $this->categoryService->getAllPaginated(
            'child',
            (int) $id,
            null,
            50
        );

        return Response::api($result['message'], 200, true, null, BaseResource::make(CategoryResource::collection($result)));
    }
}
