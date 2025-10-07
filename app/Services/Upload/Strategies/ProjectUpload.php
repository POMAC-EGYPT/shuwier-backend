<?php

namespace App\Services\Upload\Strategies;

use App\Helpers\ImageHelpers;
use App\Models\ProjectAttachment;
use App\Repository\Contracts\ProjectAttachmentRepositoryInterface;
use App\Services\Upload\Contracts\UploadStrategyInterface;

class ProjectUpload implements UploadStrategyInterface
{
    protected $projectAttachmentRepo;

    public function __construct(ProjectAttachmentRepositoryInterface $projectAttachmentRepo)
    {
        $this->projectAttachmentRepo = $projectAttachmentRepo;
    }

    public function supports(string $type): bool
    {
        return $type === 'project';
    }

    public function store($file, int $userId): ProjectAttachment
    {
        $path = ImageHelpers::addImage($file, 'projects');

        $attachment = $this->projectAttachmentRepo->create([
            'file_path'    => $path,
            'project_id'   => null,
            'user_id'      => $userId,
        ]);

        return $attachment;
    }
}
