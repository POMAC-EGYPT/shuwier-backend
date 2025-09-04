<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Repository\Contracts\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface
{
    private function search($query, ?string $search)
    {
        $query->where(function ($q) use ($search) {
            $q->where('name_en', 'like', "%{$search}%")
                ->orWhere('name_ar', 'like', "%{$search}%");
        });
    }

    public function getAllPaginated(bool $withChildren = false, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator
    {
        $categories = Category::query()
            ->when($search, fn($query) => $this->search($query, $search))
            ->paginate($perPage);

        return $withChildren ? $categories->load('children') : $categories;
    }

    public function getParentsPaginated(bool $withChildren = false, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator
    {
        $categories = Category::query()
            ->parents()
            ->when($search, fn($query) => $this->search($query, $search))
            ->paginate($perPage);

        return $withChildren ? $categories->load('children') : $categories;
    }

    public function getChildrensPaginated(?string $parent_id = null, ?string $search = null, ?int $perPage = 10): LengthAwarePaginator
    {
        return Category::query()
            ->childrens()
            ->when($parent_id, fn($query) => $query->where('parent_id', $parent_id))
            ->when($search, fn($query) => $this->search($query, $search))
            ->paginate($perPage);
    }

    public function find(int $id, bool $withChildren = false): ?Category
    {
        $category = Category::findOrFail($id);

        return $withChildren ? $category->load('children') : $category;
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $category = $this->find($id);

        return $category->update($data);
    }

    public function delete(int $id): bool
    {
        $category = $this->find($id);

        return $category->delete();
    }
}
