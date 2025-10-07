<?php

namespace App\Repository\Eloquent;

use App\Models\ProposalAttachment;
use App\Repository\Contracts\ProposalAttachmentRepositoryInterface;

class ProposalAttachmentRepository implements ProposalAttachmentRepositoryInterface
{
    public function findById(int $id): ProposalAttachment
    {
        return ProposalAttachment::find($id);
    }

    public function create(array $data): ProposalAttachment
    {
        return ProposalAttachment::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $attachment = $this->findById($id);

        return $attachment->update($data);
    }
}
