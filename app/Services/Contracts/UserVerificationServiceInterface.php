<?php

namespace App\Services\Contracts;

interface UserVerificationServiceInterface
{
    public function create(array $data): array;
}