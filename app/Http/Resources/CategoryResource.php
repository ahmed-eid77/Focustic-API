<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // TODO: Check For Best Practice to solve The N+1 In Relationships

        return [
            'id' => (string) $this->id,
            'attributes' => [
                'name'        => $this->name,
            ],
            'relationships' => [
                'Exercise' => ExercisesResource::collection($this->exercises)
            ]
        ];
    }
}
