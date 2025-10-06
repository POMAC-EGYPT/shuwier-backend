<?php

namespace App\Repository\Eloquent;

use App\Models\ProjectAttachment;
use App\Repository\Contracts\ProjectAttachmentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProjectAttachmentRepository implements ProjectAttachmentRepositoryInterface

{
    public function getByProjectId(int $projectId): Collection
    {
        return ProjectAttachment::where('project_id', $projectId)->get();
    }

    public function findById(int $id): ?ProjectAttachment
    {
        return ProjectAttachment::findOrFail($id);
    }

    public function create(array $data): ProjectAttachment
    {
        return ProjectAttachment::create($data);
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
