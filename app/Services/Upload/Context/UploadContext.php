<?php

namespace App\Services\Upload\Context;

use App\Models\PortfolioAttachment;
use App\Services\Upload\Factory\UploadStrategyFactory;
use Illuminate\Http\UploadedFile;

class UploadContext
{
    private UploadStrategyFactory $factory;

    public function __construct(UploadStrategyFactory $factory)
    {
        $this->factory = $factory;
    }

    public function upload(string $type, UploadedFile $file, int $userId): PortfolioAttachment
    {
        $strategy = $this->factory->getStrategy($type);

        return $strategy->store($file, $userId);
    }
}
