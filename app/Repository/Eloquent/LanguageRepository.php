<?php

namespace App\Repository\Eloquent;

use App\Models\Language;
use App\Repository\Contracts\LanguageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LanguageRepository implements LanguageRepositoryInterface
{
    public function getAll(): Collection
    {
        return Language::all();
    }

    public function getById(int $id): ?Language
    {
        // Implementation to retrieve a language by its ID
        return null;
    }

    public function getByUserId(int $userId): ?Collection
    {
        return Language::where('user_id', $userId)->get();
    }
}
