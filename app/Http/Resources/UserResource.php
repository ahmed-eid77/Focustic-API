<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'attributes' => [
                'name'        => $this->name,
                'email'       => $this->email,
                'age'         => (string)$this->age,
                'profile_picture'   => $this->profile_picture,
                'linked_in'         => $this->linked_in,
                'position'          => $this->position,
                'bio'               => $this->bio,
                'points'            => $this->points
            ],
            /*'relationships' => [
                'tasks'       => TasksResource::collection($this->tasks),
                'my_sessions' => MySessionResource::collection($this->mySessions)
            ]*/
        ];
    }
}
