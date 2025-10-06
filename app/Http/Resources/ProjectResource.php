<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'description'       => $this->description,
            'category_id'       => $this->category_id,
            'subcategory_id'    => $this->subcategory_id,
            'budget'            => $this->budget,
            'deadline_unit'     => $this->deadline_unit,
            'deadline'          => $this->deadline,
            'status'            => $this->status,
            'comments_enabled'  => $this->comments_enabled,
            'proposals_enabled' => $this->proposals_enabled,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'category'          => $this->when(
                $this->relationLoaded('category') &&
                    $this->category,
                BaseResource::make(CategoryResource::make($this->category))
            ),
            'subcategory'       => $this->when(
                $this->relationLoaded('subcategory') &&
                    $this->subcategory,
                BaseResource::make(CategoryResource::make($this->subcategory))
            ),
            'attachments'       => $this->when(
                $this->relationLoaded('attachments') &&
                    $this->attachments && $this->attachments->count() > 0,
                $this->attachments
            ),
            'user'              => $this->when(
                $this->relationLoaded('user') && $this->user,
                BaseResource::make(ClientResource::make($this->user))
            ),
        ];
    }
}
