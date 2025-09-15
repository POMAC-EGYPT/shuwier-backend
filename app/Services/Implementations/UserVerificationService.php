<?php

namespace App\Services\Implementations;

use App\Helpers\ImageHelpers;
use App\Services\Contracts\UserVerificationRepositoryInterface;
use App\Services\Contracts\UserVerificationServiceInterface;

class UserVerificationService implements UserVerificationServiceInterface
{
    protected $userVerificationRepo;
    public function __construct(UserVerificationRepositoryInterface $userVerificationRepo)
    {
        $this->userVerificationRepo = $userVerificationRepo;
    }

    public function create(array $data): array
    {
        $pathDocumentOne = ImageHelpers::addImage($data['document_one'], 'user_verifications');

        if (isset($data['document_two']))
            $pathDocumentTwo = ImageHelpers::addImage($data['document_two'], 'user_verifications');

        $this->userVerificationRepo->create([
            'user_id' => $data['user_id'],
            'document_one' => $pathDocumentOne,
            'document_two' => $pathDocumentTwo ?? null,
        ]);

        return ['status' => true, 'message' => __('message.verification_request_sent_successfully'), 'data' => $data];
    }
}
