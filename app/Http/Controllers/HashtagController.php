<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\HashtagResource;
use App\Services\Contracts\HashtagServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @group Hashtags
 * 
 * APIs for managing hashtags and searching hashtag data
 */
class HashtagController extends Controller
{
    protected $hashtagService;

    public function __construct(HashtagServiceInterface $hashtagService)
    {
        $this->hashtagService = $hashtagService;
    }

    /**
     * Search hashtags
     * 
     * Search for hashtags by name/keyword with pagination. This endpoint is used to find existing hashtags
     * when creating portfolios or filtering content. Returns hashtags that match the search term.
     * Results are limited to 50 items per request for performance.
     * 
     * @queryParam search string required The search term to look for hashtags. Minimum 1 character, maximum 50 characters. Example: react
     * 
     * @response 200 scenario="Hashtags found successfully" {
     *   "message": "Success",
     *   "status": true,
     *   "data": {
     *     "data": [
     *       {
     *         "id": 1,
     *         "name": "react"
     *       },
     *       {
     *         "id": 2,
     *         "name": "reactjs"
     *       },
     *       {
     *         "id": 3,
     *         "name": "react-native"
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 200 scenario="No hashtags found" {
     *   "message": "Success",
     *   "status": true,
     *   "data": {
     *     "data": []
     *   }
     * }
     * 
     * @response 400 scenario="Validation error - Missing search parameter" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The search field is required."
     * }
     * 
     * @response 400 scenario="Validation error - Search term too long" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The search may not be greater than 50 characters."
     * }
     * 
     * @response 500 scenario="Server error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "An error occurred while searching hashtags"
     * }
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required|string|max:50',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->hashtagService->getAllWithSearchPaginated($request->search, 50);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(HashtagResource::collection($result['data'])));
    }
}
