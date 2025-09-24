<?php

namespace App\Services\Upload\Strategies;

use App\Helpers\ImageHelpers;
use App\Models\ServiceAttachment;
use App\Repository\Contracts\ServiceAttachmentRepositoryInterface;
use App\Services\Upload\Contracts\UploadStrategyInterface;

class ServiceUpload implements UploadStrategyInterface
{
    protected $serviceAttachmentRepo;
    public function __construct(ServiceAttachmentRepositoryInterface $serviceAttachmentRepo)
    {
        $this->serviceAttachmentRepo = $serviceAttachmentRepo;
    }

    public function supports(string $type): bool
    {
        return $type === 'service';
    }

    public function store($file, int $userId): ServiceAttachment
    {
        $path = ImageHelpers::addImage($file, 'services');

        $attachment = $this->serviceAttachmentRepo->create([
            'file_path'    => $path,
            'user_id'      => $userId,
            'service_id'   => null,
        ]);

        return $attachment;
    }
}
