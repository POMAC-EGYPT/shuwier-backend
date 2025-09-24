<?php

namespace App\Repository\Contracts;

use App\Models\ServiceAttachment;

interface ServiceAttachmentRepositoryInterface
{
    public function findById(int $id): ?ServiceAttachment;

    public function create(array $data): ServiceAttachment;

    public function update(int $id, array $data): bool;
}
