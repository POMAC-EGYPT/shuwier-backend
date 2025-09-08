<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Freelancer\PortfolioRequest;
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

    public function index(Request $request)
    {
        $userId = auth('api')->id();

        $result = $this->portfolioService->listPortfoliosByUserId($userId, $request->per_page ?? 10);

        return Response::api($result['message'], 200, true, null, BaseResource::make(PortfolioResource::collection($result['data'])));
    }

    public function store(PortfolioRequest $request)
    {
        $result = $this->portfolioService->create([
            'title'          => $request->title,
            'description'    => $request->description,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id ?? null,
            'attachments'    => $request->attachments ?? null,
            'hashtags'       => $request->hashtags ?? null,
            'user_id'        => auth('api')->id(),
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(PortfolioResource::make($result['data'])));
    }

    public function show(string $id)
    {
        $result = $this->portfolioService->getPortfolioById((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(PortfolioResource::make($result['data'])));
    }

    public function update(PortfolioRequest $request, string $id)
    {
        $result = $this->portfolioService->update((int) $id, [
            'title'          => $request->title,
            'description'    => $request->description,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id ?? null,
            'attachments'    => $request->attachments ?? null,
            'hashtags'       => $request->hashtags ?? null,
            'user_id'        => auth('api')->id(),
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(PortfolioResource::make($result['data'])));
    }
}
