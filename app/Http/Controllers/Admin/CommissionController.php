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
            'created_by'     => auth('admin')->id(),
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
}
