<?php

namespace App\Services\Implementations;

use App\Helpers\ImageHelpers;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Contracts\UserVerificationRepositoryInterface;
use App\Services\Contracts\UserVerificationServiceInterface;

class UserVerificationService implements UserVerificationServiceInterface
{
    protected $userVerificationRepo;
    protected $userRepo;
    public function __construct(UserVerificationRepositoryInterface $userVerificationRepo, UserRepositoryInterface $userRepo)
    {
        $this->userVerificationRepo = $userVerificationRepo;
        $this->userRepo = $userRepo;
    }

    public function create(array $data): array
    {
        $verification = $this->userVerificationRepo->getByUserId($data['user_id']);

        if ($verification)
            return ['status' => false, 'message' => __('message.verification_request_already_sent')];

        $pathDocumentOne = ImageHelpers::addImage($data['document_one'], 'user_verifications');

        if (isset($data['document_two']))
            $pathDocumentTwo = ImageHelpers::addImage($data['document_two'], 'user_verifications');

        $this->userVerificationRepo->create([
            'user_id'      => $data['user_id'],
            'document_one' => $pathDocumentOne,
            'document_two' => $pathDocumentTwo ?? null,
            'status'       => 'pending',
        ]);

        return ['status' => true, 'message' => __('message.verification_request_sent_successfully'), 'data' => $data];
    }

    public function getAllWithFilterPaginated(?string $status = null, ?int $perPage = 10, ?string $search = null): array
    {
        $users = $this->userRepo->getRequestVerifications($status, $perPage, $search);

        return ['status' => true, 'message' => __('message.success'), 'data' => $users];
    }

    public function acceptOrReject(int $id, string $action): array
    {
        $verification = $this->userVerificationRepo->getById($id);

        if ($verification->status === 'approved')
            return ['status' => false, 'message' => __('message.verification_request_already_approved')];

        if ($action === 'rejected') {
            ImageHelpers::deleteImage($verification->document_one);

            if ($verification->document_two)
                ImageHelpers::deleteImage($verification->document_two);

            $this->userVerificationRepo->delete($id);

            $this->userRepo->update($verification->user_id, ['is_verified' => false]);

            // Send notification to user about rejection
            // $user = $this->userRepo->find($verification->user_id);
            // You'll need to implement your notification logic here
            // For example: NotificationService::send($user, 'verification_rejected');
            return ['status' => true, 'message' => __('message.verification_request_rejected_success')];
        } elseif ($action === 'approved') {

            $this->userVerificationRepo->update($id, [
                'status' => 'approved',
                'reviewed_at' => now(),
                'reviewed_by' => auth('admin')->id()
            ]);

            $user = $this->userRepo->update($verification->user_id, ['is_verified' => true]);

            return [
                'status'  => true,
                'message' => __('message.verification_request_approved_success'),
                'data'    => $user
            ];
        }

        return ['status' => false, 'message' => __('message.invalid_action')];
    }
}
