<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'email_verified_at'              => $this->email_verified_at,
            'phone'                          => $this->phone,
            'type'                           => $this->type,
            'is_active'                      => $this->is_active,
            'about_me'                       => $this->about_me,
            'profile_picture'                => $this->profile_picture,
            'company'                        => $this->company,
            'country'                        => $this->country,
            'city'                           => $this->city,
            'languages'                      => $this->when(
                $this->languages && $this->languages->count() > 0,
                BaseResource::make(UserLanguageResource::collection($this->languages))
            ),
            'user_verification'            => $this->when(
                $this->verification,
                BaseResource::make(UserVerificationResource::make($this->verification))
            ),
            'created_at'                     => $this->created_at,
            'updated_at'                     => $this->updated_at,
        ];
    }
}
