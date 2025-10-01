<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ServiceResource;
use App\Services\Contracts\HomeServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    protected $homeService;
    public function __construct(HomeServiceInterface $homeService)
    {
        $this->homeService = $homeService;
    }
    public function guestHome()
    {
        $result = $this->homeService->guestHome();

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, [
            'best_seller_categories' => BaseResource::make(
                CategoryResource::collection($result['data']['best_seller_categories'])
            ),
            'best_seller_services' => BaseResource::make(
                ServiceResource::collection($result['data']['best_seller_services'])
            )
        ]);
    }

    public function freelancerHome()
    {
        //
    }

    public function clientHome()
    {
        //
    }
}
