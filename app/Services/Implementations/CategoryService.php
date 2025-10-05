<?php

namespace App\Services\Implementations;

use App\Helpers\ImageHelpers;
use App\Models\Category;
use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAllPaginated(?string $type = null, ?int $parent_id = null, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator
    {
        $categories = $type === 'parent'
            ? $this->categoryRepo->getParentsPaginated(true, $search, $perPage)
            : ($type === 'child'
                ? $this->categoryRepo->getChildrensPaginated($parent_id, $search, $perPage)
                : $this->categoryRepo->getAllPaginated(true, $search, $perPage)
            );

        return $categories;
    }

    public function getParentCategories(): array
    {
        $categories = $this->categoryRepo->getParents();

        return ['status' => true, 'message' => __('message.success'), 'data' => $categories];
    }

    public function getChildCategories(): array
    {
        $categories = $this->categoryRepo->getChildrens();

        return ['status' => true, 'message' => __('message.success'), 'data' => $categories];
    }

    public function getById(int $id): null | Category
    {
        return $this->categoryRepo->find($id, true);
    }

    public function create(array $data): array
    {
        if ($data['parent_id'] != null) {
            $parent = $this->categoryRepo->find($data['parent_id'], true);

            if ($parent->parent_id != null)
                return ['status' => false, 'message' => __('message.cannot_add_subcategory_to_child')];
        }
        if (isset($data['image']) && $data['image'] != null && $data['parent_id'] == null)

            $imagePath = ImageHelpers::addImage($data['image'], 'categories');

        $category = $this->categoryRepo->create([
            'name_en'   => $data['name_en'],
            'name_ar'   => $data['name_ar'],
            'parent_id' => $data['parent_id'] ?? null,
            'image'     => $imagePath ?? null,
        ]);

        return ['status' => true, 'message' => __('message.category_created_successfully'), 'data' => $category];
    }

    public function createAllWithChildrens(array $data): array
    {
        $parentCategory = $this->create([
            'name_en'   => $data['name_en'],
            'name_ar'   => $data['name_ar'],
            'parent_id' => null,
        ]);

        if (isset($data['childrens']) && $data['childrens'] != null)
            foreach ($data['childrens'] as $child)
                $this->create([
                    'name_en'   => $child['name_en'],
                    'name_ar'   => $child['name_ar'],
                    'parent_id' => $parentCategory['data']->id,
                ]);

        return [
            'status' => true,
            'message' => __('message.categories_created_successfully'),
        ];
    }

    public function update(int $id, array $data): array
    {
        $category = $this->categoryRepo->find($id, true);

        if ($data['parent_id'] != null) {
            $parent = $this->categoryRepo->find($data['parent_id'], true);

            if ($data['parent_id'] == $id)
                return ['status' => false, 'message' => __('message.cannot_set_category_as_its_own_parent')];

            if ($parent->parent_id != null)
                return ['status' => false, 'message' => __('message.cannot_add_subcategory_to_child')];
        }

        if (isset($data['image']) && $data['image'] != null && $data['parent_id'] == null) {
            ImageHelpers::deleteImage($category->image);

            $imagePath = ImageHelpers::addImage($data['image'], 'categories');
        }

        $this->categoryRepo->update($id, [
            'name_en' => $data['name_en'],
            'name_ar' => $data['name_ar'],
            'parent_id' => $data['parent_id'],
            'image' => $imagePath ?? $category->image,
        ]);

        $category->refresh();

        return [
            'status'  => true,
            'message' => __('message.category_updated_successfully'),
            'data'    => $category,
        ];
    }

    public function delete(int $id): bool
    {
        $category = $this->categoryRepo->find($id);

        ImageHelpers::deleteImage($category->image);

        return $this->categoryRepo->delete($id);
    }
}
