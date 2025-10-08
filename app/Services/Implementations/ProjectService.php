<?php

namespace App\Services\Implementations;

use App\Enum\ProjectStatus;
use App\Models\Project;
use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\ProjectAttachmentRepositoryInterface;
use App\Repository\Contracts\ProjectRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\ProjectServiceInterface;
use Illuminate\Support\Facades\DB;

class ProjectService implements ProjectServiceInterface
{
    protected $projectRepo;
    protected $projectAttachmentRepo;
    protected $categoryRepo;
    protected $userRepo;

    public function __construct(
        ProjectRepositoryInterface $projectRepo,
        CategoryRepositoryInterface $categoryRepo,
        ProjectAttachmentRepositoryInterface $projectAttachmentRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->projectRepo = $projectRepo;
        $this->categoryRepo = $categoryRepo;
        $this->projectAttachmentRepo = $projectAttachmentRepo;
        $this->userRepo = $userRepo;
    }
    public function getByClientId(?string $status = null, int $clientId, int $perPage = 16): array
    {
        $projects = $this->projectRepo->getByClientIdPaginated($status, $clientId, $perPage);

        return ['status' => true, 'message' => __('message.success'), 'data' => $projects];
    }

    public function findByIdAndClientId(int $id, int $clientId): array
    {
        $project = $this->projectRepo->findByIdAndClientId($id, $clientId);

        $project->load(relations: ['attachments', 'category', 'subcategory', 'user']);

        return ['status' => true, 'message' => __('message.success'), 'data' => $project];
    }

    public function findByIdToFreelancer(int $freelancerId, int $id): array
    {
        $project = $this->projectRepo->findById($id);

        if ($project->proposals_enabled == false)
            return ['status' => false, 'message' => __('message.proposals_are_not_enabled_for_this_project')];

        $freelancer = $this->userRepo->find($freelancerId);

        if (!$freelancer->is_active)
            return ['status' => false, 'message' => __('message.user_not_active')];

        if (!$freelancer->is_verified)
            return ['status' => false, 'message' => __('message.user_not_verified')];

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

                if ($attachment->project_id != null)
                    return ['status' => false, 'message' => __('message.this_attachment_is_already_used')];

                if ($attachment->user_id != $data['user_id'])
                    return ['status' => false, 'message' => __('message.this_attachment_does_not_belong_to_the_user')];
            }
        }

        $project = DB::transaction(function () use ($data) {
            $project = $this->projectRepo->create([
                'title'                   => $data['title'],
                'description'             => $data['description'],
                'category_id'             => $data['category_id'],
                'subcategory_id'          => $data['subcategory_id'] ?? null,
                'budget'                  => $data['budget'],
                'deadline_unit'           => $data['deadline_unit'],
                'deadline'                => $data['deadline'],
                'status'                  => ProjectStatus::ACTIVE,
                'comments_enabled'        => true,
                'proposals_enabled'       => true,
                'submited_proposal_count' => 0,
                'user_id'                 => $data['user_id'],
            ]);

            if (isset($data['attachment_ids']))
                foreach ($data['attachment_ids'] as $attachment_id)
                    $this->projectAttachmentRepo->update($attachment_id, ['project_id' => $project->id]);

            $project->load(['attachments', 'category', 'subcategory', 'user']);

            return $project;
        });

        return ['status' => true, 'message' => __('message.project_created_successfully'), 'data' => $project];
    }

    public function endProject(int $id, $clientId): array
    {
        $project = $this->projectRepo->findById($id);

        if ($project->user_id != $clientId)
            return ['status' => false, 'message' => __('message.this_project_is_not_belog_to_this_client')];

        if (!$project->proposals_enabled)
            return ['status' => false, 'message' => __('message.this_project_already_ended')];

        if ($project->status == ProjectStatus::INPROGRESS)
            return ['status' => false, 'message' => __('message.this_project_is_in_progress')];

        if ($project->status == ProjectStatus::COMPLETED)
            return ['status' => false, 'message' => __("message.can't_end_project_completed")];

        $this->projectRepo->update($id, ['proposals_enabled' => false]);

        return ['status' => true, 'message' => __('message.project_ended_successfully')];
    }
}
