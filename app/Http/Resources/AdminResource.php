<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $permissions = $this->getAllPermissions()->pluck('name');

        $role = $this->roles->first()?->name;

        $permissions_with_role = [
            'permissions' => $permissions,
            'role'        => $role
        ];

        return [
            'id'                    => $this->id,
            'email'                 => $this->email,
            'permissions_with_role' => $permissions_with_role,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
        ];
    }
}
