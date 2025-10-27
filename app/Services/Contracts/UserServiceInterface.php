<?php

namespace App\Services\Contracts;

interface UserServiceInterface
{
    public function getProfile(string $slug): array;
}
