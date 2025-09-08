<?php

namespace App\Repository\Contracts;

use App\Models\PortfolioAttachment;

interface PortfolioAttachmentRepositoryInterface
{
    public function create(array $data): PortfolioAttachment;

    public function delete(int $id): bool;
}