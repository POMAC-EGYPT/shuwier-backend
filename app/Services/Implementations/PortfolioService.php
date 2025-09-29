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
        $portfolio = $this->profileRepo->findByUserIdAndPortfolioId($userId, $portfolioId);

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

        if (isset($data['cover_id'])) {
            $cover = $this->portfolioAttachmentRepo->findById($data['cover_id']);

            if ($cover->user_id != $data['user_id'])
                return ['status' => false, 'message' => __('message.this_attachment_does_not_belong_to_the_user')];
 
            if ($cover->portfolio_id != null)
                return ['status' => false, 'message' => __('message.this_attachment_is_already_used')];

            if (!in_array(strtolower(pathinfo($cover->file_path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp']))
                return ['status' => false, 'message' => __('message.cover_must_be_an_image')];
        }

        if (isset($data['attachment_ids']) && count($data['attachment_ids']) > 0 && $data['attachment_ids'][0] != null) {
            foreach ($data['attachment_ids'] as $attachment_id) {
                $attachment = $this->portfolioAttachmentRepo->findById($attachment_id);

                if ($attachment->portfolio_id != null)
                    return ['status' => false, 'message' => __('message.this_attachment_is_already_used')];

                if ($attachment->user_id != $data['user_id'])
                    return ['status' => false, 'message' => __('message.this_attachment_does_not_belong_to_the_user')];
            }
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

            if (isset($data['attachment_ids']) && count($data['attachment_ids']) > 0 && $data['attachment_ids'][0] !== null) {
                foreach ($data['attachment_ids'] as $attachment_id) {
                    $this->portfolioAttachmentRepo->update($attachment_id, [
                        'portfolio_id' => $portfolio->id
                    ]);
                }
            }
            if (isset($data['cover_id']))
                $this->portfolioAttachmentRepo->update($data['cover_id'], [
                    'portfolio_id' => $portfolio->id,
                    'is_cover'     => true,
                ]);

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

        if (isset($data['cover_id']) && $data['cover_id'] != null) {
            $cover = $this->portfolioAttachmentRepo->findById($data['cover_id']);

            if ($cover->user_id != $userId)
                return ['status' => false, 'message' => __('message.this_attachment_does_not_belong_to_the_user')];

            if ($cover->portfolio_id != null && $cover->portfolio_id != $id)
                return ['status' => false, 'message' => __('message.this_attachment_is_already_used')];

            if (!in_array(strtolower(pathinfo($cover->file_path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp']))
                return ['status' => false, 'message' => __('message.cover_must_be_an_image')];
        }

        if (isset($data['attachment_ids']) && count($data['attachment_ids']) > 0) {
            foreach ($data['attachment_ids'] as $attachment_id) {
                $attachment = $this->portfolioAttachmentRepo->findById($attachment_id);

                if ($attachment->user_id != $userId)
                    return ['status' => false, 'message' => __('message.this_attachment_does_not_belong_to_the_user')];

                if ($attachment->portfolio_id != null && $attachment->portfolio_id != $id)
                    return ['status' => false, 'message' => __('message.this_attachment_belongs_to_another_portfolio')];
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

            $oldAttachments = $this->portfolioAttachmentRepo->getByPortfolioId($id);

            if (count($oldAttachments) > 0) {
                foreach ($oldAttachments as $oldAttachment) {
                    if (isset($data['attachment_ids']) && !in_array($oldAttachment->id, $data['attachment_ids'])) {
                        if ($oldAttachment->is_cover)
                            continue;

                        ImageHelpers::deleteImage($oldAttachment->file_path);
                        $this->portfolioAttachmentRepo->delete($oldAttachment->id);
                    }
                }
            }

            if (!empty($data['attachment_ids'])) {
                foreach ($data['attachment_ids'] as $attachment_id) {
                    $this->portfolioAttachmentRepo->update($attachment_id, [
                        'portfolio_id' => $portfolio->id
                    ]);
                }
            }

            if (isset($data['cover_id']) && $data['cover_id'] != null) {
                foreach ($oldAttachments as $oldAttachment) {
                    if ($oldAttachment->is_cover && ($data['cover_id'] == null || $oldAttachment->id != $data['cover_id'])) {
                        $this->portfolioAttachmentRepo->delete($oldAttachment->id);
                    }
                }

                $this->portfolioAttachmentRepo->update($data['cover_id'], [
                    'portfolio_id' => $portfolio->id,
                    'is_cover'     => true,
                ]);
            }


            $portfolio->refresh();

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
