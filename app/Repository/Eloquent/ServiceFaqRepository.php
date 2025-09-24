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

    public function deleteByServiceId(int $serviceId): bool
    {
        return ServiceFaq::where('service_id', $serviceId)->delete();
    }
}
