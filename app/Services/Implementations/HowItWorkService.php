<?php

namespace App\Services\Implementations;

use App\Helpers\ImageHelpers;
use App\Repository\Contracts\HowItWorkRepositoryInterface;
use App\Services\Contracts\HowItWorkServiceInterface;

class HowItWorkService implements HowItWorkServiceInterface
{
    protected $howItWorkRepository;

    public function __construct(HowItWorkRepositoryInterface $howItWorkRepository)
    {
        $this->howItWorkRepository = $howItWorkRepository;
    }

    public function getAllPaginated(?string $search = null, ?string $type = null, ?int $perPage = 15): array
    {
        $howItWorks = $this->howItWorkRepository->getAllWithFiltersPaginated($search, $type, $perPage);

        return ['status' => true, 'message' => __('message.success'), 'data' => $howItWorks];
    }

    public function getById(int $id): array
    {
        $howItWork = $this->howItWorkRepository->find($id);

        return ['status' => true, 'message' => __('message.success'), 'data' => $howItWork];
    }

    public function create(array $data): array
    {
        $imagePath = ImageHelpers::addImage($data['image'], 'how_it_works');

        $howItWork = $this->howItWorkRepository->create([
            'title_en'       => $data['title_en'],
            'title_ar'       => $data['title_ar'],
            'description_en' => $data['description_en'],
            'description_ar' => $data['description_ar'],
            'type'           => $data['type'],
            'image'          => $imagePath,
        ]);

        return ['status' => true, 'message' => __('message.how_it_work_created_successfully'), 'data' => $howItWork];
    }

    public function update(int $id, array $data): array
    {
        $howItWork = $this->howItWorkRepository->find($id);

        $imagePath = null;

        if (isset($data['image']) && $data['image'] != null) {
            ImageHelpers::deleteImage($howItWork->image);

            $imagePath = ImageHelpers::addImage($data['image'], 'how_it_works');

            $data['image'] = $imagePath;
        }

        $this->howItWorkRepository->update($id, [
            'title_en'       => $data['title_en'],
            'title_ar'       => $data['title_ar'],
            'description_en' => $data['description_en'],
            'description_ar' => $data['description_ar'],
            'type'           => $data['type'],
            'image'          => $imagePath ?? $howItWork->image,
        ]);

        return ['status' => true, 'message' => __('message.how_it_work_updated_successfully')];
    }

    public function delete(int $id): array
    {
        $howItWork = $this->howItWorkRepository->find($id);

        ImageHelpers::deleteImage($howItWork->image);

        $this->howItWorkRepository->delete($id);

        return ['status' => true, 'message' => __('message.how_it_work_deleted_successfully')];
    }
}
