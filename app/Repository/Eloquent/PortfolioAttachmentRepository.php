<?php

namespace App\Repository\Eloquent;

use App\Models\PortfolioAttachment;
use App\Repository\Contracts\PortfolioAttachmentRepositoryInterface;

class PortfolioAttachmentRepository implements PortfolioAttachmentRepositoryInterface
{
    public function create(array $data): PortfolioAttachment
    {
        return PortfolioAttachment::create($data);
    }

    public function delete(int $id): bool
    {
        $attachment = PortfolioAttachment::findOrFail($id);

        return $attachment->delete();
    }
}
