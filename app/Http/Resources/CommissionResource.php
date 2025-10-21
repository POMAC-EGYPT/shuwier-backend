<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id ?? null,
            'rate'           => $this->rate ?? null,
            'effective_from' => $this->effective_from ?? null,
            'created_by'     => $this->created_by ?? null,
            'created_at'     => $this->created_at ?? null,
            'updated_at'     => $this->updated_at ?? null,
        ];
    }
}
