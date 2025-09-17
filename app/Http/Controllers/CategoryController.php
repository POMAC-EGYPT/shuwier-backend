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
}
