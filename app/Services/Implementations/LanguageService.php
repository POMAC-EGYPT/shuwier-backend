<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\LanguageRepositoryInterface;
use App\Services\Contracts\LanguageServiceInterface;

class LanguageService implements LanguageServiceInterface
{
    protected $languageRepo;

    public function __construct(LanguageRepositoryInterface $languageRepo)
    {
        $this->languageRepo = $languageRepo;
    }

    public function getAll(): array
    {
        $languages = $this->languageRepo->getAll();

        return ['status' => true, 'message' => __('message.success'), 'data' => $languages];
    }
}
