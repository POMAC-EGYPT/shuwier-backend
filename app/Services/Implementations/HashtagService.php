<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\HashtagRepositoryInterface;
use App\Services\Contracts\HashtagServiceInterface;

class HashtagService implements HashtagServiceInterface
{
    protected $hashtagRepository;

    public function __construct(HashtagRepositoryInterface $hashtagRepository)
    {
        $this->hashtagRepository = $hashtagRepository;
    }

    public function getAllWithSearchPaginated(?string $search = null, ?int $perPage = 50): array
    {
        $hashtags = $this->hashtagRepository->getAllWithSearchPaginated($search, $perPage);

        return ['status' => 'success', 'message' => __('message.success'), 'data' => $hashtags];
    }
}
