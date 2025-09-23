<?php

namespace App\Services\Contracts;

interface HashtagServiceInterface
{

    public function getAllWithSearchPaginated(?string $search = null, ?int $perPage = 50): array;
}