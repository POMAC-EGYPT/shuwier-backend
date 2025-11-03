<?php

namespace App\Services\Contracts;

interface HomeServiceInterface
{
    public function guestHome(int $limitCategory = 8, int $limitService = 10, int $limitHowItWorks = 10, int $limitTipsAndGuid = 10): array;
}
