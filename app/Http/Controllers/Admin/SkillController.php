<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SkillRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\SkillResource;
use App\Services\Contracts\SkillServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @group Admin Skills Management
 * 
 * APIs for managing skills in the system. Skills are used to categorize freelancer capabilities
 * and can be associated with categories for better organization.
 */
class SkillController extends Controller
{
    protected $skillService;

    public function __construct(SkillServiceInterface $skillService)
    {
        $this->skillService = $skillService;
    }

    /**
     * Get All Skills
     * 
     * Retrieve a paginated list of all skills in the system.
     * This endpoint supports search functionality and pagination.
     * 
     * @authenticated
     * 
     * @queryParam search string optional Search term to filter skills by name (Arabic or English). Example: "PHP"
     * @queryParam per_page integer optional Number of items per page (1-100). Defaults to 10. Example: 15
     * 
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Skills retrieved successfully",
     *   "data": {
     *     "data": [
     *       {
     *         "id": 1,
     *         "name_ar": "برمجة PHP",
     *         "name_en": "PHP Programming",
     *         "category_id": 2,
     *         "category": {
     *           "id": 2,
     *           "name_ar": "برمجة",
     *           "name_en": "Programming"
     *         },
     *         "created_at": "2024-01-15T10:30:00.000000Z",
     *         "updated_at": "2024-01-15T10:30:00.000000Z"
     *       },
     *       {
     *         "id": 2,
     *         "name_ar": "تصميم جرافيك",
     *         "name_en": "Graphic Design",
     *         "category_id": 3,
     *         "category": {
     *           "id": 3,
     *           "name_ar": "تصميم",
     *           "name_en": "Design"
     *         },
     *         "created_at": "2024-01-16T14:20:00.000000Z",
     *         "updated_at": "2024-01-16T14:20:00.000000Z"
     *       }
     *     ],
     *     "current_page": 1,
     *     "first_page_url": "http://127.0.0.1:8000/api/admin/skills?page=1",
     *     "from": 1,
     *     "last_page": 5,
     *     "last_page_url": "http://127.0.0.1:8000/api/admin/skills?page=5",
     *     "next_page_url": "http://127.0.0.1:8000/api/admin/skills?page=2",
     *     "path": "http://127.0.0.1:8000/api/admin/skills",
     *     "per_page": 10,
     *     "prev_page_url": null,
     *     "to": 10,
     *     "total": 50
     *   }
     * }
     * 
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Search term must not exceed 255 characters",
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated",
     *   "status": false,
     *   "error_num": 401,
     * }
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search'   => 'nullable|string|max:255',
            'per_page' => 'nullable|integer|min:1|max:100',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->skillService->getAllPaginated(
            $request->search    ?? null,
            $request->per_page ?? 10
        );

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(SkillResource::collection($result['data']))
        );
    }

    /**
     * Create New Skill
     * 
     * Create a new skill in the system. Skills must have names in both Arabic and English
     * and must be associated with a valid category.
     * 
     * @authenticated
     * 
     * @bodyParam name_ar string required The Arabic name of the skill. Must be unique and between 2-100 characters. Example: "برمجة PHP"
     * @bodyParam name_en string required The English name of the skill. Must be unique and between 2-100 characters. Example: "PHP Programming"
     * @bodyParam category_id integer required The ID of the category this skill belongs to. Must exist in categories table. Example: 2
     * 
     * @response 201 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Skill created successfully",
     *   "data": {
     *     "id": 15,
     *     "name_ar": "برمجة PHP",
     *     "name_en": "PHP Programming",
     *     "category_id": 2,
     *     "category": {
     *       "id": 2,
     *       "name_ar": "برمجة",
     *       "name_en": "Programming"
     *     },
     *     "created_at": "2024-01-20T09:15:30.000000Z",
     *     "updated_at": "2024-01-20T09:15:30.000000Z"
     *   }
     * }
     * 
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The Arabic name has already been taken",
     * }
     * 
     * @response 400 {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The name ar field is required",
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated",
     *   "status": false,
     *   "error_num": 401,
     * }
     * 
     * @response 400 {
     *   "message": "This category is not a parent category",
     *   "status": false,
     *   "error_num": 400,
     * }
     */
    public function store(SkillRequest $request)
    {
        $result = $this->skillService->create([
            'name_ar'     => $request->name_ar,
            'name_en'     => $request->name_en,
            'category_id' => $request->category_id,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            201,
            true,
            null,
            BaseResource::make(SkillResource::make($result['data']))
        );
    }

    /**
     * Get Skill Details
     * 
     * Retrieve detailed information about a specific skill by its ID.
     * Returns the skill data including its associated category information.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The ID of the skill to retrieve. Example: 5
     * 
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "id": 5,
     *     "name_ar": "تصميم واجهات المستخدم",
     *     "name_en": "UI Design",
     *     "category_id": 3,
     *     "category": {
     *       "id": 3,
     *       "name_ar": "تصميم",
     *       "name_en": "Design"
     *     },
     *     "created_at": "2024-01-18T16:45:22.000000Z",
     *     "updated_at": "2024-01-19T10:30:15.000000Z"
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "Skill not found",
     *   "status": false,
     *   "error_num": 400,
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated",
     *   "status": false,
     *   "error_num": 401,
     * }
     */
    public function show(string $id)
    {
        $result = $this->skillService->getById((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            __('message.success'),
            200,
            true,
            null,
            BaseResource::make(SkillResource::make($result['data']))
        );
    }

    /**
     * Update Skill
     * 
     * Update an existing skill's information. You can modify the skill names (Arabic/English)
     * and change its category association. All fields are required for update.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The ID of the skill to update. Example: 5
     * @bodyParam name_ar string required The updated Arabic name of the skill. Must be unique and between 2-100 characters. Example: "تطوير تطبيقات PHP"
     * @bodyParam name_en string required The updated English name of the skill. Must be unique and between 2-100 characters. Example: "PHP Application Development"
     * @bodyParam category_id integer required The ID of the category this skill should belong to. Must exist in categories table. Example: 2
     * 
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Skill updated successfully",
     *   "data": {
     *     "id": 5,
     *     "name_ar": "تطوير تطبيقات PHP",
     *     "name_en": "PHP Application Development",
     *     "category_id": 2,
     *     "category": {
     *       "id": 2,
     *       "name_ar": "برمجة",
     *       "name_en": "Programming"
     *     },
     *     "created_at": "2024-01-18T16:45:22.000000Z",
     *     "updated_at": "2024-01-20T11:22:45.000000Z"
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "Skill not found",
     *   "status": false,
     *   "error_num": 400,
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated",
     *   "status": false,
     *   "error_num": 401,
     * }
     * 
     * @response 400 {
     *   "message": "This category is not a parent category",
     *   "status": false,
     *   "error_num": 400,
     * }
     */
    public function update(SkillRequest $request, string $id)
    {
        $result = $this->skillService->update((int) $id, [
            'name_ar'     => $request->name_ar,
            'name_en'     => $request->name_en,
            'category_id' => $request->category_id,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(SkillResource::make($result['data'])));
    }

    /**
     * Delete Skill
     * 
     * Permanently delete a skill from the system. This action cannot be undone.
     * Make sure the skill is not being used by any freelancers before deletion.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The ID of the skill to delete. Example: 8
     * 
     * @response 200 {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Skill deleted successfully",
     * }
     * 
     * @response 400 {
     *   "message": "Skill not found",
     *   "status": false,
     *   "error_num": 400,
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated",
     *   "status": false,
     *   "error_num": 401,
     * }
     */
    public function destroy(string $id)
    {
        $result = $this->skillService->delete((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }
}
