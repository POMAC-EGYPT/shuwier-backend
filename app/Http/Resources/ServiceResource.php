<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'category_id'        => $this->category_id,
            'subcategory_id'     => $this->subcategory_id,
            'category'           => $this->when($this->relationLoaded('category') && $this->category, function () {
                return BaseResource::make(CategoryResource::make($this->category));
            }),
            'subcategory'        => $this->when($this->relationLoaded('subcategory') && $this->subcategory, function () {
                return BaseResource::make(CategoryResource::make($this->subcategory));
            }),
            'delivery_time'      => $this->delivery_time,
            'delivery_time_unit' => $this->delivery_time_unit,
            'service_fees_type'  => $this->service_fees_type,
            'price'              => $this->price,
            'cover_photo'        => $this->cover_photo,
            'faqs'               => $this->relationLoaded('faqs') && $this->faqs ? $this->faqs : null,
            'attachments'        => $this->relationLoaded('attachments') && $this->attachments ? $this->attachments : null,
            'hashtags'           => $this->relationLoaded('hashtags') && $this->hashtags ? $this->hashtags : null,
            'user_id'            => $this->user_id,
            'user'               => $this->when($this->relationLoaded('user') && $this->user, function () {
                return BaseResource::make(FreelancerResource::make($this->user));
            }),
            'reviews'            => $this->when(
                $this->relationLoaded('reviews') &&
                    $this->reviews && $this->reviews->count() > 0,
                BaseResource::make(ReviewResource::collection($this->reviews)),
                null
            ),
            'rate'       => $this->rate,
            'rate_count' => $this->rate_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
