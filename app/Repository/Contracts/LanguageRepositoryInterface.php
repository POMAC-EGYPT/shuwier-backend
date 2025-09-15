<?php

namespace App\Repository\Contracts;

use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

interface LanguageRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?Language;

    public function getByUserId(int $userId): ?Collection;
}