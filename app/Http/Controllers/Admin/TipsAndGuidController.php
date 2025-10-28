<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TipsAndGuidRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\TipsAndGuidResource;
use App\Services\Contracts\TipsAndGuidServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class TipsAndGuidController extends Controller
{
    protected $tipsAndGuidService;

    public function __construct(TipsAndGuidServiceInterface $tipsAndGuidService)
    {
        $this->tipsAndGuidService = $tipsAndGuidService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search'   => 'sometimes|nullable|string',
            'per_page' => 'sometimes|integer|min:1'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->tipsAndGuidService->getAllPaginated($request->search, $request->per_page);

        if ($result['status'] == false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(TipsAndGuidResource::collection($result['data']))
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipsAndGuidRequest $request)
    {
        $result = $this->tipsAndGuidService->create([
            'title_en'       => $request->title_en,
            'title_ar'       => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'image'          => $request->image ?? null,
        ]);

        if ($result['status'] == false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            201,
            true,
            null,
            BaseResource::make(TipsAndGuidResource::make($result['data']))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->tipsAndGuidService->getById((int) $id);

        if ($result['status'] == false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(TipsAndGuidResource::make($result['data']))
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipsAndGuidRequest $request, string $id)
    {
        $result = $this->tipsAndGuidService->update((int) $id, [
            'title_en'       => $request->title_en,
            'title_ar'       => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'image'          => $request->image ?? null,
        ]);

        if ($result['status'] == false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->tipsAndGuidService->delete((int) $id);

        if ($result['status'] == false)
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null);
    }
}
