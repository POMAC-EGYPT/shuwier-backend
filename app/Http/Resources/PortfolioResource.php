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
            'user'               => $this->when($this->relationLoaded('user') && $this->user, function () {
                return BaseResource::make(FreelancerResource::make($this->user));
            }),
            'category'           => $this->when($this->relationLoaded('category') && $this->category, function () {
                return BaseResource::make(CategoryResource::make($this->category));
            }),
            'subcategory'        => $this->when($this->relationLoaded('subcategory') && $this->subcategory, function () {
                return BaseResource::make(CategoryResource::make($this->subcategory));
            }),
            'hashtags'           => $this->hashtags ?? null,
            'attachments'        => $this->attachments ?? null,
        ];
    }
}
