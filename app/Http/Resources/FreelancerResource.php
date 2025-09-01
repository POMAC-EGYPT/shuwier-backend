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
            'first_name'                     => $this->first_name,
            'last_name'                      => $this->last_name,
            'email'                          => $this->email,
            'type'                           => $this->type,
            'email_verified_at'              => $this->email_verified_at,
            'phone'                          => $this->phone,
            'is_active'                      => $this->is_active,
            'about_me'                       => $this->about_me,
            'profile_picture'                => $this->profile_picture,
            'approval_status'                => $this->approval_status,
            'linkedin_link'                  => $this->freelancerProfile->linkedin_link,
            'twitter_link'                   => $this->freelancerProfile->twitter_link,
            'other_freelance_platform_links' => json_decode($this->freelancerProfile->other_freelance_platform_links),
            'portfolio_link'                 => $this->freelancerProfile->portfolio_link,
            'headline'                       => $this->freelancerProfile->headline,
            'description'                    => $this->freelancerProfile->description,
            'created_at'                     => $this->created_at,
            'updated_at'                     => $this->updated_at
        ];
    }
}
