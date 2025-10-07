<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\CommissionResource;
use App\Services\Contracts\CommissionServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommissionController extends Controller
{
    protected $commissionService;

    public function __construct(CommissionServiceInterface $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    /**
     * Get current commission rates
     * 
     * Retrieve the latest commission rates and fee structure used by the platform.
     * This endpoint provides information about platform commission percentages,
     * payment processing fees, and other charges that apply to transactions.
     * This information is typically used for calculating final amounts in proposals,
     * payments, and displaying fee breakdowns to users.
     * 
     * @group Commissions
     * 
     * @response 200 scenario="Commission rates retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Commission rates retrieved successfully",
     *   "data": {
    *     "id": 1,
    *     "rate": 10.0,
    *     "effective_from": "2025-10-01T00:00:00.000000Z",
    *     "created_by": 1,
    *     "created_at": "2025-09-28T10:30:00.000000Z",
    *     "updated_at": "2025-10-01T14:20:00.000000Z",
     *   }
     * }
     * 
     * @response 200 scenario="No commission rates found" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "No commission rates configured",
     *   "data": null
     * }
     * 
     * @response 500 scenario="Server error" {
     *   "status": false,
     *   "error_num": 500,
     *   "message": "Unable to retrieve commission rates"
     * }
     */
    public function index()
    {
        $result = $this->commissionService->getLast();

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(CommissionResource::make($result['data']))
        );
    }
}
