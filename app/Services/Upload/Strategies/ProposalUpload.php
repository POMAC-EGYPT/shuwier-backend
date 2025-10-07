<?php

namespace App\Services\Upload\Strategies;

use App\Helpers\ImageHelpers;
use App\Models\ProposalAttachment;
use App\Repository\Contracts\ProposalAttachmentRepositoryInterface;
use App\Services\Upload\Contracts\UploadStrategyInterface;

class ProposalUpload implements UploadStrategyInterface
{
    protected $proposalAttachmentRepo;

    public function __construct(ProposalAttachmentRepositoryInterface $proposalAttachmentRepo)
    {
        $this->proposalAttachmentRepo = $proposalAttachmentRepo;
    }

    public function supports(string $type): bool
    {
        return $type === 'proposal';
    }

    public function store($file, int $userId): ProposalAttachment
    {
        $path = ImageHelpers::addImage($file, 'proposals');

        $attachment = $this->proposalAttachmentRepo->create([
            'file_path'    => $path,
            'proposal_id'  => null,
            'user_id'      => $userId,
        ]);

        return $attachment;
    }
}
