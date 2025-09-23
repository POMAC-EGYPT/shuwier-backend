<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\ServiceRepositoryInterface;
use App\Services\Contracts\ServiceServiceInterface;

class ServiceService implements ServiceServiceInterface
{
    protected $serviceRepo;

    public function __construct(ServiceRepositoryInterface $serviceRepo)
    {
        $this->serviceRepo = $serviceRepo;
    }

    public function getByFreelancerIdPaginated(int $freelancerId, int $perPage = 10): array
    {
        $services = $this->serviceRepo->getByFreelancerIdPaginated($freelancerId, $perPage);

        return ['status' => 'success', 'message' => __('message.success'), 'data' => $services];
    }

    public function getById(int $id): array
    {
        $service = $this->serviceRepo->findById($id);

        return ['status' => 'success', 'message' => __('message.success'), 'data' => $service];
    }

    public function create(array $data): array
    {
        $service = $this->serviceRepo->create($data);

        return ['status' => 'success', 'message' => __('message.success'), 'data' => $service];
    }

    public function update(int $id, array $data): array
    {
        $service = $this->serviceRepo->update($id, $data);

        return ['status' => 'success', 'message' => __('message.success'), 'data' => $service];
    }

    public function delete(int $id): array
    {
        $this->serviceRepo->delete($id);

        return ['status' => 'success', 'message' => __('message.success')];
    }
}
