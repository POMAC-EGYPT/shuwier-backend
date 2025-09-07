<?php

namespace App\Http\Controllers;

use App\Services\Contracts\PortfolioServiceInterface;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    protected $portfolioService;

    public function __construct(PortfolioServiceInterface $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }

    public function index(Request $request)
    {
        $userId = auth('api')->id();

        $portfolio = $this->portfolioService->listPortfoliosByUserId($userId, $request->per_page ?? 10);
    }
}
