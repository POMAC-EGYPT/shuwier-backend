<?php

namespace App\Repository\Contracts;

use App\Models\PortfolioAttachment;
use Illuminate\Database\Eloquent\Collection;

interface PortfolioAttachmentRepositoryInterface
{
    public function create(array $data): PortfolioAttachment;

    public function getByPortfolioId(int $portfolioId): Collection;

    public function findById(int $id): PortfolioAttachment;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
