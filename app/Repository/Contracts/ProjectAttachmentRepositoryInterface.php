<?php

namespace App\Repository\Contracts;

use App\Models\ProjectAttachment;
use Illuminate\Database\Eloquent\Collection;

interface ProjectAttachmentRepositoryInterface
{
    public function getByProjectId(int $projectId): Collection;

    public function findById(int $id): ?ProjectAttachment;

    public function create(array $data): ProjectAttachment;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}