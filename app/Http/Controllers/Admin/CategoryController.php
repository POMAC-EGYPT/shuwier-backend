<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\GetCategoryRequest;
use App\Http\Requests\Admin\Category\StoreAllCategoryWithChildrensRequest;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\CategoryResource;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(GetCategoryRequest $request)
    {
        $categories = $this->categoryService->getAllPaginated(
            $request->type,
            $request->search,
            $request->per_page ?? 10
        );

        return Response::api(
            __('message.success'),
            200,
            true,
            null,
            BaseResource::make(CategoryResource::collection($categories))
        );
    }

    public function store(StoreCategoryRequest $request)
    {
        $result = $this->categoryService->create([
            'name_en'   => $request->name_en,
            'name_ar'   => $request->name_ar,
            'parent_id' => $request->parent_id,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(
            $result['message'],
            201,
            true,
            null,
            BaseResource::make(CategoryResource::make($result['data']))
        );
    }

    public function storeAllWithChildrens(StoreAllCategoryWithChildrensRequest $request)
    {
        $result = $this->categoryService->createAllWithChildrens([
            'name_en'             => $request->name_en,
            'name_ar'             => $request->name_ar,
            'childrens'           => $request->childrens ?? null,
        ]);

        return Response::api($result['message'], 201, true, null);
    }

    public function show(string $id)
    {
        $category = $this->categoryService->getById((int) $id);

        return Response::api(
            __('message.success'),
            200,
            true,
            null,
            BaseResource::make(CategoryResource::make($category))
        );
    }

    public function update(Request $request, string $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'name_en' => 'required_without:name_ar|string|max:255',
        //     'name_ar' => 'required_without:name_en|string|max:255',
        // ]);

        // if ($validator->fails())
        //     return Response::api($validator->errors()->first(), 400, false, 400);

        // $category = $this->categoryService->update((int) $id, [
        //     'name_en' => $request->name_en ?? null,
        //     'name_ar' => $request->name_ar ?? null,
        // ]);

        // return Response::api(
        //     __('message.success'),
        //     200,
        //     true,
        //     null,
        //     BaseResource::make(CategoryResource::make($category))
        // );
    }

    public function destroy(string $id)
    {
        $this->categoryService->delete((int) $id);

        return Response::api(__('message.success'), 200, true, null);
    }
}
