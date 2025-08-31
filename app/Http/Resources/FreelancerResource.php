<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FreelancerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                             => $this->id,
            'name'                           => $this->name,
            'email'                          => $this->email,
            'type'                           => $this->type,
            'email_verified_at'              => $this->email_verified_at,
            'linkedin_link'                  => $this->linkedin_link,
            'twitter_link'                   => $this->twitter_link,
            'other_freelance_platform_links' => json_decode($this->other_freelance_platform_links),
            'portfolio_link'                 => $this->portfolio_link,
            'is_active'                      => $this->is_active,
            'approval_status'                => $this->approval_status,
            'rate'                           => $this->rate,
            'created_at'                     => $this->created_at,
            'updated_at'                     => $this->updated_at
        ];
    }
}
