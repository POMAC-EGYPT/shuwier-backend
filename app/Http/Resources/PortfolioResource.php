<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'title'              => $this->title,
            'description'        => $this->description,
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
            'user'               => BaseResource::make(
                FreelancerResource::make($this->whenLoaded('user'))
            ),
            'category'           => BaseResource::make(
                CategoryResource::make($this->whenLoaded('category'))
            ),
            'subcategory'        => BaseResource::make(
                CategoryResource::make($this->whenLoaded('subcategory'))
            ),
            'hashtags'           => $this->hashtags ?? null,
            'attachments'        => $this->attachments ?? null,
        ];
    }
}
