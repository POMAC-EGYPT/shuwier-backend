<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Freelancer\Service\StoreServiceRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ServiceResource;
use App\Services\Contracts\ServiceServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceServiceInterface $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'per_page' => 'sometimes|integer|min:1'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->serviceService->getByFreelancerIdPaginated(auth('api')->id(), $request->per_page ?? 10);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(ServiceResource::collection($result['data'])));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $result = $this->serviceService->create([
            'title'              => $request->title,
            'description'        => $request->description,
            'category_id'        => $request->category_id,
            'subcategory_id'     => $request->subcategory_id,
            'delivery_time_unit' => $request->delivery_time_unit,
            'delivery_time'      => $request->delivery_time,
            'fees_type'          => $request->fees_type,
            'price'              => $request->price,
            'cover_photo'        => $request->cover_photo,
            'hashtags'           => $request->hashtags,
            'attachment_ids'     => $request->attachment_ids,
            'faqs'               => $request->faqs,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(new ServiceResource($result['data'])));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
