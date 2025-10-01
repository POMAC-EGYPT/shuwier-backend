<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\ServiceRepositoryInterface;
use App\Services\Contracts\HomeServiceInterface;

class HomeService implements HomeServiceInterface
{
    protected $categoryRepo;
    protected $serviceRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo, ServiceRepositoryInterface $serviceRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->serviceRepo = $serviceRepo;
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
}
