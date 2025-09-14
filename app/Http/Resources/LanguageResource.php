<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
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
                'id'        => $this->id,
                'name_ar'   => $this->name_ar,
                'name_en'   => $this->name_en,
                'level'     => $this->pivot->language_level,
            ];

        return [
            'id'        => $this->id,
            'name'      => app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en,
            'level'     => $this->pivot->language_level,

        ];
    }
}
