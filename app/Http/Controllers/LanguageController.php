<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\LanguageResource;
use App\Services\Contracts\LanguageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LanguageController extends Controller
{
    /**
     * @group Languages
     * APIs for managing and retrieving languages in the system.
     */
    protected $languageService;

    public function __construct(LanguageServiceInterface $languageService)
    {
        $this->languageService = $languageService;
    }

    /**
     * Get All Languages
     * 
     * Retrieve a list of all available languages in the system.
     * 
     * @group Languages
     * @response 200 {
     *   "message": "Languages retrieved successfully",
     *   "status": true,
     *   "error_num": null,
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "English",
     *       "code": "en",
     *       "created_at": "2025-09-15T10:00:00.000000Z",
     *       "updated_at": "2025-09-15T10:00:00.000000Z"
     *     },
     *     {
     *       "id": 2,
     *       "name": "Arabic",
     *       "code": "ar",
     *       "created_at": "2025-09-15T10:00:00.000000Z",
     *       "updated_at": "2025-09-15T10:00:00.000000Z"
     *     }
     *   ]
     * }
     */
    public function index()
    {
        $result = $this->languageService->getAll();

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(LanguageResource::collection($result['data']))
        );
    }
}
