<?php

namespace App\Http\Resources;

use App\Models\Category;
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
            'phone'                          => $this->phone,
            'is_active'                      => $this->is_active,
            'about_me'                       => $this->about_me,
            'profile_picture'                => $this->profile_picture,
            'approval_status'                => $this->approval_status,
            'country'                        => $this->country,
            'city'                           => $this->city,
            'linkedin_link'                  => $this->freelancerProfile->linkedin_link ?? null,
            'twitter_link'                   => $this->freelancerProfile->twitter_link ?? null,
            'other_freelance_platform_links' => json_decode($this->freelancerProfile->other_freelance_platform_links) ?? [],
            'portfolio_link'                 => $this->freelancerProfile->portfolio_link ?? null,
            'headline'                       => $this->freelancerProfile->headline ?? null,
            'is_verified'                    => $this->is_verified,
            'created_at'                     => $this->created_at,
            'updated_at'                     => $this->updated_at,
            'portfolios'                      => $this->when(
                $this->portfolios &&
                    $this->portfolios->count() > 0,
                BaseResource::make(PortfolioResource::collection($this->portfolios))
            ),
            'category'                       => $this->when(
                $this->freelancerProfile &&
                    $this->freelancerProfile->category,
                BaseResource::make(CategoryResource::make($this->freelancerProfile->category))
            ),
            'skills'                        => $this->when(
                $this->skills && $this->skills->count() > 0,
                BaseResource::make(SkillResource::collection($this->skills))
            ),
            'languages'                      => $this->when(
                $this->languages && $this->languages->count() > 0,
                BaseResource::make(UserLanguageResource::collection($this->languages)),
                null
            ),
        ];
    }
}
