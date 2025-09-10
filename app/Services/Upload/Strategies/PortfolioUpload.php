<?php

namespace App\Services\Upload\Strategies;

use App\Helpers\ImageHelpers;
use App\Models\PortfolioAttachment;
use App\Repository\Contracts\PortfolioAttachmentRepositoryInterface;
use App\Services\Upload\Contracts\UploadStrategyInterface;
use Illuminate\Http\UploadedFile;

class PortfolioUpload implements UploadStrategyInterface
{
    protected $portfolioAttachmentRepo;
    public function __construct(PortfolioAttachmentRepositoryInterface $portfolioAttachmentRepo)
    {
        $this->portfolioAttachmentRepo = $portfolioAttachmentRepo;
    }

    public function supports(string $type): bool
    {
        return $type === 'portfolio';
    }

    public function store($file, int $userId): PortfolioAttachment
    {
        $path = ImageHelpers::addImage($file, 'portfolios');

        $attachment = $this->portfolioAttachmentRepo->create([
            'file_path'    => $path,
            'portfolio_id' => null,
            'user_id'      => $userId,
        ]);

        return $attachment;
    }
}
