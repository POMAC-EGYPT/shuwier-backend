<?php

namespace App\Services\Implementations;

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
}
