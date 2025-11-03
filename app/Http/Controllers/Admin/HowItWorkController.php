<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HowItWorkRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\HowItWorkResource;
use App\Services\Contracts\HowItWorkServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class HowItWorkController extends Controller
{
    protected $howItWorkService;

    public function __construct(HowItWorkServiceInterface $howItWorkService)
    {
        $this->howItWorkService = $howItWorkService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search'   => 'sometimes|nullable|string',
            'type'     => 'sometimes|in:freelancer,client',
            'per_page' => 'sometimes|integer|min:1'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->howItWorkService->getAllPaginated($request->search, $request->type, $request->per_page);

        if ($result['status'] === false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(HowItWorkResource::collection($result['data']))
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HowItWorkRequest $request)
    {
        $result = $this->howItWorkService->create([
            'title_en'       => $request->title_en,
            'title_ar'       => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'type'           => $request->type,
            'image'          => $request->image,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(HowItWorkResource::make($result['data']))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->howItWorkService->getById((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(HowItWorkResource::make($result['data']))
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HowItWorkRequest $request, string $id)
    {
        $result = $this->howItWorkService->update((int) $id, [
            'title_en'       => $request->title_en,
            'title_ar'       => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'type'           => $request->type,
            'image'          => $request->image ?? null,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->howItWorkService->delete((int) $id);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }
}
