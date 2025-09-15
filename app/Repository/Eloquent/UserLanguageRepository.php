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

        $languageDatas = array_filter($languageDatas, function ($item) {
            return is_array($item) && isset($item['language_id'], $item['language_level']);
        });

        if (empty($languageDatas)) 
            return true;

        foreach ($languageDatas as $languageData)
            UserLanguage::create([
                'user_id'        => $userId,
                'language_id'    => $languageData['language_id'],
                'language_level' => $languageData['language_level'],
            ]);

        return true;
    }
}
