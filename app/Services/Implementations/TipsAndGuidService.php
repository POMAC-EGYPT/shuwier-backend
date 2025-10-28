<?php

namespace App\Services\Implementations;

use App\Helpers\ImageHelpers;
use App\Repository\Contracts\TipsAndGuidRepositoryInterface;
use App\Services\Contracts\TipsAndGuidServiceInterface;

class TipsAndGuidService implements TipsAndGuidServiceInterface
{
    protected $tipsAndGuidRepo;

    public function __construct(TipsAndGuidRepositoryInterface $tipsAndGuidRepo)
    {
        $this->tipsAndGuidRepo = $tipsAndGuidRepo;
    }

    public function getAllPaginated(?string $search = null, ?int $perPage = 15)
    {
        $tipsAndGuids = $this->tipsAndGuidRepo->getAllPaginated($search, $perPage);

        return ['status' => true, 'message' => __('message.success'), 'data' => $tipsAndGuids];
    }

    public function getById(int $id): array
    {
        $tipsAndGuid = $this->tipsAndGuidRepo->find($id);

        return ['status' => true, 'message' => __('message.success'), 'data' => $tipsAndGuid];
    }

    public function create(array $data): array
    {
        $imagePath = ImageHelpers::addImage($data['image'], 'tips_and_guid');

        $tipsAndGuid = $this->tipsAndGuidRepo->create([
            'title_en'       => $data['title_en'],
            'title_ar'       => $data['title_ar'],
            'description_en' => $data['description_en'],
            'description_ar' => $data['description_ar'],
            'image'          => $imagePath,
        ]);

        return ['status' => true, 'message' => __('message.tips_and_guid_created_successfully'), 'data' => $tipsAndGuid];
    }

    public function update(int $id, array $data): array
    {
        $tipsAndGuid = $this->tipsAndGuidRepo->find($id);

        if (isset($data['image']) && $data['image'] != null) {
            ImageHelpers::deleteImage($tipsAndGuid->image);

            $imagePath = ImageHelpers::addImage($data['image'], 'tips_and_guid');

            $data['image'] = $imagePath;
        }

        $tipsAndGuid = $this->tipsAndGuidRepo->update($id, [
            'title_en'       => $data['title_en'],
            'title_ar'       => $data['title_ar'],
            'description_en' => $data['description_en'],
            'description_ar' => $data['description_ar'],
            'image'          => $imagePath ?? $tipsAndGuid->image,
        ]);

        return ['status' => true, 'message' => __('message.tips_and_guid_updated_successfully')];
    }

    public function delete(int $id): array
    {
        $tipsAndGuid = $this->tipsAndGuidRepo->find($id);

        ImageHelpers::deleteImage($tipsAndGuid->image);

        $this->tipsAndGuidRepo->delete($id);

        return ['status' => true, 'message' => __('message.tips_and_guid_deleted_successfully')];
    }
}
