<?php

namespace App\Services\Contracts;

interface HomeServiceInterface
{
    public function guestHome(int $limitCategory = 8, int $limitService = 10): array;
}
