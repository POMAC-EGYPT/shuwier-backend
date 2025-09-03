<?php

namespace App\Services\Implementations;

use App\Helpers\ImageHelpers;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\ClientServiceInterface;

class ClientService implements ClientServiceInterface
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function list(?string $name, ?int $perPage): array
    {
        $clients = $this->userRepo->getClientsWithFilter($name, $perPage);

        return ['status' => true, 'message' => __('message.success'), 'data' => $clients];
    }

    public function getById(int $id): array
    {
        $client = $this->userRepo->findByType($id, 'clients');

        return ['status' => true, 'message' => __('message.success'), 'data' => $client];
    }

    public function delete(int $id): array
    {
        $client = $this->userRepo->findByType($id, 'clients');

        ImageHelpers::deleteImage($client->profile_picture);

        $this->userRepo->delete($client->id);

        return ['status' => true, 'message' => __('message.client_deleted_successfully')];
    }

    public function blockAndUnblock(int $id): array
    {
        $client = $this->userRepo->findByType($id, 'clients');

        $this->userRepo->update($id, ['is_active' => !$client->is_active]);

        $message = $client->is_active
            ? __('message.client_blocked_successfully')
            : __('message.client_unblocked_successfully');


        return ['status' => true, 'message' => $message];
    }
}
