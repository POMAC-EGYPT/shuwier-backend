<?php

namespace App\Services\Implementations;

use App\Helpers\ImageHelpers;
use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\HashtagRepositoryInterface;
use App\Repository\Contracts\ServiceAttachmentRepositoryInterface;
use App\Repository\Contracts\ServiceFaqRepositoryInterface;
use App\Repository\Contracts\ServiceRepositoryInterface;
use App\Services\Contracts\ServiceServiceInterface;
use Illuminate\Support\Facades\DB;

class ServiceService implements ServiceServiceInterface
{
    protected $serviceRepo;
    protected $categoryRepo;
    protected $serviceAttachmentRepo;
    protected $serviceFaqRepo;
    protected $hashtagRepo;

    public function __construct(
        ServiceRepositoryInterface $serviceRepo,
        CategoryRepositoryInterface $categoryRepo,
        ServiceAttachmentRepositoryInterface $serviceAttachmentRepo,
        ServiceFaqRepositoryInterface $serviceFaqRepo,
        HashtagRepositoryInterface $hashtagRepo
    ) {
        $this->serviceRepo = $serviceRepo;
        $this->categoryRepo = $categoryRepo;
        $this->serviceAttachmentRepo = $serviceAttachmentRepo;
        $this->serviceFaqRepo = $serviceFaqRepo;
        $this->hashtagRepo = $hashtagRepo;
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
        $category = $this->categoryRepo->find($data['category_id']);

        if ($category->parent_id != null)
            return ['status' => false, 'message' => __('message.this_category_is_not_a_parent_category')];

        if (isset($data['subcategory_id'])) {
            $subcategory = $this->categoryRepo->find($data['subcategory_id']);

            if ($subcategory->parent_id == null)
                return ['status' => false, 'message' => __('message.this_category_is_not_a_subcategory')];

            if ($subcategory->parent_id != $data['category_id'])
                return ['status' => false, 'message' => __('message.this_subcategory_does_not_belong_to_the_selected_category')];
        }
        if (isset($data['attachment_ids'])) {
            foreach ($data['attachment_ids'] as $attachment_id) {
                $attachment = $this->serviceAttachmentRepo->findById($attachment_id);

                if ($attachment->service_id != null)
                    return ['status' => false, 'message' => __('message.this_attachment_is_already_used')];

                if ($attachment->user_id != $data['user_id'])
                    return ['status' => false, 'message' => __('message.this_attachment_does_not_belong_to_the_user')];
            }
        }
        $service = DB::transaction(function () use ($data) {

            $coverPath = ImageHelpers::addImage($data['cover_photo'], 'services');

            $service = $this->serviceRepo->create([
                'title'              => $data['title'],
                'description'        => $data['description'],
                'category_id'        => $data['category_id'],
                'subcategory_id'     => $data['subcategory_id'] ?? null,
                'delivery_time_unit' => $data['delivery_time_unit'],
                'delivery_time'      => $data['delivery_time'],
                'fees_type'          => $data['fees_type'],
                'price'              => $data['price'],
                'cover_photo'        => $coverPath,
                'faqs'               => $data['faqs'] ?? [],
                'user_id'            => auth('api')->id(),
            ]);

            if (isset($data['hashtags'])) {
                foreach ($data['hashtags'] as $hashtag)
                    $hashtagIds[] = $this->hashtagRepo->firstOrCreate(['name' => strtolower($hashtag)])->id;

                $service->hashtags()->sync($hashtagIds);
            }

            if (isset($data['attachment_ids'])) {
                foreach ($data['attachment_ids'] as $attachment_id)
                    $this->serviceAttachmentRepo->update($attachment_id, ['service_id' => $service->id]);
            }

            if (isset($data['faqs'])) {
                foreach ($data['faqs'] as $faq)
                    $this->serviceFaqRepo->create([
                        'question' => $faq['question'],
                        'answer'   => $faq['answer'],
                        'service_id' => $service->id
                    ]);
            }

            $service->refresh();
            $service->load(['faqs', 'attachments', 'hashtags']);
        });
        
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
