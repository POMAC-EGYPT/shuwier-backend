<?php

namespace App\Services\Implementations;

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

    public function getAllPaginated(?string $type = null, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator
    {
        $categories = $type === 'parent'
            ? $this->categoryRepo->getParentsPaginated(true, $search, $perPage)
            : ($type === 'child'
                ? $this->categoryRepo->getChildrensPaginated($search, $perPage)
                : $this->categoryRepo->getAllPaginated(true, $search, $perPage)
            );

        return $categories;
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

        $category = $this->categoryRepo->create([
            'name_en'   => $data['name_en'],
            'name_ar'   => $data['name_ar'],
            'parent_id' => $data['parent_id'] ?? null,
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
        $this->categoryRepo->find($id, true);

        if ($data['parent_id'] != null) {
            $parent = $this->categoryRepo->find($data['parent_id'], true);

            if ($parent->parent_id != null)
                return ['status' => false, 'message' => __('message.cannot_add_subcategory_to_child')];
        }

        $this->categoryRepo->update($id, [
            'name_en' => $data['name_en'],
            'name_ar' => $data['name_ar'],
            'parent_id' => $data['parent_id'],
        ]);

        return [
            'status'  => true,
            'message' => __('message.category_updated_successfully'),
        ];
    }

    public function delete(int $id): bool
    {
        return $this->categoryRepo->delete($id);
    }
}
