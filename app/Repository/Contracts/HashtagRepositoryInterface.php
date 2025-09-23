<?php

namespace App\Repository\Contracts;

interface HashtagRepositoryInterface
{
    public function getAllWithSearchPaginated(?string $search = null, ?int $perPage = 50): mixed;

    public function firstOrCreate(array $data): mixed;
}
