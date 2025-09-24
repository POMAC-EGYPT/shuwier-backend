<?php

namespace App\Repository\Eloquent;

use App\Models\ServiceFaq;
use App\Repository\Contracts\ServiceFaqRepositoryInterface;

class ServiceFaqRepository implements ServiceFaqRepositoryInterface
{
    public function create(array $data): ServiceFaq
    {
        return ServiceFaq::create($data);
    }
}