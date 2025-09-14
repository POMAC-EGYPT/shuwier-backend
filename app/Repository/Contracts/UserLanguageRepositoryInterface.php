<?php

namespace App\Repository\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface UserLanguageRepositoryInterface
{
    public function getUserLanguages(int $userId): Collection;

    public function syncUserLanguages(int $userId, array $languageData): bool;
}
