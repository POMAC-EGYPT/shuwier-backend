<?php

namespace App\Repository\Eloquent;

use App\Models\ServiceAttachment;
use App\Repository\Contracts\ServiceAttachmentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceAttachmentRepository implements ServiceAttachmentRepositoryInterface
{
    public function getByServiceId(int $serviceId): Collection
    {
        return ServiceAttachment::where('service_id', $serviceId)->get();
    }
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

    public function delete(int $id): bool
    {
        $attachment = $this->findById($id);

        return $attachment->delete();
    }
}
