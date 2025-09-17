<?php

namespace App\Repository\Eloquent;

use App\Models\Skill;
use App\Repository\Contracts\SkillRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SkillRepository implements SkillRepositoryInterface
{
    public function getAllPaginated(?string $search = null, ?int $perPage = 10): LengthAwarePaginator
    {
        return Skill::with('category')->when($search, function ($query) use ($search) {
            $query->where('name_ar', 'like', '%' . $search . '%')
                ->orWhere('name_en', 'like', '%' . $search . '%');
        })->paginate($perPage);
    }

    public function getAll(): ?Collection
    {
        return Skill::all();
    }

    public function findById($id): ?Skill
    {
        return Skill::with('category')->findOrFail($id);
    }

    public function create(array $data): Skill
    {
        $skill = Skill::create($data);

        return $skill->load('category');
    }

    public function update(int $id, array $data): bool
    {
        $skill = $this->findById($id);

        return $skill->update($data);
    }

    public function delete(int $id): bool
    {
        $skill = $this->findById($id);

        return $skill->delete();
    }
}
