<?php

namespace App\Repository\Contracts;

interface HashtagRepositoryInterface
{
    public function firstOrCreate(array $data): mixed;
}
