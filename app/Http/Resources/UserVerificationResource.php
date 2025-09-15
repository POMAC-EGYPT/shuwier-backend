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
            'id'           => $this->id,
            'document_one' => $this->document_one,
            'document_two' => $this->document_two,
            'status'       => $this->status,
            'user_id'      => $this->user_id,
            'reviewed_by'  => $this->reviewed_by,
            'reviewed_at'  => $this->reviewed_at,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
