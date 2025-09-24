<?php

namespace App\Repository\Contracts;

use App\Models\ServiceAttachment;
use Illuminate\Database\Eloquent\Collection;

interface ServiceAttachmentRepositoryInterface
{
    public function getByServiceId(int $serviceId): Collection;

    public function findById(int $id): ?ServiceAttachment;

    public function create(array $data): ServiceAttachment;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
