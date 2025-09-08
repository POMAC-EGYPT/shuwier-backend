<?php

namespace App\Repository\Eloquent;

use App\Models\Hashtag;
use App\Repository\Contracts\HashtagRepositoryInterface;

class HashtagRepository implements HashtagRepositoryInterface
{
    public function firstOrCreate(array $data): mixed
    {
        return Hashtag::firstOrCreate($data);
    }
}
