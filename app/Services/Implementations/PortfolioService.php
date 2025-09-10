<?php

namespace App\Services\Implementations;

use App\Helpers\ImageHelpers;
use App\Models\Portfolio;
use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\HashtagRepositoryInterface;
use App\Repository\Contracts\PortfolioAttachmentRepositoryInterface;
use App\Repository\Contracts\PortfolioRepositoryInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\PortfolioServiceInterface;
use Illuminate\Support\Facades\DB;

class PortfolioService implements PortfolioServiceInterface
{
    protected $profileRepo;
    protected $hashtagRepo;
    protected $portfolioAttachmentRepo;
    protected $categoryService;

    public function __construct(
        PortfolioRepositoryInterface $profileRepo,
        HashtagRepositoryInterface $hashtagRepo,
        PortfolioAttachmentRepositoryInterface $portfolioAttachmentRepo,
        CategoryServiceInterface $categoryService
    ) {
        $this->profileRepo = $profileRepo;
        $this->hashtagRepo = $hashtagRepo;
        $this->portfolioAttachmentRepo = $portfolioAttachmentRepo;
        $this->categoryService = $categoryService;
    }

    public function listPortfoliosByUserId(int $userId, ?int $perPage = 10): array
    {
        $portfolios = $this->profileRepo->getPortfoliosByUserIdPaginated($userId, $perPage);

        return ['status' => true, 'message' => __('message.success'), 'data' => $portfolios];
    }

    public function getPortfolioByUserIdAndPortfolioId(int $userId, int $portfolioId): array
    {
        $portfolio = true;

        return ['status' => true, 'message' => __('message.success'), 'data' => $portfolio];
    }

    public function create(array $data): array
    {
        $category = $this->categoryService->getById($data['category_id']);

        if ($category->parent_id != null)
            return ['status' => false, 'message' => __('message.this_category_is_not_a_parent_category')];

        if (isset($data['subcategory_id'])) {
            $subcategory = $this->categoryService->getById($data['subcategory_id']);

            if ($subcategory->parent_id == null)
                return ['status' => false, 'message' => __('message.this_category_is_not_a_subcategory')];

            if ($subcategory->parent_id != $data['category_id'])
                return ['status' => false, 'message' => __('message.this_subcategory_does_not_belong_to_the_selected_category')];
        }

        $portfolio = DB::transaction(function () use ($data) {
            $hashtagIds = [];

            if (isset($data['hashtags']))
                foreach ($data['hashtags'] as $hashtag)
                    $hashtagIds[] = $this->hashtagRepo->firstOrCreate(['name' => strtolower($hashtag)])->id;

            $portfolio = $this->profileRepo->create([
                'title'          => $data['title'],
                'description'    => $data['description'],
                'category_id'    => $data['category_id'],
                'subcategory_id' => $data['subcategory_id'] ?? null,
                'user_id'        => $data['user_id'],
                'hashtags'       => $hashtagIds ?? null,
            ]);

            if (isset($data['attachments'])) {
                foreach ($data['attachments'] as $attachment) {
                    $imagePath = ImageHelpers::addImage($attachment, 'portfolios');

                    $this->portfolioAttachmentRepo->create([
                        'portfolio_id' => $portfolio->id,
                        'file_path' => $imagePath,
                    ]);
                }
            }

            return $portfolio->load(['category', 'subcategory', 'hashtags', 'attachments']);
        });

        return ['status' => true, 'message' => __('message.portfolio_created_successfully'), 'data' => $portfolio];
    }

    public function update(int $userId, int $id, array $data): array
    {
        $portfolio = $this->profileRepo->findByUserIdAndPortfolioId($userId, $id);

        $category = $this->categoryService->getById($data['category_id']);

        if ($category->parent_id != null)
            return ['status' => false, 'message' => __('message.this_category_is_not_a_parent_category')];

        if (isset($data['subcategory_id']) && $data['subcategory_id'] != null) {
            $subcategory = $this->categoryService->getById($data['subcategory_id']);

            if ($subcategory->parent_id == null)
                return ['status' => false, 'message' => __('message.this_category_is_not_a_subcategory')];

            if ($subcategory->parent_id != $data['category_id'])
                return ['status' => false, 'message' => __('message.this_subcategory_does_not_belong_to_the_selected_category')];
        }

        if (isset($data['attachments']) && $data['attachments'] != null) {
            $oldAttachments = $portfolio->attachments->pluck('file_path')->toArray();

            foreach ($data['attachments'] as $attachment) {
                if (is_string($attachment) && !in_array($attachment, $oldAttachments, true)) {
                    return ['status' => false, 'message' => __('message.invalid_attachments')];
                }
            }
        }

        $portfolio = DB::transaction(function () use ($id, $data, $portfolio) {
            $hashtagIds = [];

            if (isset($data['hashtags'])) {
                foreach ($data['hashtags'] as $hashtag) {
                    $hashtagIds[] = $this->hashtagRepo
                        ->firstOrCreate(['name' => strtolower($hashtag)])
                        ->id;
                }
            }

            $this->profileRepo->update($data['user_id'], $id, [
                'title'          => $data['title'],
                'description'    => $data['description'],
                'category_id'    => $data['category_id'],
                'subcategory_id' => $data['subcategory_id'] ?? null,
                'user_id'        => $data['user_id'],
            ]);

            if (isset($data['hashtags'])) {
                $this->profileRepo->syncHashtags($portfolio, $hashtagIds);
            }

            if (isset($data['attachments'])) {
                foreach ($portfolio->attachments as $attachment) {
                    ImageHelpers::deleteImage($attachment->file_path);
                    $this->portfolioAttachmentRepo->delete($attachment->id);
                }

                foreach ($data['attachments'] as $attachment) {
                    if (is_string($attachment)) {
                        $this->portfolioAttachmentRepo->create([
                            'portfolio_id' => $portfolio->id,
                            'file_path'    => $attachment,
                        ]);
                    } elseif ($attachment instanceof \Illuminate\Http\UploadedFile) {
                        $imagePath = ImageHelpers::addImage($attachment, 'portfolios');
                        $this->portfolioAttachmentRepo->create([
                            'portfolio_id' => $portfolio->id,
                            'file_path'    => $imagePath,
                        ]);
                    }
                }
            }

            return $portfolio->load(['category', 'subcategory', 'hashtags', 'attachments']);
        });

        return [
            'status'  => true,
            'message' => __('message.portfolio_updated_successfully'),
            'data'    => $portfolio,
        ];
    }

    public function delete(int $userId, int $id): array
    {
        $portfolio = $this->profileRepo->findByUserIdAndPortfolioId($userId, $id);

        foreach ($portfolio->attachments as $attachment) {
            ImageHelpers::deleteImage($attachment->file_path);

            $this->portfolioAttachmentRepo->delete($attachment->id);
        }

        $this->profileRepo->delete($userId, $id);

        return ['status' => true, 'message' => __('message.portfolio_deleted_successfully')];
    }
}
