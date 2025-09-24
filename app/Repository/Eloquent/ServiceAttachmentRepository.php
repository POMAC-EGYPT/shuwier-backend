<?php

namespace App\Repository\Eloquent;

use App\Models\ServiceAttachment;
use App\Repository\Contracts\ServiceAttachmentRepositoryInterface;

class ServiceAttachmentRepository implements ServiceAttachmentRepositoryInterface
{
    public function findById(int $id): ?ServiceAttachment
    {
        return ServiceAttachment::findOrFail($id);
    }

    public function create(array $data): ServiceAttachment
    {
        return ServiceAttachment::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $attachment = $this->findById($id);

        return $attachment->update($data);
    }
}
