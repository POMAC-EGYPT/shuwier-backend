<?php

namespace App\Repository\Eloquent;

use App\Models\UserLanguage;
use App\Repository\Contracts\UserLanguageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserLanguageRepository implements UserLanguageRepositoryInterface
{
    public function getUserLanguages(int $userId): Collection
    {
        return UserLanguage::where('user_id', $userId)->get();
    }
    public function syncUserLanguages(int $userId, array $languageDatas): bool
    {
        $userLanguages = $this->getUserLanguages($userId);

        foreach ($userLanguages as $userLanguage)
            $userLanguage->delete();

        foreach ($languageDatas as $languageData)
            UserLanguage::create([
                'user_id'        => $userId,
                'language_id'    => $languageData['language_id'],
                'language_level' => $languageData['language_level'],
            ]);

        return true;
    }
}
