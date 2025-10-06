<?php

namespace App\Services\Implementations;

use App\Enum\ProjectStatus;
use App\Models\Project;
use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\ProjectAttachmentRepositoryInterface;
use App\Repository\Contracts\ProjectRepositoryInterface;
use App\Services\Contracts\ProjectServiceInterface;
use Illuminate\Support\Facades\DB;

class ProjectService implements ProjectServiceInterface
{
    protected $projectRepo;
    protected $projectAttachmentRepo;
    protected $categoryRepo;

    public function __construct(
        ProjectRepositoryInterface $projectRepo,
        CategoryRepositoryInterface $categoryRepo,
        ProjectAttachmentRepositoryInterface $projectAttachmentRepo
    ) {
        $this->projectRepo = $projectRepo;
        $this->categoryRepo = $categoryRepo;
        $this->projectAttachmentRepo = $projectAttachmentRepo;
    }
    public function getByClientId(?string $status = null, int $clientId, int $perPage = 16): array
    {
        $projects = $this->projectRepo->getByClientIdPaginated($status, $clientId, $perPage);
        
        return ['status' => true, 'message' => __('message.success'), 'data' => $projects];
    }

    public function findById(int $id): array
    {
        $project = $this->projectRepo->findById($id);

        $project->load(['attachments', 'category', 'subcategory', 'user']);

        return ['status' => true, 'message' => __('message.success'), 'data' => $project];
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
                $attachment = $this->projectAttachmentRepo->findById($attachment_id);

                if ($attachment->service_id != null)
                    return ['status' => false, 'message' => __('message.this_attachment_is_already_used')];

                if ($attachment->user_id != $data['user_id'])
                    return ['status' => false, 'message' => __('message.this_attachment_does_not_belong_to_the_user')];
            }
        }

        $project = DB::transaction(function () use ($data) {
            $project = $this->projectRepo->create([
                'title'             => $data['title'],
                'description'       => $data['description'],
                'category_id'       => $data['category_id'],
                'subcategory_id'    => $data['subcategory_id'] ?? null,
                'budget'            => $data['budget'],
                'deadline_unit'     => $data['deadline_unit'],
                'deadline'          => $data['deadline'],
                'status'            => ProjectStatus::ACTIVE,
                'comments_enabled'  => true,
                'proposals_enabled' => true,
                'user_id'           => $data['user_id'],
            ]);

            if (isset($data['attachment_ids']))
                foreach ($data['attachment_ids'] as $attachment_id)
                    $this->projectAttachmentRepo->update($attachment_id, ['project_id' => $project->id]);

            $project->load(['attachments', 'category', 'subcategory', 'user']);

            return $project;
        });

        return ['status' => true, 'message' => __('message.project_created_successfully'), 'data' => $project];
    }

    public function update(int $id, array $data): array
    {
        return [];
    }

    public function delete(int $id): array
    {
        return [];
    }
}
