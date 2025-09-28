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

    public function create(array $data): array
    {
        $createdCommission = $this->commissionRepo->create([
            'rate'           => $data['rate'] / 100,
            'effective_from' => $data['effective_from'],
            'created_by'     => auth('admin')->id(),
        ]);

        return ['status' => true, 'message' => __('message.commission_created_successfully'), 'data' => $createdCommission];
    }

    public function update(int $id, array $data): array
    {
        $commission = $this->commissionRepo->findById($id);

        if ($data['effective_from'] == $commission->effective_from && $data['rate'] == $commission->rate / 100)
            return ['status' => false, 'message' => __('message.please_provide_different_values_to_update')];

        if ($commission->effective_from <= now())
            return ['status' => false, 'message' => __('message.cannot_update_commission_effective_from_today_or_past')];

        $this->commissionRepo->update($id, [
            'rate'           => $data['rate'] / 100 ?? $commission->rate,
            'effective_from' => $data['effective_from'] ?? $commission->effective_from,
            'created_by'     => auth('admin')->id(),
        ]);

        return ['status' => true, 'message' => __('message.commission_updated_successfully'), 'data' => $commission->refresh()];
    }

    public function delete(int $id): array
    {
        $commission = $this->commissionRepo->findById($id);

        if ($commission->effective_from <= now())
            return ['status' => false, 'message' => __('message.cannot_delete_commission_effective_from_today_or_past')];

        $this->commissionRepo->delete($id);

        return ['status' => true, 'message' => __('message.commission_deleted_successfully')];
    }
}
