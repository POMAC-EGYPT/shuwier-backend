<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\SkillResource;
use App\Services\Contracts\SkillServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * @group Skills
 * 
 * APIs for managing skills and retrieving skill data
 */
class SkillController extends Controller
{
    protected $skillService;

    public function __construct(SkillServiceInterface $skillService)
    {
        $this->skillService = $skillService;
    }

    /**
     * Get all skills
     * 
     * Retrieve all available skills in the system. Skills are used by freelancers 
     * to indicate their expertise and by clients to find suitable freelancers.
     * Use this endpoint to populate skill selection lists in user profiles or search filters.
     * 
     * @response 200 {
     *   "message": "Success",
     *   "status": true,
     *   "data": {
     *     "data": [
     *       {
     *         "id": 1,
     *         "name": "JavaScript"
     *       },
     *       {
     *         "id": 2,
     *         "name": "React"
     *       },
     *       {
     *         "id": 3,
     *         "name": "Laravel"
     *       },
     *       {
     *         "id": 4,
     *         "name": "Adobe Photoshop"
     *       },
     *       {
     *         "id": 5,
     *         "name": "Node.js"
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "An error occurred while retrieving skills",
     *   "status": false,
     *   "error_num": 400
     * }
     */
    public function index()
    {
        $result = $this->skillService->getAll();

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(SkillResource::collection($result['data']))
        );
    }
}
