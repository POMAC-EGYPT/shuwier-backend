<?php

namespace App\Services\Upload\Contracts;

use App\Models\PortfolioAttachment;

interface UploadStrategyInterface
{
    public function supports(string $type): bool;

    public function store($file, int $userId);
}
