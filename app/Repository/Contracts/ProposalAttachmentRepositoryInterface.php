<?php

namespace App\Repository\Contracts;

use App\Models\ProposalAttachment;

interface ProposalAttachmentRepositoryInterface
{
    public function findById(int $id): ProposalAttachment;

    public function create(array $data): ProposalAttachment;

    public function update(int $id, array $data): bool;
}
