<?php

namespace App\Repository\Contracts;

use App\Models\ServiceFaq;

interface ServiceFaqRepositoryInterface
{
    public function create(array $data): ServiceFaq;
}