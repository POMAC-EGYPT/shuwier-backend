<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\ServiceResource;
use App\Services\Contracts\ServiceServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceServiceInterface $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function show(string $id)
    {
        $result = $this->serviceService->getById((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            200,
            BaseResource::make(ServiceResource::make($result['data']))
        );
    }
}
