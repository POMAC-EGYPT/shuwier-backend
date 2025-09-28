<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\CommissionResource;
use App\Services\Contracts\CommissionServiceInterface;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CommissionController extends Controller
{
    protected $commissionService;

    public function __construct(CommissionServiceInterface $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    /**
     * List commissions
     * 
     * Retrieve a paginated list of all commission rates in the system. This endpoint allows
     * admins to view and search through commission rates with optional filtering by search terms.
     * Results are ordered by creation date (newest first).
     * 
     * @authenticated
     * @group Admin Commission Management
     * 
     * @queryParam search string optional Search term to filter commissions by rate or effective date. Example: 15
     * @queryParam per_page integer optional Number of items per page (1-100). Example: 15
     * 
     * @response 200 scenario="Commissions retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 1,
     *         "rate": 0.15,
     *         "effective_from": "2025-10-01",
     *         "created_by": 1,
     *         "created_at": "2025-09-28T10:00:00.000000Z",
     *         "updated_at": "2025-09-28T10:00:00.000000Z"
     *       },
     *       {
     *         "id": 2,
     *         "rate": 0.12,
     *         "effective_from": "2025-11-01",
     *         "created_by": 1,
     *         "created_at": "2025-09-27T15:30:00.000000Z",
     *         "updated_at": "2025-09-27T15:30:00.000000Z"
     *       }
     *     ],
     *     "first_page_url": "http://localhost/api/admin/commissions?page=1",
     *     "from": 1,
     *     "last_page": 1,
     *     "last_page_url": "http://localhost/api/admin/commissions?page=1",
     *     "links": [
     *       {
     *         "url": null,
     *         "label": "&laquo; Previous",
     *         "active": false
     *       },
     *       {
     *         "url": "http://localhost/api/admin/commissions?page=1",
     *         "label": "1",
     *         "active": true
     *       },
     *       {
     *         "url": null,
     *         "label": "Next &raquo;",
     *         "active": false
     *       }
     *     ],
     *     "next_page_url": null,
     *     "path": "http://localhost/api/admin/commissions",
     *     "per_page": 10,
     *     "prev_page_url": null,
     *     "to": 2,
     *     "total": 2
     *   }
     * }
     * 
     * @response 400 scenario="Invalid parameters" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The per page field must be at least 1."
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
            'search'   => 'sometimes|string|nullable',
            'per_page' => 'sometimes|integer|min:1|max:100',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->commissionService->getAllPaginated($request->search, $request->per_page ?? 10);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(CommissionResource::collection($result['data']))
        );
    }

    /**
     * Create commission
     * 
     * Create a new commission rate that will be effective from a specified future date.
     * The commission rate is stored as a decimal (e.g., 15% is stored as 0.15) and must
     * be between 1% and 100%. The effective date must be today or in the future.
     * 
     * @authenticated
     * @group Admin Commission Management
     * 
     * @bodyParam rate number required Commission rate percentage (1-100). Will be converted to decimal for storage. Example: 15
     * @bodyParam effective_from date required Date when this commission rate becomes effective (today or future). Example: 2025-10-01
     * 
     * @response 200 scenario="Commission created successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Commission created successfully",
     *   "data": {
     *     "id": 3,
     *     "rate": 0.15,
     *     "effective_from": "2025-10-01",
     *     "created_by": 1,
     *     "created_at": "2025-09-28T12:00:00.000000Z",
     *     "updated_at": "2025-09-28T12:00:00.000000Z"
     *   }
     * }
     * 
     * @response 400 scenario="Invalid rate" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The rate field must be between 1 and 100."
     * }
     * 
     * @response 400 scenario="Invalid effective date" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The effective from field must be a date after or equal to today."
     * }
     * 
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The rate field is required."
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rate'           => 'required|numeric|min:1|max:100',
            'effective_from' => 'required|date|after_or_equal:today',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->commissionService->create([
            'rate'           => $request->rate,
            'effective_from' => $request->effective_from,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(CommissionResource::make($result['data']))
        );
    }

    /**
     * Update commission
     * 
     * Update an existing commission rate. Only commissions with future effective dates
     * can be updated. The system prevents updating commissions that are already effective
     * (today or past dates). At least one field must be different from current values.
     * 
     * @authenticated
     * @group Admin Commission Management
     * 
     * @urlParam id integer required Commission ID to update. Example: 1
     * 
     * @bodyParam rate number optional New commission rate percentage (1-100). Will be converted to decimal for storage. Example: 18
     * @bodyParam effective_from date optional New effective date (today or future). Example: 2025-11-01
     * 
     * @response 200 scenario="Commission updated successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Commission updated successfully",
     *   "data": {
     *     "id": 1,
     *     "rate": 0.18,
     *     "effective_from": "2025-11-01",
     *     "created_by": 1,
     *     "created_at": "2025-09-28T10:00:00.000000Z",
     *     "updated_at": "2025-09-28T14:30:00.000000Z"
     *   }
     * }
     * 
     * @response 400 scenario="Commission already effective" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Cannot update commission effective from today or past"
     * }
     * 
     * @response 400 scenario="No changes provided" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Please provide different values to update"
     * }
     * 
     * @response 400 scenario="Invalid rate" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The rate field must be between 1 and 100."
     * }
     * 
     * @response 404 scenario="Commission not found" {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Commission not found"
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'rate'           => 'sometimes|numeric|min:1|max:100',
            'effective_from' => 'sometimes|date|after_or_equal:today',
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->commissionService->update((int) $id, [
            'rate'           => $request->rate,
            'effective_from' => $request->effective_from,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(CommissionResource::make($result['data']))
        );
    }

    /**
     * Delete commission
     * 
     * Delete a commission rate from the system. Only commissions with future effective
     * dates can be deleted. The system prevents deletion of commissions that are already
     * effective (today or past dates) to maintain historical data integrity.
     * 
     * @authenticated
     * @group Admin Commission Management
     * 
     * @urlParam id integer required Commission ID to delete. Example: 1
     * 
     * @response 200 scenario="Commission deleted successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Commission deleted successfully"
     * }
     * 
     * @response 400 scenario="Commission already effective" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Cannot delete commission effective from today or past"
     * }
     * 
     * @response 404 scenario="Commission not found" {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Commission not found"
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function destroy($id)
    {
        $result = $this->commissionService->delete((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }
}
