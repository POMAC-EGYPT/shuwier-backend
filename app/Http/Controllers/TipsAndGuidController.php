<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\TipsAndGuidResource;
use App\Services\Contracts\TipsAndGuidServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @group Public Tips & Guides
 * 
 * Public APIs for accessing tips and guides content. These endpoints provide helpful advice 
 * and best practices for platform users without requiring authentication. Content is available 
 * in both English and Arabic languages to help users understand platform functionality and 
 * improve their freelancing or client experience.
 */
class TipsAndGuidController extends Controller
{

    public function __construct(protected TipsAndGuidServiceInterface $tipsAndGuidService) {}

    /**
     * Get Tips & Guides List.
     * 
     * Retrieve a paginated list of tips and guides available to all users. This endpoint allows 
     * filtering by search terms and supports pagination. The content includes helpful advice 
     * and best practices for both freelancers and clients in multiple languages.
     * 
     * @queryParam search string optional Search term to filter tips and guides by title or description. Example: freelancing
     * @queryParam per_page integer optional Number of items per page (1-50, default 10). Example: 15
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
     *         "description_en": "Learn the essential tips for building a successful freelancing career including client communication, time management, and portfolio development.",
     *         "description_ar": "تعلم النصائح الأساسية لبناء مهنة ناجحة في العمل الحر بما في ذلك التواصل مع العملاء وإدارة الوقت وتطوير الملف الشخصي.",
     *         "image": "storage/tips-guides/freelancing-best-practices.jpg",
     *         "created_at": "2025-11-09T10:00:00.000000Z",
     *         "updated_at": "2025-11-09T10:00:00.000000Z"
     *       },
     *       {
     *         "id": 2,
     *         "title_en": "Client Hiring Guide",
     *         "title_ar": "دليل توظيف العملاء",
     *         "description_en": "A comprehensive guide for clients on how to find, evaluate, and hire the right freelancers for their projects.",
     *         "description_ar": "دليل شامل للعملاء حول كيفية العثور على المستقلين المناسبين وتقييمهم وتوظيفهم لمشاريعهم.",
     *         "image": "storage/tips-guides/client-hiring-guide.jpg",
     *         "is_popular": false,
     *         "created_at": "2025-11-09T11:00:00.000000Z",
     *         "updated_at": "2025-11-09T11:00:00.000000Z"
     *       }
     *     ],
     *     "current_page": 1,
     *     "last_page": 1,
     *     "per_page": 15,
     *     "total": 2
     *   }
     * }
     *
     * @response 200 scenario="Empty results" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Tips and guides retrieved successfully",
     *   "data": {
     *     "data": [],
     *     "current_page": 1,
     *     "last_page": 1,
     *     "per_page": 15,
     *     "total": 0
     *   }
     * }
     *
     * @response 400 scenario="Invalid parameters" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The per_page must be at least 1."
     * }
     *
     * @response 400 scenario="Per page too large" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The per_page may not be greater than 50."
     * }
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search'   => 'nullable|string',
            'per_page' => 'nullable|integer|min:1|max:50',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->tipsAndGuidService->getAllPaginated($request->search, $request->per_page);

        if (!$result['status'])
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
     * Get Tips & Guides Item Details.
     * 
     * Retrieve detailed information about a specific tip or guide item by its ID. This endpoint 
     * returns the complete content including multilingual titles, descriptions, and associated 
     * images. The content is publicly accessible without authentication.
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
     *     "description_en": "Learn the essential tips for building a successful freelancing career including client communication, time management, and portfolio development. This comprehensive guide covers everything from setting your rates to managing multiple projects effectively.",
     *     "description_ar": "تعلم النصائح الأساسية لبناء مهنة ناجحة في العمل الحر بما في ذلك التواصل مع العملاء وإدارة الوقت وتطوير الملف الشخصي. يغطي هذا الدليل الشامل كل شيء من تحديد الأسعار إلى إدارة المشاريع المتعددة بفعالية.",
     *     "image": "storage/tips-guides/freelancing-best-practices.jpg",
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
     * @response 400 scenario="Invalid ID format" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Invalid tips and guide ID"
     * }
     */
    public function show(string $id)
    {
        $result = $this->tipsAndGuidService->getById((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(new TipsAndGuidResource($result['data']))
        );
    }
}
