<?php

namespace App\Repository\Eloquent;

use App\Models\Hashtag;
use App\Repository\Contracts\HashtagRepositoryInterface;

class HashtagRepository implements HashtagRepositoryInterface
{

    public function getAllWithSearchPaginated(?string $search = null, ?int $perPage = 50): mixed
    {
        return Hashtag::when($search, fn($q) => $q->where('name', 'like', '%' . $search . '%'))
            ->orderByDesc('created_at')->paginate($perPage);
    }

    public function firstOrCreate(array $data): mixed
    {
        return Hashtag::firstOrCreate($data);
    }
}
