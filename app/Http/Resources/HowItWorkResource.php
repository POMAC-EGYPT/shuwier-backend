<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HowItWorkResource extends JsonResource
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
                'id'             => $this->id,
                'title_en'       => $this->title_en,
                'title_ar'       => $this->title_ar,
                'description_en' => $this->description_en,
                'description_ar' => $this->description_ar,
                'type_ar'        => $this->type == 'freelancer' ? 'مستتقل' : 'عميل',
                'type_en'        => $this->type == 'freelancer' ? 'freelancer' : 'client',
                'image'          => $this->image,
                'created_at'     => $this->created_at,
                'updated_at'     => $this->updated_at,
            ];

        return [
            'id'          => $this->id,
            'title'       => app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en,
            'description' => app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en,
            'type'        => $this->type,
            'image'       => $this->image,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
