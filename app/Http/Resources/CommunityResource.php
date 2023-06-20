<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CommunityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $userName = User::findOrFail($this->created_by);

        return [
            'id' => (string) $this->id,
            'attributes' => [
                'name'        => $this->name,
                'description' => $this->description,
                'users_count' => $this->users_count,
                'created_by'  => $userName->id
            ],
            'relationships' => [
                'users' => UserResource::collection($this->users)
            ]
        ];
    }
}
