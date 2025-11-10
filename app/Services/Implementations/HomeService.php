<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\HowItWorkRepositoryInterface;
use App\Repository\Contracts\ProjectRepositoryInterface;
use App\Repository\Contracts\ServiceRepositoryInterface;
use App\Repository\Contracts\TipsAndGuidRepositoryInterface;
use App\Services\Contracts\HomeServiceInterface;

class HomeService implements HomeServiceInterface
{
    protected $categoryRepo;
    protected $serviceRepo;
    protected $howItWorkRepo;
    protected $tipsAndGuidRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepo,
        ServiceRepositoryInterface $serviceRepo,
        HowItWorkRepositoryInterface $howItWorkRepo,
        TipsAndGuidRepositoryInterface $tipsAndGuidRepo

    ) {
        $this->categoryRepo = $categoryRepo;
        $this->serviceRepo = $serviceRepo;
        $this->howItWorkRepo = $howItWorkRepo;
        $this->tipsAndGuidRepo = $tipsAndGuidRepo;
    }
    public function guestHome(int $limitCategory = 8, int $limitService = 10): array
    {
        $bestSellerCategories = $this->categoryRepo->getBestSellersParentCategories($limitCategory);

        $bestSellerServices = $this->serviceRepo->getBestSellersServices($limitService);

        $howItWorks = $this->howItWorkRepo->getAll();

        $tipsAndGuids = $this->tipsAndGuidRepo->getPopular();

        return ['status' => true, 'message' => __('message.success'), 'data' =>
        [
            'best_seller_categories' => $bestSellerCategories,
            'best_seller_services'   => $bestSellerServices,
            'how_it_works'           => $howItWorks,
            'tips_and_guides'        => $tipsAndGuids
        ]];
    }
}
