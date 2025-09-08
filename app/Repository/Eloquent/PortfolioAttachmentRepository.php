<?php

namespace App\Repository\Eloquent;

use App\Models\PortfolioAttachment;
use App\Repository\Contracts\PortfolioAttachmentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PortfolioAttachmentRepository implements PortfolioAttachmentRepositoryInterface
{
    public function create(array $data): PortfolioAttachment
    {
        return PortfolioAttachment::create($data);
    }

    public function getByPortfolioId(int $portfolioId): Collection
    {
        return PortfolioAttachment::where('portfolio_id', $portfolioId)->get();
    }

    public function delete(int $id): bool
    {
        $attachment = PortfolioAttachment::findOrFail($id);

        return $attachment->delete();
    }
}
