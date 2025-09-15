<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserVerificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'email'           => $this->email,
            'type'            => $this->type,
            'profile_picture' => $this->profile_picture,
            'document_one'    => $this->verification?->document_one,
            'document_two'    => $this->verification?->document_two,
            'status'          => $this->verification?->status,
            'user_id'         => $this->verification?->user_id,
            'reviewed_by'     => $this->verification?->reviewed_by,
            'reviewed_at'     => $this->verification?->reviewed_at,
            'created_at'      => $this->verification?->created_at,
            'updated_at'      => $this->verification?->updated_at,
        ];
    }
}
