<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProposalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'cover_letter'        => $this->cover_letter,
            'estimated_time_unit' => $this->estimated_time_unit,
            'estimated_time'      => $this->estimated_time,
            'fees_type'           => $this->fees_type,
            'bid_amount'          => $this->bid_amount,
            'project_id'          => $this->project_id,
            'status'              => $this->status,
            'project'             => when(
                $this->relationLoaded('project') &&
                    $this->project,
                BaseResource::make(ProjectResource::make($this->project))
            ),
            'attachments'         => $this->when(
                $this->relationLoaded('attachments') &&
                    $this->attachments && $this->attachments->count() > 0,
                $this->attachments
            ),
            'user'                => $this->when(
                $this->relationLoaded('user') &&
                    $this->user,
                BaseResource::make(FreelancerResource::make($this->user))
            ),
        ];
    }
}
