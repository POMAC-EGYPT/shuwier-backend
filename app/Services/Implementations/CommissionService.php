<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\CommissionRepositoryInterface;
use App\Services\Contracts\CommissionServiceInterface;

class CommissionService implements CommissionServiceInterface
{
    protected $commissionRepo;

    public function __construct(CommissionRepositoryInterface $commissionRepo)
    {
        $this->commissionRepo = $commissionRepo;
    }

    public function getAllPaginated(?string $search = null, int $perPage = 10): array
    {
        $commissions = $this->commissionRepo->getAllPaginated($search, $perPage);

        return ['status' => true, 'message' => __('message.success'), 'data' => $commissions];
    }

    public function getLast(): array
    {
        $commission = $this->commissionRepo->getLast();

        return ['status' => true, 'message' => __('message.success'), 'data' => $commission];
    }

    public function create(array $data): array
    {
        $createdCommission = $this->commissionRepo->create([
            'rate'           => $data['rate'] / 100,
            'effective_from' => now(),
            'created_by'     => auth('admin')->id(),
        ]);

        return ['status' => true, 'message' => __('message.commission_created_successfully'), 'data' => $createdCommission];
    }
}
