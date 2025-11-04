<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\PortfolioResource;
use App\Services\Contracts\PortfolioServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PortfolioController extends Controller
{
    protected $portfolioService;

    public function __construct(PortfolioServiceInterface $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }


    /**
     * Get specific portfolio
     * 
     * Retrieve a specific portfolio by its ID with all related data.
     * 
     * @urlParam id integer required The portfolio ID. Example: 1
     * 
     * @response 200 {
     *   "message": "Success",
     *   "status": true,
     *   "data": {
     *     "id": 1,
     *     "title": "E-commerce Website",
     *     "description": "A modern responsive e-commerce website",
     *     "cover_photo": "storage/portfolios/68ee0f54b6ee8.PNG",
     *     "category": {
     *       "id": 1,
     *       "name": "Web Development"
     *     },
     *     "subcategory": {
     *       "id": 2,
     *       "name": "Frontend"
     *     },
     *     "hashtags": ["#react", "#ecommerce"],
     *     "attachments": [
     *       {
     *         "id": 1,
     *         "file_path": "storage/portfolios/image1.jpg"
     *       }
     *     ]
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "Portfolio not found",
     *   "status": false,
     *   "error_code": 400
     * }
     * 
     */
    public function show(string $id)
    {
        $result = $this->portfolioService->getById((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(PortfolioResource::make($result['data'])));
    }
}
