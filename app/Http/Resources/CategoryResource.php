<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (request()->routeIs('admin.*'))
            return [
                'id'         => $this->id,
                'name_en'    => $this->name_en,
                'name_ar'    => $this->name_ar,
                'image'      => $this->image,
                'parent_id'  => $this->parent_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'children'   => $this->whenLoaded('children'),
            ];

        return [
            'id'         => $this->id,
            'name'       => app()->getLocale() === 'en' ? $this->name_en : $this->name_ar,
            'image'     => $this->image,
            'parent_id'  => $this->parent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'children'   => $this->whenLoaded('children'),
        ];
    }
}
