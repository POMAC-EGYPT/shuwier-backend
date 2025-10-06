<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\ProjectRepositoryInterface;
use App\Repository\Contracts\ServiceRepositoryInterface;
use App\Services\Contracts\HomeServiceInterface;

class HomeService implements HomeServiceInterface
{
    protected $categoryRepo;
    protected $serviceRepo;
    protected $projectRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepo,
        ServiceRepositoryInterface $serviceRepo,
        ProjectRepositoryInterface $projectRepo
    ) {
        $this->categoryRepo = $categoryRepo;
        $this->serviceRepo = $serviceRepo;
        $this->projectRepo = $projectRepo;
    }
    public function guestHome(int $limitCategory = 8, int $limitService = 10): array
    {
        $bestSellerCategories = $this->categoryRepo->getBestSellersParentCategories($limitCategory);

        $bestSellerServices = $this->serviceRepo->getBestSellersServices($limitService);

        return ['status' => true, 'message' => __('message.success'), 'data' =>
        [
            'best_seller_categories' => $bestSellerCategories,
            'best_seller_services' => $bestSellerServices
        ]];
    }

    public function freelancerHome(?string $search = null, ?array $category_ids = null, ?array $budgets = null, int $perPage = 15): array
    {
        $services = $this->projectRepo->getWithFilterByCategoryAndBudget(
            $search,
            $category_ids,
            $budgets,
            $perPage
        );

        return ['status' => true, 'message' => __('message.success'), 'data' => $services];
    }
}
