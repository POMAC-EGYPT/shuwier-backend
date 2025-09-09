<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\SkillRepositoryInterface;
use App\Services\Contracts\SkillServiceInterface;

class SkillService implements SkillServiceInterface
{
    protected $skillRepo;
    protected $categoryRepo;

    public function __construct(SkillRepositoryInterface $skillRepo, CategoryRepositoryInterface $categoryRepo)
    {
        $this->skillRepo = $skillRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function getAllPaginated(?string $search = null, ?int $perPage = 10): array
    {
        $skills = $this->skillRepo->getAllPaginated($search, $perPage);

        return ['status' => true, 'message' => __('message.success'), 'data' => $skills];
    }

    public function getById(int $id): array
    {
        $skill = $this->skillRepo->findById($id);

        return ['status' => true, 'data' => $skill];
    }

    public function create(array $data): array
    {
        if (isset($data['category_id']) && $data['category_id'] != null) {
            $category = $this->categoryRepo->find($data['category_id'], false);

            if ($category->parent_id != null)
                return ['status' => false, 'message' => __('message.this_category_is_not_a_parent_category')];
        }

        $skill = $this->skillRepo->create([
            'name_ar'     => $data['name_ar'],
            'name_en'     => $data['name_en'],
            'category_id' => $data['category_id'] ?? null,
        ]);
        return ['status' => true, 'message' => __('message.skill_created_successfully'), 'data' => $skill];
    }

    public function update(int $id, array $data): array
    {
        if (isset($data['category_id']) && $data['category_id'] != null) {
            $category = $this->categoryRepo->find($data['category_id'], false);

            if ($category->parent_id != null)
                return ['status' => false, 'message' => __('message.this_category_is_not_a_parent_category')];
        }

        $skill = $this->skillRepo->findById($id);

        $skill = $this->skillRepo->update($id, [
            'name_ar'     => $data['name_ar'],
            'name_en'     => $data['name_en'],
            'category_id' => $data['category_id'] ?? null,
        ]);

        return ['status' => true, 'message' => __('message.skill_updated_successfully'), 'data' => $skill];
    }

    public function delete(int $id): array
    {
        $this->skillRepo->delete($id);

        return ['status' => true, 'message' => __('message.skill_deleted_successfully')];
    }
}
