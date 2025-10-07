<?php

namespace App\Services\Implementations;

use App\Enum\ProjectStatus;
use App\Enum\ProposalStatus;
use App\Repository\Contracts\ProjectRepositoryInterface;
use App\Repository\Contracts\ProposalAttachmentRepositoryInterface;
use App\Repository\Contracts\ProposalRepositoryInterface;
use App\Services\Contracts\ProposalServiceInterface;
use Illuminate\Support\Facades\DB;

class ProposalService implements ProposalServiceInterface
{
    protected $proposalRepo;
    protected $proposalAttachmentRepo;
    protected $projectRepo;
    public function __construct(
        ProposalAttachmentRepositoryInterface $proposalAttachmentRepo,
        ProposalRepositoryInterface $proposalRepo,
        ProjectRepositoryInterface $projectRepo
    ) {
        $this->proposalAttachmentRepo = $proposalAttachmentRepo;
        $this->proposalRepo = $proposalRepo;
        $this->projectRepo = $projectRepo;
    }

    public function getAllByFreelancerIdPaginated(int $freelancerId, ?array $status = null, ?string $search = null, int $perPage = 15): array
    {
        $proposals = $this->proposalRepo->getAllByFreelancerIdPaginated($freelancerId, $status, $search, $perPage);

        return ['status' => 'success', 'message' => __('message.success'), 'data' => $proposals];
    }

    public function create(array $data): array
    {
        $project = $this->projectRepo->findById($data['project_id']);

        if (!$project->proposals_enabled)
            return ['status' => false, 'message' => __('message.proposals_are_not_enabled_for_this_project')];

        if ($project->status == ProjectStatus::COMPLETED || $project->status == ProjectStatus::INPROGRESS)
            return ['status' => false, 'message' => __('message.cannot_propose_to_completed_project_or_inprogress')];

        if (isset($data['attachment_ids'])) {
            foreach ($data['attachment_ids'] as $attachment_id) {
                $attachment = $this->proposalAttachmentRepo->findById($attachment_id);

                if ($attachment->proposal_id != null)
                    return ['status' => false, 'message' => __('message.this_attachment_is_already_used')];

                if ($attachment->user_id != $data['user_id'])
                    return ['status' => false, 'message' => __('message.this_attachment_does_not_belong_to_the_user')];
            }
        }

        $proposal = DB::transaction(function () use ($data) {
            $proposal = $this->proposalRepo->create([
                'cover_letter'        => $data['cover_letter'],
                'estimated_time_unit' => $data['estimated_time_unit'],
                'estimated_time'      => $data['estimated_time'],
                'fees_type'           => $data['fees_type'],
                'bid_amount'          => $data['bid_amount'],
                'project_id'          => $data['project_id'],
                'status'              => ProposalStatus::SUBMITTED,
                'user_id'             => $data['user_id'],
            ]);

            if (isset($data['attachment_ids'])) {
                foreach ($data['attachment_ids'] as $attachment_id) {
                    $this->proposalAttachmentRepo->update($attachment_id, [
                        'proposal_id' => $proposal->id,
                    ]);
                }
            }

            //TODO: send notification to project owner about new proposal

            return $proposal;
        });
        return ['status' => true, 'message' => __('message.proposal_created_successfully'), 'data' => $proposal];
    }

    public function getByIdAndFreelancerId(int $id, int $freelancerId): array
    {
        $proposal = $this->proposalRepo->getByIdAndFreelancerId($id, $freelancerId);

        return ['status' => 'success', 'message' => __('message.success'), 'data' => $proposal];
    }

    public function getByProjectIdPaginated(int $projectId, int $clientId, ?int $perPage = 15): array
    {
        $project = $this->projectRepo->findById($projectId);

        if ($project->user_id != $clientId)
            return ['status' => false, 'message' => __('message.you_are_not_authorized_to_view_proposals_for_this_project')];

        $proposals = $this->proposalRepo->getAllByProjectIdPaginated($projectId, $perPage);

        return ['status' => 'success', 'message' => __('message.success'), 'data' => $proposals];
    }

    public function getByIdToClient(int $id, int $clientId): array
    {
        $proposal = $this->proposalRepo->findById($id);

        if ($proposal->project->user_id != $clientId)
            return ['status' => false, 'message' => __('message.you_are_not_authorized_to_view_proposals_for_this_project')];

        $this->proposalRepo->update($id, ['status' => ProposalStatus::VIEWED]);

        $proposal->refresh();
        
        $proposal->load('attachments', 'user', 'project');

        return ['status' => 'success', 'message' => __('message.success'), 'data' => $proposal];
    }
}
